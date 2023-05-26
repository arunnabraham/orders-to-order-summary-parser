<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\OrderSummary;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class OrderSummaryController extends AbstractController
{
    private array $orderRecords;

    #[Route('/order-summary', name: 'order_summary')]
    public function index(OrderSummary $orderSummary): JsonResponse
    {
        return $this->json($orderSummary->generateOrderRecords());
    }
}