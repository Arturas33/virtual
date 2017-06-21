<?php

use App\Models\VrCategories;
use App\Models\VrCategoriesTranslations;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: agnė
 * Date: 5/24/17
 * Time: 9:30 AM
 */
class VrCategoriesSeeder extends Seeder
{
    /** Categories seeds
     * @throws Exception
     *
     */
    public function run()
    {
        $categories = [

            ["id" => "vr_rooms"], //separate rooms themes

        ];
        $categoriesTranslations =[

            ['name'=>'Virtualūs kambariai', 'language_code'=>'lt', 'record_id'=>'vr_rooms'],
            ['name'=>'Virtual rooms', 'language_code'=>'en', 'record_id'=>'vr_rooms'],
            ['name'=>'Виртуальные номера', 'language_code'=>'ru', 'record_id'=>'vr_rooms'],
            ['name'=>'virtuelle Räume', 'language_code'=>'de', 'record_id'=>'vr_rooms'],
            ['name'=>'salles virtuelles', 'language_code'=>'fr', 'record_id'=>'vr_rooms'],

        ];
        DB::beginTransaction();
        try {
            foreach ($categories as $category) {
                $record = VrCategories::find($category['id']);
                if (!$record) {
                    VrCategories::create($category);
                }
            }
            foreach ($categoriesTranslations as $categoryTranslation) {
                $record = VrCategoriesTranslations::where('record_id', $categoryTranslation['record_id'])
                                                    ->where('language_code', $categoryTranslation['language_code'])
                                                    ->first();
                if (!$record) {
                    VrCategoriesTranslations::create($categoryTranslation);
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