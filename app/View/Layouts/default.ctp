<?php
/**
*
* PHP 5
*
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link          http://cakephp.org CakePHP(tm) Project
* @package       Cake.View.Layouts
* @since         CakePHP(tm) v 0.10.0.1076
* @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
*/

?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $title_for_layout; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php echo $this->Html->css(array('bootstrap.min.css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', 'css.css')); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <?php echo $this->Html->script(['bootstrap.bundle.min.js', 'js.js']); ?>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <?php echo $this->Html->script(array('search.js'), array('inline' => false)); ?>

    <?php echo $this->App->js(); ?>
    <?php echo $this->fetch('meta'); ?>
    <?php echo $this->fetch('css'); ?>
    <?php echo $this->fetch('script'); ?>

    <?php if($this->Session->check('Shop')) : ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#cartbutton').show();
            });
        </script>
    <?php endif; ?>

</head>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark1" style="background-color: #333;">
        <div class="container">
            <a class="navbar-brand" href="#">CakePHP 2 Shopping Cart</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><?php echo $this->Html->link('Home', ['controller' => 'products', 'action' => 'view'], ['class' => 'nav-link']); ?></li>
                    <li class="nav-item"><?php echo $this->Html->link('Products', ['controller' => 'products', 'action' => 'products'], ['class' => 'nav-link']); ?></li>
                    <li class="nav-item"><?php echo $this->Html->link('Brands', ['controller' => 'brands', 'action' => 'index'], ['class' => 'nav-link']); ?></li>
                    <li class="nav-item"><?php echo $this->Html->link('Categories', ['controller' => 'categories', 'action' => 'index'], ['class' => 'nav-link']); ?></li>
                    <li class="nav-item"><?php echo $this->Html->link('Search', ['controller' => 'products', 'action' => 'search'], ['class' => 'nav-link']); ?></li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <?php echo $this->Form->create(false, ['type' => 'get',
                        'url' => ['controller' => 'products', 'action' => 'search']
                    ]); ?>
                    <?php echo $this->Form->input('search', ['label' => false, 'div' => false, 'id' => 's', 'class' => 'form-control-sm form-control', 'autocomplete' => 'off']); ?>
                    &nbsp;
                    <?php echo $this->Form->button('Search', ['div' => false, 'class' => 'btn btn-sm btn-primary']); ?>
                    <?php echo $this->Form->end(); ?>
                    &nbsp;
                    <span id="cartbutton" style="display:none;">
                        <?php echo $this->Html->link('<i class="fa fa-cart-plus"></i> &nbsp; Shopping Cart', ['controller' => 'shop', 'action' => 'cart'], ['class' => 'btn btn-sm btn-success', 'escape' => false]); ?>
                    </span>
                </form>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container">

            <?php echo $this->Flash->render(); ?>
            <br />
            <ul class="breadcrumb">
                <?php echo $this->Html->link('Home', array('controller' => 'products', 'action' => 'index')); ?> / <?php echo $this->Html->getCrumbs(' / '); ?>
            </ul>

            <?php echo $this->fetch('content'); ?>
            <br />
            <div id="msg"></div>
            <br />

        </div>
    </div>

    <div class="footer">
        <div class="container">
            <?php echo $this->Html->link($this->Html->image('cake.power.gif', array('alt' => 'CakePHP', 'border' => 0)), 'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false)); ?>
            <br />
            <?php echo $this->Html->link('CakePHP 2 Shopping Cart - github.com/andraskende/cakephp-2-shopping-cart', 'https://github.com/andraskende/cakephp-shopping-cart'); ?>
            <br />
            <br />
            &copy; <?php echo date('Y'); ?> <?php echo env('HTTP_HOST'); ?>
            <br />
            <br />
        </div>
    </div>

    <div class="sqldump">
        <?php echo $this->element('sql_dump'); ?>
    </div>

</body>
</html>
