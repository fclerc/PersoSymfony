<?php

namespace Silex\MoocPersonalizationBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends Controller{
    public function indexAction(){
        
        
        $kernel = $this->container->get('kernel');
        $publicPath = $kernel->locateResource('@SilexMoocPersonalizationBundle/Resources/public/');
        
        $statisticsPath = $this->get('router')->generate('statistics');
        
        return $this->render('SilexMoocPersonalizationBundle:Home:index.html.php',
                    ['publicPath' => $publicPath,
                    'statisticsPath' => $statisticsPath
                
                
                    ]);
    }
    
}