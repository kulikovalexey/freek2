<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureDeleteProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_select_products_for_delete`');
        DB::unprepared('
              CREATE PROCEDURE sp_select_products_for_delete()
              BEGIN
                SELECT SP.id FROM `store_products` SP JOIN variants V ON SP.id = V.product_id
                  LEFT JOIN `supplier_products` SUP ON SUP.articleCode = V.articleCode
            
                where SUP.articleCode IS NULL AND SP.supplier_id IN (SELECT DISTINCT supplier_id from supplier_products)  AND  SP.data03 !="deleted"
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
        DB::unprepared('DROP PROCEDURE IF EXISTS `sp_select_products_for_delete`;');
    }
}
