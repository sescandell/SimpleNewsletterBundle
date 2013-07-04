<?php

namespace Sescandell\SimpleNewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SescandellSimpleNewsletterBundle:Default:index.html.twig', array('name' => $name));
    }
}
