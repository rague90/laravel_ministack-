<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(
          [
               'name' => 'Web dev',
               'slug' => Str::slug('Web Dev'),
          ]);
          Category::create(
            [
            'name'=>'Programming ',
            'slug'=>Str::slug('Programming')
            ]);
            Category::create(
                [
                'name'=>'Mobile Apps',
                'slug'=>Str::slug('Mobile Apps')
                ]);    
                Category::create(
                    [
                    'name'=>'Front Dev',
                    'slug'=>Str::slug('Front Dev')
                    ]);    
    }
}
