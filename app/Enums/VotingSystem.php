<?php

namespace App\Enums;

enum VotingSystem: string
{
    case FPTP = 'fptp';
    case IRV = 'irv';
}
