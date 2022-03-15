<?php

namespace App\Nova;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Category extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Category::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'slug'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('ID')->sortable(),
            Text::make('Name')->sortable()
                ->withMeta([
                    'extraAttributes' => ['placeholder' => 'Name of the category']
                ])->rules([
                    'name' => ['required', 'max:100'],
                ]),
            Text::make('Slug')->sortable()
                ->withMeta([
                   'extraAttributes' => ['placeholder' => 'Unique slug']
                ])->rules([
                    'slug' => ['required', Rule::unique('categories', 'slug')],
                ]),
            DateTime::make('Created At', 'created_at')
                ->rules('required', function ($attribute, $value, $fail){
                    if(!Carbon::createFromFormat('Y-m-d H:i:s', $value)->isToday()){
                        return $fail('Please only today dates!');
                    }
                }),

            HasMany::make('Offers'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
