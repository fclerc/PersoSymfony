<?php

namespace Silex\MoocPersonalizationBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends Controller{
    public function indexAction(){
        
        
        $kernel = $this->container->get('kernel');
        $publicPath = $kernel->locateResource('@SilexMoocPersonalizationBundle/Resources/public/');
        
        return $this->render('SilexMoocPersonalizationBundle:Home:index.html.php', array('publicPath' => $publicPath));
    }
    
}