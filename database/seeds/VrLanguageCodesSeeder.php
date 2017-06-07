<?php

use App\Models\VrLanguageCodes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VrLanguageCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            ['id'=>'en', "language_code" => "en"],
            ['id'=>'lt', "language_code" => "lt"],
        ];

        DB::beginTransaction();
        try {
            foreach ($languages as $language) {
                $record = VrLanguageCodes::find($language['id']);
                if (!$record) {
                    VrLanguageCodes::create($language);
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
