<?php 
require_once __DIR__.'/../vendor/autoload.php'; 
use Phongdatgl\Smarty\ServiceProvider as SmartyServiceProvider;
$app = new Silex\Application(); 
$app['debug'] = true;
define('APP_PATH', __DIR__);
$app->register(new SmartyServiceProvider(), array(
          'smarty.dir' => APP_PATH . '/../vendor/Smarty/',
          'smarty.options' => array(
                'template_dir' => APP_PATH . '/views',
                'caching'         => false,
                'force_compile'   => false,
                'use_sub_dirs'    => false)));

$app->get('/{name}', function($name) use($app) { 
	$app['smarty']->assign('age', 25);
    return $app['smarty']->render('index.tpl', array('name'=>$name));

}); 

$app->run(); 
?>