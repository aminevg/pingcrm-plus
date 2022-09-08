<?php

namespace Database\Factories;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "first_name" => fake()->firstName(),
            "last_name" => fake()->lastName(),
            "email" => fake()
                ->unique()
                ->safeEmail(),
            "email_verified_at" => now(),
            "password" =>
                '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            "photo_path" => $this->get_photo(
                fake()
                    ->unique()
                    ->randomNumber(5)
            ),
            "remember_token" => Str::random(10),
        ];
    }

    private function get_photo(int $id)
    {
        $final_path = "users/people_" . $id . ".jpg";
        $client = new Client();
        $res_buffer = $client
            ->get("https://placeimg.com/48/48/people")
            ->getBody();
        Storage::disk("local")->put($final_path, $res_buffer);
        return $final_path;
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(
            fn(array $attributes) => [
                "email_verified_at" => null,
            ]
        );
    }
}
