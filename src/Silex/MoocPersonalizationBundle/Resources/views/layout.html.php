<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>Personalize your MOOC experience</title>
        
         <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('bundles/silexmoocpersonalization/css/main.css') ?>">
         <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('bundles/silexmoocpersonalization/css/bootstrap.min.css') ?>">
        
        <?php $view['slots']->output('stylesheets') ?>
        
        
    </head>
    
    <body>
        
        <?php $view['slots']->output('_content') ?>
        
    </body>
    
</html>