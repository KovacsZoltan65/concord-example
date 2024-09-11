<?php

namespace SoftC\Core\Console\Commands;

use Illuminate\Console\Command;

class Version extends Command
{
    protected $signature = 'softc-crm:version';
    
    protected $description = 'Megjeleníti a SoftC CRM telepített aktuális verzióját';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function handle() {
        $this->comment('v' . core()->version());
    }
}