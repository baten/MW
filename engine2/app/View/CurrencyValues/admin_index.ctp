<div class="row bar bar-primary bar-top">
	<div class="col-md-3">
		<h1 class="bar-title"><?php echo __('Currency Values'); ?></h1>
	</div>
	 
</div>

<div class="row bar bar-third">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" >
			<thead>
			<tr class="info">
							<th><?php echo 'name'; ?></th>
							<th><?php echo 'value'; ?></th>
							<th><?php echo 'symbol'; ?></th>
							<th class="text-right action-th"><?php echo __('Actions'); ?></th>
			</tr>
			</thead>
			
			<tbody>
			<?php foreach ($currencyValues as $currencyValue): ?>
	<tr>
		<td><?php echo $currencyValue['CurrencyValue']['name']; ?>&nbsp;</td>
		<td><?php echo $currencyValue['CurrencyValue']['value']; ?>&nbsp;</td>
		<td><?php echo $currencyValue['CurrencyValue']['symbol']; ?>&nbsp;</td>
		<td class="text-right action">
			<?php if($currencyValue['CurrencyValue']['id'] != 1): echo $this->Html->link('<i class=\'glyphicon glyphicon-edit\'></i> Edit', array('action' => 'edit', $currencyValue['CurrencyValue']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); endif;?>
		</td>
	</tr>
<?php endforeach; ?>
			</tbody>
			</table>
		</div>
	</div>
</div>

