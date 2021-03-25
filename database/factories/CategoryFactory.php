<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected string $model = Category::class;
    private array $categories = [
        1  => ['name' => 'Электроника',     'level' => 0, 'parent_id' => null, 'ancestors' => [1]],
        4  => ['name' => 'Планшеты',        'level' => 1, 'parent_id' => 1,  'ancestors' => [1, 4]],
        5  => ['name' => 'Офисная техника', 'level' => 1, 'parent_id' => 1,  'ancestors' => [1, 5]],
        10 => ['name' => 'Принтеры',        'level' => 2, 'parent_id' => 5,  'ancestors' => [1, 5, 10]],
        11 => ['name' => 'Сканеры',         'level' => 2, 'parent_id' => 5,  'ancestors' => [1, 5, 11]],

        2  => ['name' => 'Одежда и обувь', 'level' => 0, 'parent_id' => null, 'ancestors' => [2]],
        6  => ['name' => 'Женская',        'level' => 1, 'parent_id' => 2,  'ancestors' => [2, 6]],
        12 => ['name' => 'Одежда',         'level' => 2, 'parent_id' => 6,  'ancestors' => [2, 6, 12]],
        13 => ['name' => 'Обувь',          'level' => 2, 'parent_id' => 6,  'ancestors' => [2, 6, 13]],
        14 => ['name' => 'Аксессуары',     'level' => 2, 'parent_id' => 6,  'ancestors' => [2, 6, 14]],
        7  => ['name' => 'Мужская',        'level' => 1, 'parent_id' => 2,  'ancestors' => [2, 7]],

        3  => ['name' => 'Детские товары',  'level' => 0, 'parent_id' => null, 'ancestors' => [3]],
        8  => ['name' => 'Детское питание', 'level' => 1, 'parent_id' => 3,  'ancestors' => [3, 8]],
        9  => ['name' => 'Игрушки',         'level' => 1, 'parent_id' => 3,  'ancestors' => [3, 9]],
        15 => ['name' => 'Конструкторы',    'level' => 2, 'parent_id' => 9,  'ancestors' => [3, 9, 15]],
        16 => ['name' => 'Мягкие игрушки',  'level' => 2, 'parent_id' => 9,  'ancestors' => [3, 9, 16]],
    ];

    public function getOne(int $id): ?array
    {
        if (!array_key_exists($id, $this->categories)) {
            return null;
        }

        return $this->categories[$id];
    }

    public function getAll(): array
    {
        return $this->categories;
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
}
