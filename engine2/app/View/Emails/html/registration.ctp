<?php 
	$registrantDetails = json_decode($data['Client']['details'],true);
?>
Hello <?php echo $registrantDetails['fname']?>, <br>

Thank you for completing registration.<br>
Your details are given bellow :<br>
<?php if(!empty($registrantDetails['fname'])):?>
<strong>First Name:</strong> <?php echo $registrantDetails['fname'];?><br>
<?php endif;?>
<?php if(!empty($registrantDetails['lname'])):?>
<strong>Last Name:</strong> <?php echo $registrantDetails['lname'];?><br>
<?php endif;?>
<strong>Username :</strong> <?php echo $data['Client']['username'];?><br>
For security reason, we don't send you the Password.<br>

Thank you for stay with us.<br>

Sincerely,<br>
Admin
<a href="<?php echo SITE;?>"><?php echo SITENAME;?></a>
