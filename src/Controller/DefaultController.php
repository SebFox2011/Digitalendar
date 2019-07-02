<?php

namespace App\Controller;

use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
       //$events=$this->getDoctrine()->getRepository(Event::class)->findAll();
        $events=$this->getDoctrine()->getRepository(Event::class)->findBy(
           [] ,['date_start'=>'DESC'],6);

        return $this->render('default/index.html.twig', [
            'events' => $events
        ]);
    }
}
