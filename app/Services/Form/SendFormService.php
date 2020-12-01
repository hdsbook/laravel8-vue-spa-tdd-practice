<?php

namespace App\Services\Form;

use App\Repositories\FormRepository;

class SendFormService
{
    protected $formRepo;
    protected $signingService;

    public function __construct()
    {
        $this->formRepo = new FormRepository();
        $this->signingService = new SigningService();
    }

    public function sendForm(
        $formName,
        $formTemplateId,
        $processData
    ) {
        if (!auth()->check()) {
            return null;
        }

        // 建立表單
        $form = $this->formRepo->createForm($formName, $formTemplateId);

        // 建立 簽核流程
        $form->signing = $this->signingService->createSigning($form->id, $processData);

        return $form;
    }
}
