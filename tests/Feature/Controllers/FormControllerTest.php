<?php

namespace Tests\Feature\Controllers;

use App\Models\Form;
use App\Models\FormTemplate;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * class FormControllerTest
 */
class FormControllerTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    protected $user;
    protected $formTemplate;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->signInById(1);

        // 建立表單模版
        $this->formTemplate = FormTemplate::factory()->create([
            'create_user_id' => $this->user
        ]);
    }

    public function testCreateForm()
    {
        /** @given create data */
        $createData = [
            'form_template_id' => $this->formTemplate->id,
            'form_name' => $this->faker->name
        ];

        /** @when create */
        $response = $this->postJson(route('form.store'), $createData)
            ->assertStatus(200)
            ->assertJson(['success' => true])
            ->json();

        /** @then assert created */
        $this->assertNotNull($response['id']);
        $this->assertDatabaseHas('forms', ['id' => $response['id']]);

        $form = Form::find($response['id']);
        $this->assertEquals($createData['form_name'], $form->form_name);
        $this->assertEquals($createData['form_template_id'], $form->form_template_id);
    }
}
