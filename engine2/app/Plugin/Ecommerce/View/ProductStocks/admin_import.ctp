<div class="row bar bar-primary bar-top">
    <div class="col-md-12">
        <h1 class="bar-title">Upload Stocks for Product "<?php echo $products['Product']['title'];?>"</h1>
    </div>
</div>
<div class="row bar bar-secondary">
    <div class="col-md-12">
        <?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> Stocks', array('controller'=>'product_stocks','action' => 'index',$products['Product']['id'],'admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
    </div>
</div>

<div class="row bar bar-third">
    <div class="col-md-12">
         <div id="excel_upload" class="tab-pane fade in active">
            <?php  echo $this->Form->create('ProductStock',array('url'=>array('action'=>'import'),'class'=>'form','type'=>'file'));?>
                <div class="row" style="padding-top: 20px">
                    <div class="col-md-4">
                    <input type="hidden" name="data[Product][id]" value="<?php echo $products['Product']['id'];?>">
                        <label class="btn btn-default btn-file">
                            Browse Excel file <input type="file" name="data[ProductStock][file]" style="display: none;" onchange="$('#upload-file-info').html($(this).val());">                   
                        </label>
                        <span class='label label-info' id="upload-file-info"></span>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->button('Upload',array('type'=>'submit','name'=>'upload','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));?>
                   </div>              
                </div> 
            <?php echo $this->Form->end(); ?>
        </div>              
    </div>
</div>
