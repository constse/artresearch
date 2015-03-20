<?php

namespace Art\MainBundle\Controller;

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
} 