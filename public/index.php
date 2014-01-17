<?php
    require_once 'Autoloader.php';
    Loader\Autoloader::register();
    $application = new Base\WebApplication(require '../config/application.config.php');
    