<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repository\SyncRepository;

class CheckForNewBrands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:check-new-brands {supplier}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sync:check-new-brands {supplier}';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $supplier = $this->argument('supplier');
        $this->info('check new brands in current supplier' . $supplier);
        //:TODO check and add new brand if not data
    }

    /**:TODO rebase
     * @param $supplier
     * @return \Illuminate\Config\Repository|mixed
     */
    protected function getConfigSuppliers($supplier)
    {
        return config("suppliers.{$supplier}");
    }
}
