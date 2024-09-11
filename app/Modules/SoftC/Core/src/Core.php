<?php

namespace SoftC\Core;

use Carbon\Carbon;

class Core
{
    const SOFTC_VERSION = '1.0.0';
    
    public function __construct(
        protected CoreConfigRepository $coreConfigRepository
    ) {}
    
    public function version() {
        return static::KRAYIN_VERSION;
    }
    
    public function timezones(): array {
        $timezones = [];

        foreach (timezone_identifiers_list() as $timezone) {
            $timezones[$timezone] = $timezone;
        }

        return $timezones;
    }
    
    public function locales(): array {
        $options = [];

        foreach (config('app.available_locales') as $key => $title) {
            $options[] = [
                'title' => $title,
                'value' => $key,
            ];
        }

        return $options;
    }
    
    public function countries() {
        //return $this->countryRepository->all();
    }
    
    public function country_name(string $code): string {
        //$country = $this->countryRepository->findOneByField('code', $code);

        //return $country ? $country->name : '';
    }
    
    public function state_name(string $code): string
    {
        //$state = $this->countryStateRepository->findOneByField('code', $code);

        //return $state ? $state->name : $code;
    }
    
    public function states(string $countryCode)
    {
        //return $this->countryStateRepository->findByField('country_code', $countryCode);
    }
    
    public function groupedStatesByCountries()
    {
        $collection = [];

        //foreach ($this->countryStateRepository->all() as $state) {
        //    $collection[$state->country_code][] = $state->toArray();
        //}

        return $collection;
    }
    
    public function findStateByCountryCode($countryCode = null, $stateCode = null)
    {
        $collection = [];

        //$collection = $this->countryStateRepository->findByField([
        //    'country_code' => $countryCode,
        //    'code'         => $stateCode,
        //]);

        if (count($collection)) {
            return $collection->first();
        } else {
            return false;
        }
    }
    
    public function getSingletonInstance($className)
    {
        static $instances = [];

        //if (array_key_exists($className, $instances)) {
        //    return $instances[$className];
        //}

        return $instances[$className] = app($className);
    }
    
    public function formatDate($date, $format = 'd M Y h:iA')
    {
        return Carbon::parse($date)->format($format);
    }
    
    public function xWeekRange($date, $day)
    {
        $ts = strtotime($date);

        if (! $day) {
            $start = (date('D', $ts) == 'Sun') ? $ts : strtotime('last sunday', $ts);

            return date('Y-m-d', $start);
        } else {
            $end = (date('D', $ts) == 'Sat') ? $ts : strtotime('next saturday', $ts);

            return date('Y-m-d', $end);
        }
    }
    
    public function currencySymbol($code)
    {
        $formatter = new \NumberFormatter(app()->getLocale().'@currency='.$code, \NumberFormatter::CURRENCY);

        return $formatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);
    }
    
    public function formatBasePrice($price)
    {
        if (is_null($price)) {
            $price = 0;
        }

        $formatter = new \NumberFormatter(app()->getLocale(), \NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($price, config('app.currency'));
    }
    
    public function getConfigField(string $fieldName): ?array
    {
        return system_config()->getConfigField($fieldName);
    }
    
    public function getConfigData(string $field): mixed
    {
        return system_config()->getConfigData($field);
    }
}