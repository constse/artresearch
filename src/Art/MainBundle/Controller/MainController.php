<?php

namespace Art\MainBundle\Controller;

use Art\MainBundle\Entity\Mark;
use Art\MainBundle\Form\FinishForm;
use Art\MainBundle\Form\MarkForm;
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

    public function markAction($step)
    {
        $likes = $this->user->getLike()->count();
        $dislikes = $this->user->getDislike()->count();
        $selfs = $this->user->getSelf()->count();
        $steps = $likes + $dislikes + $selfs;

        if ($step > $steps) return $this->redirectToRoute('finish');

        $picture = null;
        $category = '';

        if ($step <= $likes) {
            $picture = $this->user->getLike()->toArray()[$step - 1];
            $category = 'like';
        }
        elseif ($step <= $likes + $dislikes) {
            $picture = $this->user->getDislike()->toArray()[$step - $likes - 1];
            $category = 'dislike';
        }
        else {
            $picture = $this->user->getSelf()->toArray()[$step - $likes - $dislikes - 1];
            $category = 'self';
        }

        $mark = $this->getRepository('Mark')->createQueryBuilder('m')
            ->where('m.user = :user')
            ->andWhere('m.picture = :picture')
            ->setParameters(array('user' => $this->user, 'picture' => $picture))
            ->getQuery()->getOneOrNullResult();

        if (is_null($mark)) {
            $mark = new Mark();
            $mark->setUser($this->user)->setPicture($picture);
            $this->manager->persist($mark);
            $this->manager->flush();
        }

        $form = $this->createForm(new MarkForm(), $mark);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($mark);
            $this->manager->flush();

            return $this->redirectToRoute('mark', array('step' => $step + 1));
        }

        $this->response->setContent($this->renderView('ArtMainBundle:main:mark.html.twig', array(
            'picture' => $picture,
            'step' => $step,
            'form' => $form->createView(),
            'category' => $category
        )));

        return $this->response;
    }

    public function finishAction()
    {
        $form = $this->createForm(new FinishForm(), $this->user);
        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($this->user);
            $this->manager->flush();

            return $this->redirectToRoute('pictures');
        }

        $this->response->setContent($this->renderView('ArtMainBundle:main:finish.html.twig', array(
            'form' => $form->createView()
        )));

        return $this->response;
    }
} 