<?php

use App\Models\VrMenuTranslations;
use Illuminate\Database\Seeder;

class VrMenuTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuTranslations = [
            ["id" => "aboutTransEn","language_code" => "en", "url" => "/about", "name" => "About", "menu_id" => "about"],
            ["id" => "aboutTransLt", "language_code" => "lt", "url" => "/apie", "name" => "Apie", "menu_id" => "about"],

            ["id" => "virtual-roomsTransEn", "language_code" => "en", "url" => "/virtual-rooms", "name" => "Virtual rooms", "menu_id" => "virtual-rooms"],
            ["id" => "virtual-roomsTransLt", "language_code" => "lt", "url" => "/virtualus-kambariai", "name" => "Virtualus kambariai", "menu_id" => "virtual-rooms"],

            ["id" => "virtual-roomsTrans-EnSwiming", "language_code" => "en", "url" => "/virtual-rooms/swiming", "name" => "Swiming", "menu_id" => "swiming"],
            ["id" => "virtual-roomsTrans-LtSwiming", "language_code" => "lt", "url" => "/virtualus-kambariai/plaukimas", "name" => "Plaukimas", "menu_id" => "swiming"],

            ["id" => "ticketsTransEn", "language_code" => "en",  "url" => "/tickets", "name" => "Tickests", "menu_id" => "tickets"],
            ["id" => "ticketsTransLt", "language_code" => "lt",  "url" => "/bilietai", "name" => "Bilietai", "menu_id" => "tickets"],

            ["id" => "place-and-timeTransEn", "language_code" => "en", "url" => "/place-and-time", "name" => "Place and Time", "menu_id" => "place-and-time"],
            ["id" => "place-and-timeTransLt",  "language_code" => "lt", "url" => "/vieta-ir-laikas", "name" => "Vieta ir laikas", "menu_id" => "place-and-time"],

            ["id" => "sponsorsTransEn", "language_code" => "en", "url" => "/sponsors", "name" => "Sponsors", "menu_id" => "sponsors"],
            ["id" => "sponsorsTransLt", "language_code" => "lt", "url" => "/rėmėjai", "name" => "Rėmėjai", "menu_id" => "sponsors"],

            ["id" => "sponsorsTransEnElekEn", "language_code" => "en", "url" => "/sponsors/elektromark", "name" => "Elektromark", "menu_id" => "elektromark"],
            ["id" => "sponsorsTransLtElekLt", "language_code" => "lt", "url" => "/rėmėjai/elektromark", "name" => "Elektromark", "menu_id" => "elektromark"],


        ];
        DB::beginTransaction();
        try {
            foreach ($menuTranslations as $menuTranslation) {
                $record = VrMenuTranslations::find($menuTranslation['id']);
                if (!$record) {
                    VrMenuTranslations::create($menuTranslation);
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            echo 'Point of failure '. $e->getCode() . ' ' . $e->getMessage();
            throw new Exception($e);
        }
        DB::commit();
    }

}
