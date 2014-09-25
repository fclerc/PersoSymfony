<?php

namespace Silex\MoocPersonalizationBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PersoController extends Controller{
    public function indexAction(){
        //return new Response('Hello');
        return $this->render('SilexMoocPersonalizationBundle:Perso:index.html.twig');
    }
    
}