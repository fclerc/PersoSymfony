<?php

namespace Silex\MoocPersonalizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SilexMoocPersonalizationBundle:Default:index.html.twig', array('name' => $name));
    }
}
