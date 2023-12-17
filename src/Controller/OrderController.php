<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Order;
use App\Entity\Manager;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class OrderController extends AbstractController
{

    #[Route('/order', name: 'app_order')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $orders = $doctrine->getRepository(Order::class)->findAll();
        

        foreach ($orders as $key => $order){
            $managers = $doctrine->getRepository(Manager::class)->findOneBy(['id' => $order->getManagerId()]);
            $result[$key]['id'] = $order->getId();
            $result[$key]['name'] = $order->getName();
            $result[$key]['manager'] = $managers->getFirstName().' '.$managers->getLastName();
        }

        return $this->render('order/index.html.twig', [
            'orders' => $result,
        ]);
    }
}