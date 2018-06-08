<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureUpdateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_select_products_for_update`');
        DB::unprepared('
              CREATE PROCEDURE sp_select_products_for_update(IN supplier INT)
              BEGIN
                SELECT SUP.articleCode,SP.supplier_id FROM `store_products` SP JOIN variants V ON SP.id = V.product_id
                  JOIN `supplier_products` SUP ON SUP.articleCode = V.articleCode
            
            
                where SP.supplier_id = supplier AND (V.priceIncl != SUP.priceIncl AND SP.`data02` != \'fixed_price\' )
                      OR
                      (SP.supplier_id = supplier AND V.stockLevel !=  SUP.stockLevel)
                ORDER BY `SP`.`id`  DESC;
              END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_select_products_for_update`;');
    }
}
