<?php
    // required version
    if (version_compare(PHP_VERSION, "5.3.0", "<")) exit("Panel requires PHP 5.3.0 or greater.");
    // panel folder
    $backend = 'admin';
    // Separator
    define('DS', DIRECTORY_SEPARATOR);
    // Root directory
    define('ROOT', rtrim(dirname(__FILE__), '\\/'));
    // define access
    define('PANEL_ACCESS', true);
    // templates
    define('TEMPLATES', ROOT.DS.'templates');
    // partials
    define('PARTIALS', ROOT.DS.'partials');
    // views
    define('VIEWS', ROOT.DS.'views');
    // define for out of admin  ../ folder
    define('ROOTBASE', rtrim(str_replace(array($backend), array(''), dirname(__FILE__)), '\\/'));
    include_once(ROOT.DS.'api'.DS.'Morfy.panel.php');
    include_once(ROOT.DS.'api'.DS.'Morfy.routes.php');
    // check if exist this folders
    if(!Dir::exists(ROOTBASE.DS.'public'.DS.'images')) Dir::create(ROOTBASE.DS.'public'.DS.'images');
    if(!Dir::exists(ROOTBASE.DS.'public'.DS.'uploads')) Dir::create(ROOTBASE.DS.'public'.DS.'uploads');
    
?>

