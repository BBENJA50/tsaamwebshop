<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryIds=Category::pluck('id')->toArray();
        $attributeIds=Attribute::pluck('id')->toArray();
        $subjectIds=Subject::pluck('id')->toArray();
        return [
            'name' => fake()->word(),
            'price' => fake()->randomFloat(2,1,100),
            'description' => fake()->sentence(),
            'category_id' => fake()->randomElement($categoryIds),
            'attribute_id' => fake()->randomElement($attributeIds),
            'subject_id' => fake()->randomElement($subjectIds),
        ];
    }
}
