Hello <?php echo $data['name']; ?>, <br>
<?php echo $data['message']; ?>
<?php if (isset($data['attachments']) and !empty($data['attachments'])) { ?>
    <br/><a href="<?php echo $data['attachments']['file_path']; ?>">Please Click Here For Download Attached File</a>
    <br/>
<?php } ?>

<br/><br/>
Thanks,<br/>
<?php echo $data['from_name'] ?><br/>

