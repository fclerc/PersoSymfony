<?php

namespace Silex\MoocPersonalizationBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SequenceAssociationController extends Controller{
    public function indexAction(){
        
        
        $kernel = $this->container->get('kernel');
        $publicPath = $kernel->locateResource('@SilexMoocPersonalizationBundle/Resources/public/');
        
        return $this->render('SilexMoocPersonalizationBundle:SequenceAssociation:index.html.php',
                    ['publicPath' => $publicPath
                    ]
        );
    }
    
}


