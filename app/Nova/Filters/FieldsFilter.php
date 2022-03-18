<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Nova;

class FieldsFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

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
        return $query;
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $key = $request->resource;
        $resource = Nova::resourceForKey($key);
        $instance = new $resource($request);
        $result = [];

        foreach ($instance->fields($request) as $field) {
            if ($field->showOnIndex) {
                $result[$field->name] = $field->attribute;
            }
        }

        return $result;
    }

    public function default()
    {
        $key = explode('/', request()->path())[1];
        $instance = Nova::resourceInstanceForKey($key);
        $result = [];

        foreach ($instance->fields(request()) as $field) {
            if ($field->showOnIndex) {
                $result[$field->attribute] = true;
            }
        }

        return $result;
    }
}
