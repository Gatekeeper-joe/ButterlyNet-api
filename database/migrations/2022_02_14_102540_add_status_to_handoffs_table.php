<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToHandoffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('handoffs', function (Blueprint $table) {
            $table->string('status')->after('body')->default('Open'); //デフォルト値をmyAdminで直接用意しているから、本番移ったとき怪しい。
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('handoffs', function (Blueprint $table) {
            $table->dropColumn('handoffs');
        });
    }
}
