<h1 class="page-title"><?php echo __('Subscriber Notification details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($subscriberNotification['SubscriberNotification']['id']); ?></dd>

	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo h($subscriberNotification['SubscriberNotification']['title']); ?></dd>

	<dt><?php echo __('Message'); ?></dt>
	<dd><?php echo h($subscriberNotification['SubscriberNotification']['message']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($subscriberNotification['SubscriberNotification']['created']); ?></dd>

	<dt><?php echo __('Modified'); ?></dt>
	<dd><?php echo h($subscriberNotification['SubscriberNotification']['modified']); ?></dd>

</dl>
