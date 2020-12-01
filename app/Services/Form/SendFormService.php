<?php

namespace App\Services\Form;

use App\Models\Form;
use App\Repositories\FormRepository;

/**
 * class SendFormService 發送表單
 */
class SendFormService
{
    /**
     * 發送表單
     *
     * @param string $formName     表單名稱
     * @param int $formTemplateId  表單模版代碼
     * @param array $processData   簽核流程資料
     * @return Form
     */
    public function sendForm(
        $formName,
        $formTemplateId,
        $processData
    ) {
        if (!auth()->check()) {
            return null;
        }

        // 建立表單
        $formRepo = new FormRepository();
        $form = $formRepo->createForm($formName, $formTemplateId);

        // 建立 簽核流程
        $signingCreator = new CreateSigningService();
        $signingCreator->setProcesses($processData);
        $form->signing = $signingCreator->create($form->id);

        return $form;
    }
}
