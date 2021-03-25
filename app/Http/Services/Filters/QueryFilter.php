<?php


namespace App\Http\Services\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected Request $request;
    protected Builder $builder;

    abstract public function getValidationRules(): array;


    public function __construct(Request $request)
    {
        $this->request = $request;

    }


    public function filters()
    {
        return $this->request->query();
    }


    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                if (!empty($value)) {
                    call_user_func_array([$this, $name], [$value]);
                }
            }
        }

        return $this->builder;
    }
}
