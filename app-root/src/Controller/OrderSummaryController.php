<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\OrderParse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class OrderSummaryController extends AbstractController
{
    #[Route('/order-summary', name: 'order_summary')]
    public function index(OrderParse $orderParse ): JsonResponse
    {
        return $this->json($orderParse->set());
    }
}