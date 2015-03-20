<?php

namespace Art\MainBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends InitializableController
{
    public function picturesAction($page = 1)
    {
        $pictures = $this->getRepository('Picture')->createQueryBuilder('p')
            ->orderBy('p.number', 'ASC')
            ->setFirstResult(($page - 1) * 20)
            ->setMaxResults(20)
            ->getQuery()->getResult();

        $this->response->setContent($this->renderView('ArtMainBundle:main:pictures.html.twig', array(
            'pictures' => $pictures,
            'page' => $page
        )));

        return $this->response;
    }

    public function updateCountersAction()
    {
        if (!$this->request->isXmlHttpRequest()) throw $this->createNotFoundException();

        $data = array(
            'like' => $this->user->getLike()->count(),
            'dislike' => $this->user->getDislike()->count(),
            'self' => $this->user->getSelf()->count()
        );

        return new JsonResponse($data);
    }

    public function addPictureAction($action, $number)
    {
        if (!$this->request->isXmlHttpRequest()) throw $this->createNotFoundException();

        $picture = $this->getRepository('Picture')->findOneByNumber($number);

        switch ($action) {
            case 'like': $this->user->getLike()->add($picture); break;
            case 'dislike': $this->user->getDislike()->add($picture); break;
            case 'self': $this->user->getSelf()->add($picture); break;
        }

        $this->manager->persist($this->user);
        $this->manager->flush();

        return new JsonResponse('ok');
    }
} 