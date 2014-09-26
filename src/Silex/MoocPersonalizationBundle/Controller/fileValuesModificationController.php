<?php

namespace Silex\MoocPersonalizationBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FileValuesModificationController extends Controller{
    public function indexAction(){
        
        
        $kernel = $this->container->get('kernel');
        $publicPath = $kernel->locateResource('@SilexMoocPersonalizationBundle/Resources/public/');
        
        return new Response($_POST['schema']);
        
        //return $this->render('SilexMoocPersonalizationBundle:Home:index.html.php', array('publicPath' => $publicPath));
    }
    
}


?>

