<?php
namespace App\Module\AboutMe\Infrastructure;

use App\Module\AboutMe\App\HobbieConfigurationInterface;

class ConstHobbieConfiguration implements HobbieConfigurationInterface
{
    public function getHobbieMap(): array
    {
        return [
            'Programming',
            'The Clone Wars',
            'Dream Theater',
        ];
    }
}
