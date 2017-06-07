<?php
use App\Models\VrCategories;
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
            ["id" => "about"], //section describing concept of activity
            ["id" => "virtual-rooms"], //separate rooms themes
            ["id" => "place-and-time"], //location of place
            ["id" => "tickets"],
            ["id" => "sponsors"],
            ["id" => "footer"],

        ];
        DB::beginTransaction();
        try {
            foreach ($categories as $category) {
                $record = VrCategories::find($category['id']);
                if (!$record) {
                    VrCategories::create($category);
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