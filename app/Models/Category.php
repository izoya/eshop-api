<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public bool $timestamps = false;
    protected array $fillable = ['name', 'slug', 'parent_id', 'level'];
    private string $pivotTable = 'categories_tree';
    private Builder $tree;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function parents(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, $this->pivotTable, 'descendant_id', 'ancestor_id');
    }

    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, $this->pivotTable, 'ancestor_id', 'descendant_id');
    }

    public function getPivotTable(): string
    {
        return $this->pivotTable;
    }

    /**
     * Возвращает запрос для построения отсортированного списка категорий
     * @return Builder
     */
    public function categories_tree(): Builder
    {
        return $this->query()
            ->selectRaw(
                $this->getTable() . '.*,
                min(ancestor_id) as ancestor_id')
            ->leftjoin(
                $this->getPivotTable(),
                'descendant_id', '=', $this->getTable() . '.id'
            )
            ->groupBy('id')
            ->orderBy('sort_id');
    }

}
