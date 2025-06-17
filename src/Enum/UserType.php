<?php

namespace App\Enum;

enum UserType: string
{
    case COMMON_MANAGER = 'Common Manager';
    case ACCOUNT_MANAGER = 'Account Manager';
    case CLIENT_MANAGER = 'Client Manager';
}
