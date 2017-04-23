


<div class="row bar bar-primary bar-top">
    <div class="col-md-3">
        <h1 class="bar-title"><?php echo __('Please Select a Clients To create Ordder'); ?></h1>
    </div>
    <div class="col-md-9 text-right">
        <?php echo $this->Form->create('Client',array('class'=>'searchForm','data-role'=>'form')); ?>
        <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
        <?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>

        <?php echo $this->Form->end(); ?>
    </div>
</div>


<div class="row bar bar-third">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped" >
                <thead>
                <tr class="info">
                    <th><?php echo $this->Paginator->sort('name'); ?></th>
                    <th><?php echo $this->Paginator->sort('username'); ?></th>
                    <th><?php echo $this->Paginator->sort('phone'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th class="text-right action-th"><?php echo __('Actions'); ?></th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($clients as $client):
                    $clientDetails = json_decode($client['Client']['details'],true);
                    ?>
                    <tr>
                        <td><?php echo $clientDetails['fname']."".$clientDetails['lname']; ?></td>
                        <td><?php echo $this->Html->link($client['Client']['username'],"mailto:{$client['Client']['username']}",array('escape'=>false)); ?></td>
                        <td><?php if(!empty($clientDetails['phone'])): echo $clientDetails['phone'] ; endif;?></td>
                        <td><?php echo h($client['Client']['created']); ?></td>
                        <td class="text-right action">
                            <?php echo $this->Html->link('<i class=\'glyphicon glyphicon-view\'></i> Select', array('action' => 'add', $client['Client']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-warning')); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="pagination-block">
            <p>
                <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                ));
                ?>			</p>
            <div class="pagination">
                <?php
                echo $this->Paginator->prev('< ' . __('previous'),array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
                echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','currentTag'=>'a', 'currentClass'=>'current disabled'));
                echo $this->Paginator->next(__('next') . ' >', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
                ?>
            </div>
        </div>
    </div>
</div>