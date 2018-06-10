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
                        SELECT SUP.articleCode, SUP.supplier_id FROM `supplier_products` SUP
 LEFT JOIN variants V ON SUP.articleCode = V.articleCode
  LEFT JOIN store_products SP ON V.product_id = SP.id

where SUP.supplier_id = supplier AND SP.supplier_id IS NULL
      OR
      SUP.supplier_id = supplier AND SUP.supplier_id= SP.supplier_id AND ( V.priceIncl != SUP.priceIncl OR V.stockLevel !=  SUP.stockLevel);
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
