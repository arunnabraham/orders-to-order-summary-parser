<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Order\Summary\OrderSummary;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class OrderSummaryController extends AbstractController
{
    #[Route('/order-summary', name: 'order_summary', methods: ['GET'])]
    public function index(OrderSummary $orderSummary): JsonResponse
    {
        return $this->json(['orderData' => $orderSummary->generateOrderRecords()]);
    }
}
