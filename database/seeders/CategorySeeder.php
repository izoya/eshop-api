<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    private array $categoriesData = [];
    private array $categoriesTreeData = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->prepareData();
        DB::table('categories')->insert($this->categoriesData);
        DB::table('categories_tree')->insert($this->categoriesTreeData);
    }

    private function prepareData(): void
    {
        $categories = Category::factory()->getAll();

        foreach ($categories as $id => $category) {
            $this->categoriesData[] = [
                'id' => $id,
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'parent_id' => $category['parent_id'],
                'level' => $category['level'],
                'sort_id' => implode($category['ancestors']),
            ];

            foreach ($category['ancestors'] as $ancestor) {
                $this->categoriesTreeData[] = [
                    'ancestor_id' => $ancestor,
                    'descendant_id' => $id
                ];
            }
        }
    }
}
