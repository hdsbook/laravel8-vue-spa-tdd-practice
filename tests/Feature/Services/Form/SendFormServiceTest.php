<?php

namespace Tests\Feature\Services\Form;

use App\Models\User;
use App\Services\Form\SendFormService;
use App\Models\FormTemplate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\isNull;

/**
 * class SendFormServiceTest
 *
 * @property SendFormService $userRepo
 */
class SendFormServiceTest extends TestCase
{
    use WithFaker;

    public function testSendForm()
    {
        // sign in
        $user = $this->signInById(1);

        // 建立表單模版
        $formTemplate = FormTemplate::factory()->create([
            'create_user_id' => $user->id
        ]);

        /** @given 表單名稱、簽核模版ID、表單模版ID */
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
