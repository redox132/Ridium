<?php

namespace Ridium\src\Commands;


class ShowHelp
{
    public function handle(): void
    {
        $green = "\033[0;32m";
        $cyan  = "\033[1;36m";
        $yellow = "\033[1;33m";
        $bold  = "\033[1m";
        $reset = "\033[0m";

        echo "\n{$bold}{$cyan}Ridium CLI Tool Help Menu{$reset}\n\n";

        $commands = [
            "php bin/ridium migrate"                          => "Run all migrations",
            "php bin/ridium make:migration MigrationName"     => "Create a new migration",
            "php bin/ridium make:factory FactoryName"         => "Create a new factory",
            "php bin/ridium make:model ModelName"             => "Create a new model",
            "php bin/ridium make:controller ControllerName"   => "Create a new controller",
            "php bin/ridium make:view ViewName"               => "Create a new view",
            "php bin/ridium make:component ComponentName"     => "Create a new Blade component",
            "php bin/ridium help"                             => "Show this help menu",
            "php bin/ridium seed"                             => "Run database seeders",
        ];

        foreach ($commands as $command => $description) {
            echo "{$yellow}- {$green}{$command}{$reset}\n";
            echo "    {$description}\n\n";
        }


        exit;
    }
}
