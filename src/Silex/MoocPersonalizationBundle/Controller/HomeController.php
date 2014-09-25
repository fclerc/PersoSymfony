<?php

namespace Silex\MoocPersonalizationBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller{
    public function indexAction(){
        return $this->render('SilexMoocPersonalizationBundle:Home:index.html.php');
    }
    
}