<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUnixSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unix_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        DB::table('unix_settings')->insert([
            ['id' => 1, 'name' => 'sbactivecolor1', 'value' => '#ff7551'],
            ['id' => 2, 'name' => 'sbactivecolor2', 'value' => '#32a7e2'],
            ['id' => 3, 'name' => 'sbactivecolor3', 'value' => '#6c5ecf'],
            ['id' => 4, 'name' => 'sbsmalldevices', 'value' => '0'],
            ['id' => 5, 'name' => 'sb-links-bg', 'value' => '#353340'],
            ['id' => 6, 'name' => 'disable_sidebar', 'value' => '1'],
            ['id' => 7, 'name' => 'alertenabled', 'value' => '0'],
            ['id' => 8, 'name' => 'atitle', 'value' => 'Info'],
            ['id' => 9, 'name' => 'abackgroundcolor', 'value' => 'white'],
            ['id' => 10, 'name' => 'alertcolor', 'value' => '#4d90fd'],
            ['id' => 11, 'name' => 'amessage', 'value' => ' '],
            ['id' => 12, 'name' => 'alertclosable', 'value' => '0'],
            ['id' => 13, 'name' => 'loginbgtype', 'value' => '1'],
            ['id' => 14, 'name' => 'login-bg-img', 'value' => 'https://wallpaperaccess.com/full/2002264.png'],
            ['id' => 15, 'name' => 'mainbgtype', 'value' => '1'],
            ['id' => 16, 'name' => 'widgetbot', 'value' => '0'],
            ['id' => 17, 'name' => 'discordID', 'value' => '760945720470667294'],
            ['id' => 18, 'name' => 'channelID', 'value' => '760945722559299668'],
            ['id' => 19, 'name' => 'enablearc', 'value' => '0'],
            ['id' => 20, 'name' => 'arcID', 'value' => '#'],
            ['id' => 21, 'name' => 'brand-logo', 'value' => '/assets/svgs/pterodactyl.svg'],
            ['id' => 22, 'name' => 'enableloginimg', 'value' => '1'],
            ['id' => 23, 'name' => 'enablebrandlogo', 'value' => '1'],
            ['id' => 24, 'name' => 'topnavbar', 'value' => '0'],
            ['id' => 25, 'name' => 'viewname', 'value' => '2'],
            ['id' => 26, 'name' => 'pcolor', 'value' => '#1f1d2b'],
            ['id' => 27, 'name' => 'scolor', 'value' => '#0000000d'],
            ['id' => 28, 'name' => 'tcolor', 'value' => '#0000001a'],
            ['id' => 29, 'name' => 'textcolor', 'value' => '#808191'],
            ['id' => 30, 'name' => 'activetextcolor', 'value' => 'white'],
            ['id' => 31, 'name' => 'buttoncolor', 'value' => '#0967d3'],
            ['id' => 32, 'name' => 'Light_pcolor', 'value' => '#f0f2fa'],
            ['id' => 33, 'name' => 'Light_scolor', 'value' => '#ffffff'],
            ['id' => 34, 'name' => 'Light_tcolor', 'value' => '#eff0f6'],
            ['id' => 35, 'name' => 'Light_textcolor', 'value' => '#767676'],
            ['id' => 36, 'name' => 'Light_activetextcolor', 'value' => 'black'],
            ['id' => 37, 'name' => 'mode', 'value' => '1'],
            ['id' => 38, 'name' => 'metatitle', 'value' => 'Pterodactyl'],
            ['id' => 39, 'name' => 'metaimg', 'value' => '/assets/svgs/pterodactyl.svg'],
            ['id' => 40, 'name' => 'metacolor', 'value' => '#0967d3'],
            ['id' => 41, 'name' => 'metadesc', 'value' => 'Manage your server with an easy-to-use Panel'],
            ['id' => 42, 'name' => 'custom_css', 'value' => ' '],
            ['id' => 43, 'name' => 'login_custom_css', 'value' => ' '],
            ['id' => 44, 'name' => 'l_key', 'value' => 'U_123'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unix_settings');
    }
}