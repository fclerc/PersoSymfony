<?php $view->extend('SilexMoocPersonalizationBundle::layout.html.php') ?>

<?php

$lang = $view['request']->getLocale(); 

?>

<?php $view['slots']->start('stylesheets') ?>
    <link href="css/d3.css" type="text/css" rel="stylesheet"/>
<?php $view['slots']->stop() ?>


<div class="container">
    Hello
</div>