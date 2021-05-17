<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ShortLink;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShortLinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShortLink::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::pluck('id');

        return [
            'link' => 'https://google.com',
            'code' => 'XkJlg',
            'created_by' => $this->faker->randomElement($user)    
        ];
    }
}
