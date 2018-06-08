<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repository\SyncRepository;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:delete-product';

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
        //вызвать процедуру и получить id - отправить в метод
        $productsId = \DB::select('CALL `sp_select_products_for_delete`');

        foreach ($productsId as $item){
            SyncRepository::markForDeletion($item->id);
        }
        $this->info(' deleted products was hidden;');
    }
}
