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

    public function createForm($formName, $formTemplateId)
    {
        return auth()->user()->createdForms()->create([
            'form_name' => $formName,
            'form_template_id' => $formTemplateId,
        ]);
    }
}
