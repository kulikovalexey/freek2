<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repository\SyncRepository;

class Info extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mark product for delete (hidden)';

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
        //variant
//        $resp = \ShopApi::variants()->get(136317644);

        $resp = \ShopApi::products()->get(69019187);

        $this->info(print_r($resp));
    }
}
