<?php

namespace App\Repositories;

use Illuminate\Http\Request;

/**
 * class SigningProcessRepository
 *
 * @property \App\Models\Form $model
 */
class SigningProcessRepository extends EloquentRepository
{
    public $model;

    public function getModel()
    {
        return \App\Models\SigningProcess::class;
    }
}
