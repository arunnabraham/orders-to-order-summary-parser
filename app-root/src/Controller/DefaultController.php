<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'default', methods: ['GET'])]
    public function index(Request $request): JsonResponse
    {
        return $this->json([
            'gotoOrderSummary' => sprintf(
                '%s/order-summary',
                $request->getSchemeAndHttpHost()
            ),
        ]);
    }
}
