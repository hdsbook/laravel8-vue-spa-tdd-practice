<?php

namespace App\Repositories;

use App\Models\Form;
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

    public function validateRequest(Request $request)
    {
        return $request->validate([
            'form_name' => 'required',
            'form_template_id' => 'required',
        ]);
    }

    public function createForm(Request $request)
    {
        $data = $this->validateRequest($request);
        return $request->user()
            ? $request->user()->createdForms()->create($data)
            : false;
    }
}
