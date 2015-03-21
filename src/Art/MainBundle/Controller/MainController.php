<?php

namespace Art\MainBundle\Controller;

use Art\MainBundle\Entity\Mark;
use Art\MainBundle\Entity\User;
use Art\MainBundle\Form\FinishForm;
use Art\MainBundle\Form\MarkForm;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends InitializableController
{
    public function clearAction()
    {
        $this->response->headers->clearCookie('user');
        $this->response->setContent('<h1>Cookie успешно сброшены</h1>');

        return $this->response;
    }

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

        if ($this->user->getLike()->contains($picture)) {
            $this->user->getLike()->removeElement($picture);
            $this->manager->persist($picture);
            $this->manager->flush();
        }

        if ($this->user->getDislike()->contains($picture)) {
            $this->user->getDislike()->removeElement($picture);
            $this->manager->persist($picture);
            $this->manager->flush();
        }

        if ($this->user->getSelf()->contains($picture)) {
            $this->user->getSelf()->removeElement($picture);
            $this->manager->persist($picture);
            $this->manager->flush();
        }

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
            $this->user->setFinished(true);
            $this->manager->persist($this->user);
            $this->manager->flush();

            return $this->redirectToRoute('pictures');
        }

        $this->response->setContent($this->renderView('ArtMainBundle:main:finish.html.twig', array(
            'form' => $form->createView()
        )));

        return $this->response;
    }

    public function adminAction()
    {
        $users = $this->getRepository('User')->createQueryBuilder('u')
            ->where('u.finished = :finished')
            ->setParameters(array('finished' => true))
            ->orderBy('u.modifiedAt', 'DESC')
            ->getQuery()->getResult();

        $this->response->setContent($this->renderView('ArtMainBundle:main:admin.html.twig', array(
            'users' => $users
        )));

        return $this->response;
    }

    public function exportAction($user)
    {
        /** @var User $user */
        $user = $this->getRepository('User')->find($user);
        $excel = '';
        $names = array(
            'Svetlaya-Tyomnaya',
            'Yarkaya-Tusklaya',
            'Horoshaya-Plohaya',
            'Aktivnaya-Passivnaya',
            'Tyoplaya-Holodnaya',
            'Radostnaya-Grustnaya',
            'Solnechnaya-Pasmurnaya',
            'Blizkaya-Dalyokaya',
            'Buduschee-Proshloe',
            'Priyatnaya-Ottalkivayuschaya',
            'Facturnaya-Sglazhennaya',
            'Garmonichnaya-Disgarmonichnaya',
            'Aromatnaya-Udushlivaya',
            'Legkaya-Tyazhyolaya',
            'Prostaya-Slozhnaya',
            'Krasivaya-Urodlivaya',
            'Effektnaya-Obychnaya',
            'Fantasticheskaya-Realnaya',
            'Letnyaya-Zimnyaya',
            'Haotichnaya-Uporyadochennaya',
            'Ekspressivnaya-Spokojnaya',
            'Detalnaya-Razmytaya',
            'Raznotsvetnaya-Monohromnaya',
            'Obyomnaya-Ploskaya',
            'Vzroslaya-Detskaya',
            'Podvizhnaya-Statichnaya',
            'Grubaya-Nezhnaya',
            'Agressivnaya-Uravnoveshennaya',
            'Originalnaya-Banalnaya',
            'Otchetlivaya-Zatumanennaya'
        );

        $select = 'p.number AS pic';

        for ($i = 1; $i <= 30; $i++) $select .= ', m.mark' . $i . ' AS m' . $i;

        $pictures = array();

        foreach ($user->getLike() as $picture) $pictures[] = $picture->getId();

        $marks = $this->getRepository('Mark')->createQueryBuilder('m')
            ->select($select)
            ->leftJoin('m.picture', 'p')
            ->where('m.user = :user')
            ->andWhere('p.id IN (:pictures)')
            ->setParameters(array('user' => $user, 'pictures' => $pictures))
            ->getQuery()->getArrayResult();

        $excel .= "\"Nravyatsya\"\r\n\"\";";

        foreach ($marks as $mark) $excel .= "\"" . $mark['pic'] . "\";";

        $excel .= "\r\n";

        for ($i = 1; $i <= 30; $i++) {
            $excel .= "\"" . $names[$i - 1] . "\";";

            foreach ($marks as $mark) $excel .= "\"" . str_replace('.', ',', $mark['m' . $i]) . "\";";

            $excel .= "\r\n";
        }

        $pictures = array();

        foreach ($user->getDislike() as $picture) $pictures[] = $picture->getId();

        $marks = $this->getRepository('Mark')->createQueryBuilder('m')
            ->select($select)
            ->leftJoin('m.picture', 'p')
            ->where('m.user = :user')
            ->andWhere('p.id IN (:pictures)')
            ->setParameters(array('user' => $user, 'pictures' => $pictures))
            ->getQuery()->getArrayResult();

        $excel .= "\r\n\"Ottalkivaet\";\r\n\"\";";

        foreach ($marks as $mark) $excel .= "\"" . $mark['pic'] . "\";";

        $excel .= "\r\n";

        for ($i = 1; $i <= 30; $i++) {
            $excel .= "\"" . $names[$i - 1] . "\";";

            foreach ($marks as $mark) $excel .= "\"" . str_replace('.', ',', $mark['m' . $i]) . "\";";

            $excel .= "\r\n";
        }

        $pictures = array();

        foreach ($user->getSelf() as $picture) $pictures[] = $picture->getId();

        $marks = $this->getRepository('Mark')->createQueryBuilder('m')
            ->select($select)
            ->leftJoin('m.picture', 'p')
            ->where('m.user = :user')
            ->andWhere('p.id IN (:pictures)')
            ->setParameters(array('user' => $user, 'pictures' => $pictures))
            ->getQuery()->getArrayResult();

        $excel .= "\r\n\"Sam by napisal\";\r\n\"\";";

        foreach ($marks as $mark) $excel .= "\"" . $mark['pic'] . "\";";

        $excel .= "\r\n";

        for ($i = 1; $i <= 30; $i++) {
            $excel .= "\"" . $names[$i - 1] . "\";";

            foreach ($marks as $mark) $excel .= "\"" . str_replace('.', ',', $mark['m' . $i]) . "\";";

            $excel .= "\r\n";
        }

        $this->response->headers->set('Content-Type', 'text/csv');
        $this->response->headers->set('Content-Disposition', 'attachment; filename=export.csv');
        $this->response->setContent($excel);

        return $this->response;
    }

    public function checkPictureAction($number)
    {
        if (!$this->request->isXmlHttpRequest()) throw $this->createNotFoundException();

        $picture = $this->getRepository('Picture')->findOneByNumber($number);

        if ($this->user->getLike()->contains($picture)) return new JsonResponse('like');

        if ($this->user->getDislike()->contains($picture)) return new JsonResponse('dislike');

        if ($this->user->getSelf()->contains($picture)) return new JsonResponse('self');

        throw $this->createNotFoundException();
    }
} 