<?php

namespace App\Client;

use Symfony\Component\HttpFoundation\JsonResponse;

interface ApiClientInterface
{
    public function getAll(): JsonResponse;
}