<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repository\SyncRepository;

class CheckProductForEnable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:enable-deleted-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'remove data03=delete (hidden) for product';

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
        //вызвать процедуру и получить id - отправить в метод
        $productsId = \DB::select('CALL `sp_select_products_for_remove_data03_delete`');

        foreach ($productsId as $item){
            SyncRepository::removeMarkDelete($item->id);
        }
        $this->info('remove data03=\'deleted\' products and set visibility = \'\';');
    }
}
