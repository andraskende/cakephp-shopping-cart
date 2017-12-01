<h1>Login</h1>

<br />

<div class="row">
    <div class="col-sm-3">

        <?php echo $this->Form->create('User', ['url' => ['action' => 'login']]); ?>
        <?php echo $this->Form->input('username', ['class' => 'form-control', 'autofocus' => 'autofocus']); ?>
        <br />
        <?php echo $this->Form->input('password', ['class' => 'form-control']); ?>
        <br />
        <?php echo $this->Form->button('Login', ['class' => 'btn btn-primary']); ?>
        <?php echo $this->Form->end(); ?>
        <br />
        <br />
        <br />

    </div>
</div>