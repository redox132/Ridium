?php

namespace App\Database\Factories;

use Faker\Factory;

class Rida
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function definition(): array
    {
        return [
            // define the attributes for your model here
        ];
    }
}
