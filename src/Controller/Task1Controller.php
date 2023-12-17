<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Test
{
    public $next;
    public $x;

    public function __construct(int $x)
    {
        $this->x = $x;
    }
}



class Task1Controller extends AbstractController
{

    private function reverseObjects(Test $head)
    {
        $prev = null;
        $current = $head;
        $next = null;
    
        while ($current !== null) {
            $next = $current->next;
            $current->next = $prev;
            $prev = $current;
            $current = $next;
        }
    
        return $prev;
    }

    #[Route('/task1', name: 'app_task1')]
    public function index(): Response
    {

        // Создаем тестовые объекты
        $a = new Test(1);
        $b = new Test(2);
        $c = new Test(3);

        // Связываем объекты между собой
        $a->next = $b;
        $b->next = $c;
        $c->next = null;

        // Вывод перед переворотом
        var_dump($a);

        // Переворачиваем объекты
        $reversedHead = $this->reverseObjects($a);

        // Вывод после переворота
        var_dump($reversedHead);
        
        return $this->render('task1/index.html.twig');
    }
}
