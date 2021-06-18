<?php
declare(strict_types=1);

namespace App\Module\AboutMe\App;

interface HobbyConfigurationInterface
{
    public function getHobbyMap(): array;
}
