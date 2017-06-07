<?php

use App\Models\VrPagesTranslations;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VrPagesTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $translations = [
        ];

        DB::beginTransaction();
        try {
            foreach ($translations as $translation) {
                $record = VrPagesTranslations::find($translation['id']);
                if (!$record) {
                    VrPagesTranslations::create($translation);
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
