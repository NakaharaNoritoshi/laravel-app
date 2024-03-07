<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    //    Contact::factory()->count(100)->create();
       \App\Models\Contact::factory(100)->create();

        // DB::table('contacts')>insert([
        //     'name' => Str::random(10),
        //     'mail' => Str::random(10).'@gmail.com',
        //     'reply' => Str::random(10),
        //     'category' => rand(1, 5),
        //     'title' => Str::random(20),
        //     'content' => rand(50, 100),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
    }
}
