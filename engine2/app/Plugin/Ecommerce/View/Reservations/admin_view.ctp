<h1 class="page-title"><?php echo __('Reservation details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($reservation['Reservation']['id']); ?></dd>

	<dt><?php echo __('Name'); ?></dt>
	<dd><?php echo h($reservation['Reservation']['name']); ?></dd>

	<dt><?php echo __('Email'); ?></dt>
	<dd><?php echo h($reservation['Reservation']['email']); ?></dd>

	<dt><?php echo __('Phone'); ?></dt>
	<dd><?php echo h($reservation['Reservation']['phone']); ?></dd>

	<dt><?php echo __('Date'); ?></dt>
	<dd><?php echo h($reservation['Reservation']['date']); ?></dd>

	<dt><?php echo __('Time'); ?></dt>
	<dd><?php echo h($reservation['Reservation']['time']); ?></dd>

	<dt><?php echo __('Num Of Person'); ?></dt>
	<dd><?php echo h($reservation['Reservation']['num_of_person']); ?></dd>

	<dt><?php echo __('Message'); ?></dt>
	<dd><?php echo h($reservation['Reservation']['message']); ?></dd>

	<dt><?php echo __('Type'); ?></dt>
	<dd><?php echo h($reservation['Reservation']['type']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($reservation['Reservation']['created']); ?></dd>

</dl>
