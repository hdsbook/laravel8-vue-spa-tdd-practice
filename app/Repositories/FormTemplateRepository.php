<?php

namespace App\Repositories;

use App\Models\FormTemplate;
use Database\Factories\FormTemplateFactory;
use Illuminate\Http\Request;

/**
 * class FormTemplateRepository
 *
 * @property \App\Models\Form $model
 */
class FormTemplateRepository extends EloquentRepository
{
    public $model;

    public function getModel()
    {
        return \App\Models\FormTemplate::class;
    }

    public function createFormTemplate()
    {
        $create_user_id = auth()->check()
            ? auth()->user()->id : null;
        return FormTemplate::factory()->create([
            'create_user_id' => $create_user_id
        ]);
    }
}
