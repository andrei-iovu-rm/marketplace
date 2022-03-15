<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Nova;

class UserRole extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    public function name()
    {
        $resourceKey = explode('/', request()->path())[1];
        $resourceClass = Nova::resourceForKey($resourceKey);
        $resourceSingularLabel = $resourceClass::singularLabel();

        return $resourceSingularLabel . ' Role';
    }

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where('role', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $roles = [];
        foreach (\App\Enums\UserRole::cases() as $role){
            $roles[ucfirst(strtolower($role->name))] = $role->value;
        }
        return $roles;
    }
}
