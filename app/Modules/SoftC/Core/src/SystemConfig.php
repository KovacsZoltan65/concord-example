<?php

namespace SoftC\Core;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use SoftC\Core\Repositories\CoreConfigRepository;
use SoftC\Core\SystemConfig\Item;

class SystemConfig
{
    public array $items = [];

    public function __construct(protected CoreConfigRepository $coreConfigRepository) {}

    public function addItem(Item $item): void
    {
        $this->items[] = $item;
    }

    public function getItems(): Collection
    {
        if (! $this->items) {
            $this->prepareConfigurationItems();
        }

        return collect($this->items)
            ->sortBy('sort');
    }

    private function retrieveCoreConfig(): array
    {
        static $items;

        if ($items) {
            return $items;
        }

        return $items = config('core_config');
    }

    public function prepareConfigurationItems()
    {
        $configWithDotNotation = [];

        foreach ($this->retrieveCoreConfig() as $item) {
            $configWithDotNotation[$item['key']] = $item;
        }

        $configs = Arr::undot(Arr::dot($configWithDotNotation));

        foreach ($configs as $configItem) {
            $subConfigItems = $this->processSubConfigItems($configItem);

            $this->addItem(new Item(
                children: $subConfigItems,
                fields: $configItem['fields'] ?? null,
                icon: $configItem['icon'] ?? null,
                key: $configItem['key'],
                name: trans($configItem['name']),
                route: $configItem['route'] ?? null,
                info: trans($configItem['info']) ?? null,
                sort: $configItem['sort'],
            ));
        }
    }

    private function processSubConfigItems($configItem): Collection
    {
        return collect($configItem)
            ->sortBy('sort')
            ->filter(fn ($value) => is_array($value) && isset($value['name']))
            ->map(function ($subConfigItem) {
                $configItemChildren = $this->processSubConfigItems($subConfigItem);

                return new Item(
                    children: $configItemChildren,
                    fields: $subConfigItem['fields'] ?? null,
                    icon: $subConfigItem['icon'] ?? null,
                    key: $subConfigItem['key'],
                    name: trans($subConfigItem['name']),
                    info: trans($subConfigItem['info']) ?? null,
                    route: $subConfigItem['route'] ?? null,
                    sort: $subConfigItem['sort'] ?? null,
                );
            });
    }

    public function getActiveConfigurationItem(): ?Item
    {
        if (! $slug = request()->route('slug')) {
            return null;
        }

        $activeItem = $this->getItems()->where('key', $slug)->first() ?? null;

        if (! $activeItem) {
            return null;
        }

        if ($slug2 = request()->route('slug2')) {
            $activeItem = $activeItem->getChildren()[$slug2];
        }

        return $activeItem;
    }

    public function getConfigField(string $fieldName): ?array
    {
        foreach ($this->retrieveCoreConfig() as $coreData) {
            if (! isset($coreData['fields'])) {
                continue;
            }

            foreach ($coreData['fields'] as $field) {
                $name = $coreData['key'].'.'.$field['name'];

                if ($name == $fieldName) {
                    return $field;
                }
            }
        }

        return null;
    }

    private function getDefaultConfig(string $field): mixed
    {
        $configFieldInfo = $this->getConfigField($field);

        $fields = explode('.', $field);

        array_shift($fields);

        $field = implode('.', $fields);

        return Config::get($field, $configFieldInfo['default'] ?? null);
    }

    public function getConfigData(string $field): mixed
    {
        $coreConfigValue = $this->coreConfigRepository->findOneWhere([
            'code' => $field,
        ]);

        if (! $coreConfigValue) {
            return $this->getDefaultConfig($field);
        }

        return $coreConfigValue->value;
    }
}