<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $title_for_layout; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

    <?php echo $this->Html->css(['bootstrap.min.css', 'admin.css']); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <?php echo $this->Html->script(['bootstrap.bundle.min.js', 'admin.js']); ?>

    <link href="/css/jquery-editable.css" rel="stylesheet"/>
    <script src="/js/jquery-editable-poshytip.min.js"></script>

    <?php echo $this->App->js(); ?>

    <?php echo $this->fetch('css'); ?>
    <?php echo $this->fetch('script'); ?>

    <script>

    $(document).ready(function() {

        $.fn.editable.defaults.mode = 'inline';

    });

    </script>


</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark" style="background-color: #000000 !important;">

        <a class="navbar-brand" href="#"> ADMIN // </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">

            <ul class="navbar-nav mr-auto">

                <li class="nav-item"><?php echo $this->Html->link('Brands', ['controller' => 'brands', 'action' => 'index', 'admin' => true], ['class' => 'nav-link']); ?></li>
                <li class="nav-item"><?php echo $this->Html->link('Categories', ['controller' => 'categories', 'action' => 'index', 'admin' => true], ['class' => 'nav-link']); ?></li>
                <li class="nav-item"><?php echo $this->Html->link('Tags', ['controller' => 'tags', 'action' => 'index', 'admin' => true], ['class' => 'nav-link']); ?></li>
                <li class="nav-item"><?php echo $this->Html->link('Products', ['controller' => 'products', 'action' => 'index', 'admin' => true], ['class' => 'nav-link']); ?></li>
                <li class="nav-item"><?php echo $this->Html->link('Product Mods', ['controller' => 'productmods', 'action' => 'index', 'admin' => true], ['class' => 'nav-link']); ?></li>
                <li class="nav-item"><?php echo $this->Html->link('Orders', ['controller' => 'orders', 'action' => 'index', 'admin' => true], ['class' => 'nav-link']); ?></li>
                <li class="nav-item"><?php echo $this->Html->link('Orders Items', ['controller' => 'order_items', 'action' => 'index', 'admin' => true], ['class' => 'nav-link']); ?></li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Utils</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <?php echo $this->Html->link('Users', ['controller' => 'users', 'action' => 'index', 'admin' => true], ['class' => 'dropdown-item']); ?>
                        <?php echo $this->Html->link('User Add', ['controller' => 'users', 'action' => 'add', 'admin' => true], ['class' => 'dropdown-item']); ?>
                        <?php echo $this->Html->link('Products CSV Export', ['controller' => 'products', 'action' => 'csv', 'admin' => true], ['class' => 'dropdown-item']); ?>
                    </div>
                </li>
            </ul>

            <div class="my-0 my-lg-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="dropdown05" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
                        <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdown05">
                            <a class="dropdown-item" href="/users/logout"><i class="fa fa-fw fa-power-off"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <br />
        <?php echo $this->Flash->render(); ?>
        <?php echo $this->fetch('content'); ?>
    </div>

    <div id="footer">
        <p>&copy; <?php echo date('Y'); ?> <?php echo env('HTTP_HOST'); ?></p>
    </div>

    <div class="sqldump">
        <?php echo $this->element('sql_dump'); ?>
    </div>

</body>
</html>

