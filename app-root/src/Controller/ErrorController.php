<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ErrorController extends AbstractController
{
    public function index(Request $request): JsonResponse
    {
        return $this->json([
            'status' => 'error',
        ]);
    }
}
