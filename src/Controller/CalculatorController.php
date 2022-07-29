<?php

namespace App\Controller;

use App\Calculator;
use App\Calculator\Form\CalculatorDto;
use App\Calculator\Form\CalculatorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    #[Route('/', methods: ['HEAD', 'GET', 'POST'])]
    public function calc(Request $request, Calculator $calculator)
    {
        $form = $this->createForm(CalculatorType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CalculatorDto $data */
            $data = $form->getData();
            $result = $calculator->calc($data->getNumberA(), $data->getNumberB(), $data->getModifier());

            return $this->redirectToRoute('app_calculator_result', ['result' => $result]);
        }

        return $this->render('calculator.html.twig', ['calculator_form' => $form->createView()]);
    }


    #[Route('/result/{result}', methods: ['HEAD', 'GET'])]
    public function result(string $result): Response
    {
        return $this->render('result.html.twig', ['result' => $result]);
    }
}