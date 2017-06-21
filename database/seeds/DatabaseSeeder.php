<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VrLanguageCodesSeeder::class);
        $this->call(VrRolesSeeder::class);
        $this->call(VrCategoriesSeeder::class);
//        $this->call(VrMenuSeeder::class);
//        $this->call(VrMenuTranslationsSeeder::class);
//        $this->call(VrPagesSeeder::class);
//        $this->call(VrPagesTranslationsSeeder::class);

    }

}
