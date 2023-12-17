<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Task2Controller extends AbstractController
{


    private function findCombination($array, $n) {
        $result = [];
      
        $this->findCombinationsHelper($array, $n, $result, [], 0);
      
        if (!empty($result)) {
            // Сортируем комбинации по убыванию количества элементов
            usort($result, function($a, $b) {
                return count($b) - count($a);
            });
            
            // Вычисляем максимальное количество выездов курьера
            $maxTrips = count($result[0]) / 2;
            
            return $maxTrips;
        } else {
            return 0; // Комбинация не найдена, количество выездов равно 0
        }
    }
    
    private function findCombinationsHelper($array, $target, &$result, $combination, $startIndex) {
        if ($target == 0 && count($combination) % 2 == 0) {
            $result[] = $combination; // Добавляем вариант комбинации
            return;
        }
      
        for ($i = $startIndex; $i < count($array); $i++) {
            if ($array[$i] <= $target) {
                $newCombination = $combination;
                $newCombination[] = $array[$i];
            
                // Рекурсивно ищем комбинации, начиная со следующего элемента
                $this->findCombinationsHelper($array, $target - $array[$i], $result, $newCombination, $i + 1);
            }
        }
    }

    #[Route('/task2', name: 'app_task2')]
    public function index(): Response
    {


        $boxes1 = [1, 5, 3, 3, 4, 2, 5, 5];
        $n1 = 6;
        $result1 = $this->findCombination($boxes1, $n1);


        $boxes2 = [2, 4, 3, 6, 1];
        $n2 = 5;
        $result2 = $this->findCombination($boxes2, $n2);


        return $this->render('task2/index.html.twig', [
            'controller_name' => 'Task2Controller',
            'scales1' => $result1,
            'scales2' => $result2,
        ]);
    }
}
