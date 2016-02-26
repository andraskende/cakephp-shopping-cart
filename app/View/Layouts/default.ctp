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

    <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" />
    <?php echo $this->Html->css(array('bootstrap.min.css', 'bootstrap-theme.min.css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', 'css.css')); ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <?php echo $this->Html->script(array('bootstrap.min.js')); ?>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <?php echo $this->Html->script(array('js.js')); ?>
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
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', '<?php echo Configure::read('Settings.ANALYTICS'); ?>', '<?php echo Configure::read('Settings.DOMAIN'); ?>');
        ga('send', 'pageview');

    </script>
</head>
<body>

    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $this->Html->url('/'); ?>">CakePHP Cart</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><?php echo $this->Html->link('Home', array('controller' => 'products', 'action' => 'view')); ?></li>
                    <li><?php echo $this->Html->link('Products', array('controller' => 'products', 'action' => 'products')); ?></li>
                    <li><?php echo $this->Html->link('Brands', array('controller' => 'brands', 'action' => 'index')); ?></li>
                    <li><?php echo $this->Html->link('Categories', array('controller' => 'categories', 'action' => 'index')); ?></li>
                    <li><?php echo $this->Html->link('Search', array('controller' => 'products', 'action' => 'search')); ?></li>
                </ul>
                <ul class="navbar-form form-inline navbar-right">

                    <?php echo $this->Form->create('Product', array('type' => 'GET', 'url' => array('controller' => 'products', 'action' => 'search'))); ?>

                    <?php echo $this->Form->input('search', array('label' => false, 'div' => false, 'id' => 's', 'class' => 'input-sm s', 'autocomplete' => 'off')); ?>
                    <?php echo $this->Form->button('Search', array('div' => false, 'class' => 'btn btn-sm btn-primary')); ?>
                    &nbsp;
                    <span id="cartbutton" style="display:none;">
                        <?php echo $this->Html->link('<i class="fa fa-cart-plus"></i> &nbsp; Shopping Cart', array('controller' => 'shop', 'action' => 'cart'), array('class' => 'btn btn-sm btn-success', 'escape' => false)); ?>
                    </span>
                    <?php echo $this->Form->end(); ?>
                </ul>
            </div>
        </div>
    </div>

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

            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"></span> THIS IS A DEMO CAKEPHP SHOPPING CART !
            </div>

        </div>
    </div>

    <div class="footer">
        <div class="container">
            <?php echo $this->Html->link($this->Html->image('cake.power.gif', array('alt' => 'CakePHP', 'border' => 0)), 'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false)); ?>
            <br />
            <?php echo $this->Html->link('CakePHP Shopping Cart - github.com/andraskende/cakephp-shopping-cart', 'https://github.com/andraskende/cakephp-shopping-cart'); ?>
            <br />
            <?php echo $this->Html->link('www.shoppingcartcore.com', 'http://www.shoppingcartcore.com'); ?> - <?php echo $this->Html->link('www.kende.com', 'http://www.kende.com'); ?>
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
