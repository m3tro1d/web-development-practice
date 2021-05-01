<?php
namespace App\Module\AboutMe\Infrastructure;

use App\Module\AboutMe\App\HobbyConfigurationInterface;

class ConstHobbyConfiguration implements HobbyConfigurationInterface
{
    public function getHobbyMap(): array
    {
        return [
            'Programming',
            'The Clone Wars',
            'Dream Theater',
        ];
    }
}
