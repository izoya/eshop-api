<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attributes')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [];
        $attributes = Attribute::factory()->getAll();

        foreach ($attributes as $id => $attribute) {
            $data[] = [
                'id' => $id,
                'name' => $attribute['name'],
                'unit' => $attribute['unit'],
            ];
        }

        return $data;
    }
}
