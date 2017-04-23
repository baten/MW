<h1 class="page-title"><?php echo __('Expense details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($expense['Expense']['id']); ?></dd>

	<dt><?php echo __('Expense Title'); ?></dt>
	<dd>\<?php echo $this->Html->link($expense['ExpenseTitle']['title'], array('controller' => 'expense_titles', 'action' => 'view', $expense['ExpenseTitle']['id'])); ?><dd>

	<dt><?php echo __('Amount'); ?></dt>
	<dd><?php echo h($expense['Expense']['amount']); ?></dd>

	<dt><?php echo __('Date'); ?></dt>
	<dd><?php echo h($expense['Expense']['date']); ?></dd>

	<dt><?php echo __('Details'); ?></dt>
	<dd><?php echo h($expense['Expense']['details']); ?></dd>

</dl>
