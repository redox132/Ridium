<?php

namespace Ridium\src\Commands;

use App\Database\Seeders\DatabaseSeeder;

class RunSeeder
{
    public function handle(): void
    {
        $seeder = new DatabaseSeeder();
        $seeder->run();
        echo "Database seeding completed successfully.\n";
        exit;
    }
}
