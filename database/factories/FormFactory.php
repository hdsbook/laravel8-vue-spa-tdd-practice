<?php

namespace Database\Factories;

use App\Models\Form;
use App\Models\FormTemplate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Form::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'form_template_id' => FormTemplate::factory(),
            'form_name' => $this->faker->name,
            'create_user_id' => User::factory(),
        ];
    }
}
