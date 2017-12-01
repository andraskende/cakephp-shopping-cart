
<div class="paging">

    <?php echo $this->Paginator->first('<< first', array(), null, array('class' => 'first disabled')); ?>

    <?php echo $this->Paginator->prev('< previous', array(), null, array('class' => 'prev disabled')); ?>

    <?php echo $this->Paginator->numbers(array('separator' => ' ')); ?>

    <?php echo $this->Paginator->next('next >', array(), null, array('class' => 'next disabled')); ?>

    <?php echo $this->Paginator->last('last >>', array(), null, array('class' => 'last disabled')); ?>

</div>

