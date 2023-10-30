<?php

declare(strict_types=1);

namespace App\Enum;

enum PlayerCategoryEnumType: string
{
    case DEBUTANT = 'debutant';
    case POUSSIN = 'poussin';
    case BENJAMIN = 'benjamin';
    case TREIZE = 'treize';
    case QUINZE = 'quinze';
    case DIXHUIT = 'dix-huit';
}
