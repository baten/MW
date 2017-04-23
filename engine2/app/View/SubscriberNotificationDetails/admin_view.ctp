<h1 class="page-title"><?php echo __('Subscriber Notification Detail details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($subscriberNotificationDetail['SubscriberNotificationDetail']['id']); ?></dd>

	<dt><?php echo __('Subscriber'); ?></dt>
	<dd>\<?php echo $this->Html->link($subscriberNotificationDetail['Subscriber']['id'], array('controller' => 'subscribers', 'action' => 'view', $subscriberNotificationDetail['Subscriber']['id'])); ?><dd>

</dl>
