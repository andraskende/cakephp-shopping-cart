<?php
header('content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<?php echo $this->fetch('content'); ?>
