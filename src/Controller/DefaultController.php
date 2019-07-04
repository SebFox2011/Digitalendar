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
        $events = $this->getDoctrine()->getRepository(Event::class)->findAfterNow(6);
        //$events=$this->getDoctrine()->getRepository(Event::class)->findBy(
        //  [] ,['date_end'=>'desc'],6);
        return $this->render('default/index.html.twig', [
            'events' => $events
        ]);
    }
}
