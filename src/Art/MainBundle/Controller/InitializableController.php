<?php

namespace Art\MainBundle\Controller;

use Art\MainBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class InitializableController extends Controller
{
    /** @var EntityManager */
    protected $manager;
    /** @var array|EntityRepository[] */
    protected $repositories;
    /** @var Response */
    protected $response;
    /** @var Request */
    protected $request;
    /** @var User */
    protected $user;

    /**
     * @param $entity
     * @return EntityRepository
     */
    public function getRepository($entity)
    {
        if (!array_key_exists($entity, $this->repositories))
            $this->repositories[$entity] = $this->manager->getRepository('ArtMainBundle:' . $entity);

        return $this->repositories[$entity];
    }

    public function initialize(Request $request)
    {
        $this->request = $request;

        $this->manager = $this->getDoctrine()->getManager();
        $this->repositories = array();
        $this->response = new Response();
        $this->user = null;

        if ($this->request->cookies->has('user'))
            $this->user = $this->getRepository('User')->find($this->request->cookies->get('user', null));

        if (is_null($this->user)) {
            $this->user = new User();
            $this->manager->persist($this->user);
            $this->manager->flush();

            $this->response->headers->setCookie(new Cookie('user', $this->user->getId()));
        }
    }

    public function renderView($view, array $parameters = array())
    {
        $parameters = array_merge($parameters, array('user' => $this->user));

        return parent::renderView($view, $parameters);
    }
} 