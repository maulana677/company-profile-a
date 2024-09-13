<?php

namespace Database\Factories;

use App\Models\FaqSectionSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FaqSectionSetting>
 */
class FaqSectionSettingFactory extends Factory
{
    protected $model = FaqSectionSetting::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'btn_text' => $this->faker->word,
        ];
    }
}
