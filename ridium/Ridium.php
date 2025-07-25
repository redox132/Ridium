<?php

namespace Ridium;

use Ridium\src\Commands\MakeComponent;
use Ridium\src\Commands\MakeController;
use Ridium\src\Commands\MakeFactory;
use Ridium\src\Commands\MakeView;
use Ridium\src\Commands\MakeMigration;
use Ridium\src\Commands\RunMigrations;
use Ridium\src\Commands\ShowHelp;
use Ridium\src\Commands\RunSeeder;
use Ridium\src\Commands\MakeModel;

class Ridium
{
    public function handle(array $args)
    {
        $command = $args[0] ?? 'help';
        $name = $args[1] ?? null;

        switch ($command) {
            case 'make:model':
                (new MakeModel())->handle($name);
                break;
            case 'make:factory':
                (new MakeFactory())->handle($name);
                break;
            case 'make:controller':
                (new MakeController())->handle($name);
                break;
            case 'migrate':
                (new RunMigrations())->handle();
                break;
            case 'make:component':
                (new MakeComponent())->handle($name);
                break;
            case 'make:migration':
                (new MakeMigration())->handle($name);
                break;
            case 'make:view':
                (new MakeView())->handle($name);
                break;
            case 'seed':
                (new RunSeeder())->handle();
                break;
            case 'help':
                (new ShowHelp())->handle();
                break;
            default:
                echo "Unknown command: {$command}\n";
                echo "Run: php ridium/bin/rida help\n";
                break;
        }
    }
}
