<?php

namespace App\Repositories;

use Illuminate\Http\Request;

/**
 * class FormRepository
 *
 * @property \App\Models\Form $model
 */
class FormRepository extends EloquentRepository
{
    public $model;

    public function getModel()
    {
        return \App\Models\Form::class;
    }
}
