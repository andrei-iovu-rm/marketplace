<?php

namespace App\Nova\Actions;

use App\Enums\UserRole;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class ChangeUserRole extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $model->role = $fields->role;
            $model->save();
        }

        return Action::message('Users updated with the new role: ' . $fields->role);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Role', 'role')->options(function (){
                $roles = [];
                foreach (UserRole::cases() as $role){
                    $roles[$role->value] = ucfirst(strtolower($role->name));
                }
                return $roles;
            })
        ];
    }
}
