<?php
/* all requested variable */

 
/* style (css)  part start */
$body = '	font-family: "Open Sans",sans-serif; font-size: 13px; line-height: 18px; box-sizing: border-box;';
$container = 'width: 970px; margin-left: auto;margin-right: auto; padding-left: 0px; padding-right: 0px;';
$table = 'border-collapse: collapse; border-spacing: 0; margin-bottom: 20px; max-width: 100%; width: 100%; border: 1px solid #ddd;';
$td = 'border: 1px solid #ddd;line-height: 1.42857;padding: 8px;vertical-align: top; color:#333333; font-size:13px;';
$th = 'border-bottom: 2px solid #ddd;vertical-align: bottom;';
$clear_both = 'clear:both;';
$row = ' margin-left: -15px;margin-right: -15px;';
$col_all = 'min-height: 1px;position: relative; float:left;';
$col_md_3 = 'width:33.3%';
$col_md_4 = 'width:25%;';
$col_md_6 = 'width:50%;';
$col_md_12 = 'width:100%';
$table_responsive = 'min-height: 0.01%;overflow-x: auto;';
$img_responsive = 'display: block;height: auto; max-width: 100%;';
$img_thumbnail = 'background-color: #fff; border: 1px solid #ddd;border-radius: 4px;display: inline-block; height: auto; line-height: 1.42857; max-width: 100%;padding: 4px;transition: all 0.2s ease-in-out 0s;';
$img_circle = 'border-radius: 50%;';
$hr = ' -moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;border-color: #ddd; -moz-use-text-color -moz-use-text-color;border-image: none; border-right: 0 none;border-style: solid none none;border-width: 1px 0 0;margin-bottom: 20px;margin-top: 20px;';
$sr_only = 'border: 0 none;clip: rect(0px, 0px, 0px, 0px);height: 1px;margin: -1px;overflow: hidden; padding: 0;position: absolute;width: 1px;';
$h_group = 'color: inherit;font-family: inherit;font-weight: bold;line-height: 1.1;margin-bottom: 10px;margin-top: 20px; padding-bottom:10px;color:#683982;';
$border_bottom = 'border-bottom:1px solid #ddd;';
$text_left = 'text-align: left;';
$text_right = 'text-align: right;';
$text_center = 'text-align: center;';
$text_justify = 'text-align: justify;';
$text_lowercase = 'text-transform: lowercase;';
$text_uppercase = 'text-transform: uppercase;';
$text_capitalize = 'text-transform: capitalize;';
$header_style = 'background-color:#ff000e; color:white; line-height:35px;font-size:12px;text-align:center;';
$btn = '-moz-user-select: none;background-image: none;border: 1px solid transparent;border-radius: 4px;cursor: pointer;display: inline-block;font-size: 14px;font-weight: 400;line-height: 1.42857;margin-bottom: 0;padding: 6px 12px;text-align: center;vertical-align: middle;white-space: nowrap;background-color:#ff000e; width:92%; color:white;';
$heading = ' border-bottom: 2px solid #d10101;
    font-family: "Raleway",sans-serif;
    font-size: 17px;
    line-height: 23px;
    margin: 10px 0;
    padding: 0 0 4px;
    text-transform: uppercase;color:#ff000e;';
/* style (css)  part end */
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Email Tamplete</title>
    </head>
<body style=' <?php echo $body; ?> '>
	<section class="Client Part">
    	<div style=' <?php echo $container; ?> '>
	        <div style=' <?php echo $row; ?> '>
	        <div style=' text-align:center; '><img style="margin-bottom:20px;" class="center-block img-responsive"
                                                   src="<?php echo SITE ;?>/engine/img/site/<?php echo $data['SiteSetting']['id'] . '.png'; ?>"
                                                   alt="logo"></div>
	        	<table style=' <?php echo $table; ?> border:none;'>
	        		<?php if($data['status'] == 'verification'):?>
					<tr>
						<td valign="top" style="padding:20px;background-color:#f1f1f1">
							<p style="padding:0 0 20px; margin:0; font-size:14px; line-height:18px; color:#808080; font-family:Helvetica;">If you want to become a subscriber,Please click this link:</p>
		   					<p style="padding:0 0 5px; margin:0; font-size:16px; color:#808080; font-family:Helvetica;"><b style="color:#000;"><a href="<?php echo SITE.'/subscription/'.$data['status'].'/'.$data['Subscriber']['token'];?>"><?php echo $data['Subscriber']['token'];?></a></p>
						</td>
					</tr>
					<?php else:?>
					<tr>
						<td valign="top" style="padding:20px;background-color:#f1f1f1">
		   					<p style="padding:0 0 20px; margin:0; font-size:14px; line-height:18px; color:#808080; font-family:Helvetica;">Dear valued subscriber,</p>
							<p style="padding:0 0 20px; margin:0; font-size:14px; line-height:18px; color:#808080; font-family:Helvetica;">If you want to unsubscribe,Please click this link:</p>
							<p style="padding:0 0 5px; margin:0; font-size:16px; color:#808080; font-family:Helvetica;"><b style="color:#000;"><a href="<?php echo SITE .'/subscription/'.$data['status'].'/'.$data['Subscriber']['token'];?>"><?php echo $data['Subscriber']['token'];?></a></p>
						</td>
					</tr>
					<?php endif;?>
	        	</table>
	        	
	        	<table style="margin:20px 0;" border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter">
		   	<tr>
		   		<td>Thanks,</td>
		   	</tr>
		   	<tr>
		   		<td>Matjar Alwatani Team.</td>
		   	</tr>
		</table>
	        </div>
        </div>
	</section>
      
</body>
<?php //exit();?>
 
