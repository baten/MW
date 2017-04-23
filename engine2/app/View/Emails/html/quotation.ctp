Hello Admin, <br>
<?php if (is_array($data)) { ?>
    <table>
        <?php if (isset($data['product_name'])) { ?>
            <tr>
                <td>Product</td>
                <td><?php echo $data['product_name']; ?></td>
            </tr>
        <?php } ?>
        <?php if (isset($data['quantitiy'])) { ?>
            <tr>
                <td>Quantity</td>
                <td><?php echo $data['quantitiy']; ?></td>
            </tr>
        <?php } ?>
        <?php if (isset($data['description'])) { ?>
            <tr>
                <td>Product Description</td>
                <td><?php echo $data['description']; ?></td>
            </tr>
        <?php } ?>
        <?php if (isset($data['specialRqrmnt'])) { ?>
            <tr>
                <td>Special Requirement</td>
                <td><?php echo $data['specialRqrmnt']; ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } ?><br><br>

<?php if (isset($data['attachments']) and !empty($data['attachments'])) { ?>
    <br/><a href="<?php echo $data['attachments']['file_path']; ?>">Please Click Here For Download Attached File</a>
    <br/>
<?php } ?>

<br/><br/>
Thanks,<br/>
<?php echo $data['from_name'] ?><br/>

