<?php

use App\Models\VrPages;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VrPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $pages = [
            ["id" => "the_lab", "category_id" => "about"],
            ["id" => "samsung_irklavimas", "category_id" => "virtual-rooms"],
            ["id" => "ktu_parasparnis", "category_id" => "virtual-rooms"],
            ["id" => "hurl", "category_id" => "virtual-rooms"],
            ["id" => "tilt_brush", "category_id" => "virtual-rooms"],
            ["id" => "fruit_ninja", "category_id" => "virtual-rooms"],
        ];

        DB::beginTransaction();
        try {
            foreach ($pages as $page) {
                $record = VrPages::find($page['id']);
                if (!$record) {
                    VrPages::create($page);
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
