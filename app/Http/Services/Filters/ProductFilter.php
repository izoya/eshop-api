<?php


namespace App\Http\Services\Filters;


use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends QueryFilter
{
    public function category(int $id): Builder
    {
        $categories = Category::query()->findOrNew($id)->children->pluck('id');

        return $this->builder->whereIn('category_id', $categories);

    }


    public function search(string $keyword): Builder
    {
        return $this->builder->where('name', 'like', '%' . $keyword . '%');
    }


    public function price(string $range): Builder
    {
        return $this->builder->whereBetween('price', explode(',', $range));
    }


    public function attributes(array $attributes): Builder
    {
        foreach ($attributes as $attr) {
            preg_match('/^(\d+)([<=>]{1})(.*)$/i', $attr, $matches);
            //'AND' clause
            $this->builder->whereHas('attributes', function ($query) use ($matches) {
                $query->where('attribute_id', '=', $matches[1])
                      ->where('value', $matches[2], $matches[3]);
            });
        }

        return $this->builder;
    }


    public function getValidationRules(): array
    {
        return [
            'category' => 'nullable|integer',
            'price'        => 'nullable|regex:/^\d+,\d+$/',
            'attributes'   => 'nullable|array',
            'attributes.*' => ['nullable', 'regex:/^\d+[<=>]{1}((\w)+|\d*\.\d+)$/'],
            'search'       => 'nullable|string',
        ];
    }
}
