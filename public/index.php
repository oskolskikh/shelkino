<?php
    require_once 'Autoloader.php';
    Base\WebApplication::init(require 'config/application.config.php')->run();
