<?php

namespace Tests\Feature\Repositories;

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
        $this->signInById(1);

        // 建立表單模版
        $formTemplate = FormTemplate::factory()->create([
            'create_user_id' => auth()->user()->id
        ]);

        /** @given 表單模版ID、表單名稱 */
        $formTemplateId = $formTemplate->id;
        $form_name = $this->faker->name;

        /** @when send form */
        $service = new SendFormService();
        $form = $service->sendForm($formTemplateId, $form_name);

        /** @then check sended */
        $this->assertNotNull($form);
        $this->assertNotNull($form->id);
        $this->assertDatabaseHas('forms', ['id' => $form->id]);
        $this->assertEquals($form_name, $form->form_name);
        $this->assertEquals($formTemplateId, $form->form_template_id);
    }
}
