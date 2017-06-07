<?php

use App\Models\VrMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VrMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = [
            ["id" => "about", "sequence" => "1"], //section describing concept of activity
            ["id" => "virtual-rooms", "sequence" => "2"], //separate rooms themes
            ["id" => "place-and-time", "sequence" => "3"], //location of place
            ["id" => "tickets", "sequence" => "4"],
            ["id" => "sponsors", "sequence" => "5"],
            ["id" => "stock", "sequence" => "0"],
            ["id" => "swiming", "sequence" => "2", "vr_parent_id" => "virtual-rooms"],
            ["id" => "play", "sequence" => "2", "vr_parent_id" => "virtual-rooms" ],
            ["id" => "work", "sequence" => "2", "vr_parent_id" => "virtual-rooms"],
            ["id" => "elektromark", "sequence" => "5", "vr_parent_id" => "sponsors" ],
            ["id" => "telesoft", "sequence" => "5", "vr_parent_id" => "sponsors" ],




        ];
        DB::beginTransaction();
        try {
            foreach ($menu as $item) {
                $record = VrMenu::find($item['id']);
                if (!$record) {
                    VrMenu::create($item);
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

