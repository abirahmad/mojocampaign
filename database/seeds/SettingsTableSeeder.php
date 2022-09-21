<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting();
        $setting->name = "Mojo Eid Offer";
        $setting->logo = "logo.png";
        $setting->contact_toll_free_number = "08000016609";
        $setting->contact_toll_free_number = "16609";
        $setting->email = "info@akijfood.com";
        $setting->save();
    }
}
