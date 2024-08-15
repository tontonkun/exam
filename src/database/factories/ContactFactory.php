<?php

namespace Database\Factories;

use App\Models\Category; 
use App\Models\Contacts;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        

        return [
            'category_id' => Category::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->numberBetween(1, 3),
            'email' =>$this->faker->safeEmail(),
            'tell'=> $this->faker->numerify('###########'),
            'address'=> $this->faker->sentence(),
            'building'=> $this->faker->sentence(),
            'detail'=> $this->faker->text(120)
        ];
    }
}
