<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $lists = ['baseball', 'football', 'hockey', 'basketball', 'boxing', 'golf', 'tennis', 'horse racing'];

        foreach ($lists as $list) {
            Category::firstOrCreate(['name' => $list]);
        }
    }
}
