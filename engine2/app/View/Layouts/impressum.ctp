<!DOCTYPE html>
<html>
<head>
 <?php echo $this->Html->charset(); ?> 
 <title>Thai Atriums</title>
 <?php echo $this->Html->meta(array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge'));?>
 <?php echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'));?>
 <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webroot; ?>img/favicon.png"> 
 <?php echo $this->Html->meta(array('name' => 'author','content'=>'mipellim'));?>

<?php echo $this->Html->css(array('shops/main'));?>
</head>

<body style="padding:15px">
<?php echo $this->fetch('content'); ?>
</body>
</html>