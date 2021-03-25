<?php

namespace Database\Factories;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected string $model = Attribute::class;

    private array $attributes = [
        1 => ['name' => 'Размер', 'unit' => '', ],
        2 => ['name' => 'Вес',    'unit' => 'кг'],
        3 => ['name' => 'Цвет',   'unit' => '', ],
    ];

    public function getAll(): array
    {
        return $this->attributes;
    }

    public function getOne(int $id): ?array
    {
        if (!array_key_exists($id, $this->attributes)) {
            return null;
        }

        return $this->attributes[$id];
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
