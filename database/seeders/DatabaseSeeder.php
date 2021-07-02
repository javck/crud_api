<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Schema::disableForeignKeyConstraints();
        //$this->call(CategorySeeder::class);
        //$this->call(TagSeeder::class);
        //$this->call(PostSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(OrderSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
