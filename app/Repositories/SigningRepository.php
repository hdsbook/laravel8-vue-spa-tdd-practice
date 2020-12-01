<?php

namespace App\Repositories;

use Illuminate\Http\Request;

/**
 * class SigningRepository
 *
 * @property \App\Models\Form $model
 */
class SigningRepository extends EloquentRepository
{
    public $model;

    public function getModel()
    {
        return \App\Models\Signing::class;
    }
}
