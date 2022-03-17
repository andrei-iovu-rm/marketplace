<?php

namespace App\Nova;

use App\Nova\Filters\FieldsFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Laravel\Nova\Nova;

abstract class AbstractResource extends Resource
{
    /*public static function indexQuery(NovaRequest $request, $query)
    {
        if(!is_null(optional($request)->orderByDirection)){
            return $query;
        }

        if(!empty(static::$indexDefaultOrder)){
            return $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }
    }*/

    protected static function applyOrderings($query, array $orderings)
    {
        if (empty($orderings) && !empty(static::$indexDefaultOrder)) {
            $orderings = static::$indexDefaultOrder;
        }

        return parent::applyOrderings($query, $orderings);
    }

    public function fieldsForIndex(Request $request)
    {
        $fieldFilter = $request->filters()->first(function ($filter){
            return $filter->filter instanceof FieldsFilter;
        });
        $key = $request->resource;
        $resource = Nova::resourceForKey($key);
        $instance = new $resource($request);
        $fields = [];

        foreach ($instance->fields($request) as $field) {
            if (Arr::get($fieldFilter->value ?? null, $field->attribute, true)) {
                $fields[] = $field;
            }
        }

        return $fields;
    }
}
