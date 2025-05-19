<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings_company', function (Blueprint $table) {
            $table->string('header_bg_color', 7)->nullable()->after('favicon');
            $table->string('menu_bg_color', 7)->nullable()->after('header_bg_color');
            $table->string('button_bg_color', 7)->nullable()->after('menu_bg_color');
            $table->string('footer_bg_color', 7)->nullable()->after('button_bg_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings_company', function (Blueprint $table) {
            $table->dropColumn(['header_bg_color', 'menu_bg_color', 'button_bg_color', 'footer_bg_color']);
        });
    }
};
