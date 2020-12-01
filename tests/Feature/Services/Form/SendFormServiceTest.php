<?php

namespace Tests\Feature\Services\Form;

use App\Services\Form\SendFormService;
use App\Repositories\FormTemplateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * class SendFormServiceTest 測試發送表單
 *
 * @property SendFormService $userRepo
 */
class SendFormServiceTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    public function testSendForm()
    {
        // sign in
        $user = $this->signInById(1);

        // 建立表單模版
        $formTemplateRepo = new FormTemplateRepository();
        $formTemplate = $formTemplateRepo->createFormTemplate();

        /** @given 表單名稱、表單模版ID、簽核流程 */
        $formName = $this->faker->name;
        $formTemplateId = $formTemplate->id;
        $processData = [
            ['sign_user_id' => $user->id]
        ];

        /** @when send form */
        $service = new SendFormService();
        $form = $service->sendForm(
            $formName,
            $formTemplateId,
            $processData
        );

        /** @then check sended */
        $this->assertNotNull($form);
        $this->assertNotNull($form->id);
        $this->assertDatabaseHas('forms', ['id' => $form->id]);
        $this->assertEquals($formName, $form->form_name, "表單名稱錯誤");
        $this->assertEquals($formTemplateId, $form->form_template_id, "表單樣版錯誤");
    }
}
