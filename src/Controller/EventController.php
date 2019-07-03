<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Service\Slugger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/event")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/", name="event_index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository): Response
    {
        $events=$this->getDoctrine()->getRepository(Event::class)->findBy(
            [] ,['date_end'=>'desc']);

        return $this->render('event/index.html.twig', [
            'events' => $events
        ]);
    }

    /**
     * @Route("/new", name="event_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
   /* public function new(Request $request, Slugger $slugger): Response
    {
        $event = new Event();
        $form=$this->createForm(Event::class,$event);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /**
             * @var UploadedFile $pictureFile
             */
           /* $pictureFile = $form["pictureFile"]->getData();
            if ($pictureFile)
            {
                $filename=uniqid().".".$pictureFile->guessExtension();
                try{
                    $pictureFile->move($this->getParameter("upload_dir")
                        ,$filename);
                    $event->setPicture($filename);
                } catch (FileException $e){
                }
            }

            $event->setSlug($slugger->slugify($event->getTitle()));
            $event->setUser($this->getUser());
            $event->setIsValid(False);

            $em=$this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute("event_index");
        }
        return $this->render('event/new.html.twig',[
            'form'=>$form->createView()
        ]);
    }*/

    /**
     * @Route("/new", name="event_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    /*public function new(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('event_index');
        }

        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }*/

    /**
     * @Route("/new", name="event_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, Slugger $slugger): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var UploadedFile $pictureFile
             */
             $pictureFile = $form["picture"]->getData();
             if ($pictureFile)
             {
                 $filename=uniqid().".".$pictureFile->guessExtension();
                 try{
                     $pictureFile->move($this->getParameter("upload_dir")
                         ,$filename);
                     $event->setPicture($filename);
                 } catch (FileException $e){
                 }
             }

             $event->setSlug($slugger->slugify($event->getTitle()));
             $event->setUser($this->getUser());
             $event->setIsValid(False);
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($event);
             $entityManager->flush();

             return $this->redirectToRoute('event_index');
         }

         return $this->render('event/new.html.twig', [
             'event' => $event,
             'form' => $form->createView(),
         ]);
     }

     /**
      * @Route("/{slug}", name="event_show", methods={"GET"})
      */
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="event_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_index', [
                'id' => $event->getId(),
            ]);
        }

        return $this->render('event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="event_delete", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('event_index');
    }
}
