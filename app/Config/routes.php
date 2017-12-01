<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

    Router::connect('/', ['controller' => 'products', 'action' => 'index']);

    Router::connect('/product/:slug', ['controller' => 'products', 'action' => 'view'], ['pass' => ['slug']]);

    Router::connect('/brand/:slug', ['controller' => 'brands', 'action' => 'view'], ['pass' => ['slug']]);

    Router::connect('/category/:slug', ['controller' => 'categories', 'action' => 'view'], ['pass' => ['slug']]);

    Router::connect('/sitemap.xml', ['controller' => 'products', 'action' => 'sitemap']);

    Router::connect('/admin', ['controller' => 'users', 'action' => 'dashboard', 'admin' => true]);
    Router::connect('/customer', ['controller' => 'users', 'action' => 'dashboard', 'customer' => true]);

/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
    Router::connect('/pages/*', ['controller' => 'pages', 'action' => 'display']);

/**
 * Load all plugin routes.  See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
    CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
    require CAKE . 'Config' . DS . 'routes.php';

