<?php

namespace App\Http\Services\Form;

use App\Repositories\FormRepository;

class SendFormService
{
    protected $formRepo;

    public function sendForm($formTemplateId, $form_name)
    {
        if (!auth()->check()) {
            return null;
        }

        $form = auth()->user()->createdForms()->create([
            'form_name' => $form_name,
            'form_template_id' => $formTemplateId,
        ]);
        return $form;
    }
}
