<?php

namespace App\Models;


use App\Http\Services\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Product extends Model
{
    use HasFactory;

    protected array $fillable = ['name', 'slug', 'description', 'category_id', 'price'];
    private string $pivotTable = 'categories_tree';


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'attributes_products')
            ->select(['name', 'value', 'unit']);
    }


    public function getPriceOf(int $id)
    {
        return $this->select('price')->whereId($id)->pluck('price');
    }


    public function scopeFilter(Builder $builder, QueryFilter $filters): Builder
    {
        return $filters->apply($builder);
    }


}


