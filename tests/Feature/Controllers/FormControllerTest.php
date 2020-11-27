<?php

namespace Tests\Feature\Controllers;

use App\Models\Form;
use App\Models\FormTemplate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * class FormControllerTest
 */
class FormControllerTest extends TestCase
{

    use WithFaker;

    protected $user;
    protected $formTemplate;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->signInById(1);
        $this->formTemplate = FormTemplate::factory()->create([
            'create_user_id' => $this->user
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
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
        $this->assertEquals(
            $createData,
            $form->only(['form_name', 'form_template_id'])
        );
    }
}
