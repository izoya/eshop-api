<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected string $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $categories = array_filter(Category::factory()->getAll(), function ($item) {
                return $item['level'] === 2;
        });
        $name = $this->faker->catchPhrase;

        return [
            'name' => $name,
            'slug' => $this->faker->unique()->passthrough(Str::slug($name)),
            'description' => $this->faker->realText(mt_rand(100, 300)),
            'category_id' => array_rand($categories),
            'price' => $this->faker->randomFloat(2, 500, 5000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
