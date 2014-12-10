<?php
/*
 * ========================================================================
 * Copyright (c) 2014 Phongdatgl
 * Website: http://phongdatgl.biz
 * Email: phongdatgl@gmail.com
 * ------------------------------------------------------------------------
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================================
 */

namespace Phongdatgl\Smarty;

use Silex\Application;
use Silex\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface {
    public function register(Application $app) {
        $app['smarty'] = $app->share(function () use ($app) {
                if (!isset ($app['smarty.dir'])) {
                    require_once(__DIR__ . '../../../../vendor/Smarty/libs/Smarty.class.php');
                }

                if (!class_exists('Smarty') and isset ($app['smarty.dir'])) {
                    require_once($app['smarty.dir'] . '/libs/Smarty.class.php');
                }

                if (!class_exists('Smarty')) {
                    throw new \RuntimeException("Smarty class is not loaded. Please provide this option to Application->register() call.");
                }
                
                $smarty = isset($app['smarty.instance']) ? $app['smarty.instance'] : new Smarty();

                if (isset($app["smarty.options"])) {
                    foreach ($app["smarty.options"] as $smartyOptionName => $smartyOptionValue) {
                        $smarty->$smartyOptionName = $smartyOptionValue;
                    }
                }
                if( isset($app['smarty.options']['template_dir'])) {
                    $smarty->registerResource('file', new EvaledFileResource());
                    
                }
                $smarty->assign("app", $app);

                if (isset($app['smarty.configure'])) {
                    $app['smarty.configure']($smarty);
                }

                return $smarty;
            });
    }
    public function boot(Application $app)
    {
    }
}

