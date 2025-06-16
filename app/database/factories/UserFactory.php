<?php

namespace App\Database\Factories;


use Faker\Factory;
use App\Database\Connection;

class UserFactory
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => password_hash($this->faker->password(8, 50), PASSWORD_BCRYPT), // or faker password if preferred
        ];
    }


    function seed(int $count = 1)
    {

        echo "Seeding... please wait! ";
        echo "\n";

        foreach (range(1, $count) as $i) {
            $data = $this->definition();
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            Connection::query($sql, $data);
        }

        echo "\n";
        echo "Seeded $count records.\n";
        echo "\n";
    }
}
