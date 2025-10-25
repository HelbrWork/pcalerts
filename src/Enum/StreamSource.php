<?php

namespace App\Enum;

enum StreamSource: string
{
    case FACEBOOK = 'facebook';
    case TWITTER = 'twitter';
    case GOOGLE = 'google';
}
