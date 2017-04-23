<div class="row bar bar-primary bar-top">
    <div class="col-md-12">
        <h1 class="bar-title"><?php echo __('Admin Add Product'); ?></h1>
    </div>
</div>
<div class="row bar bar-secondary">
    <div class="col-md-12">
        <?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Products', array('action' => 'index','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
    </div>
</div>
<div class="row bar bar-third">
    <div class="col-md-12">
    
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#excel_upload">Excel Upload</a></li>
            <li><a data-toggle="tab" href="#excel_download">Download Excel Format</a></li>
        </ul>
        <br>

<div class="tab-content">

<!-- ==========System insert block start================-->
     
 
<!-- ==========System insert block end================-->
    <style>
        .form-control{
            padding: 6px 2px;           
        }
        .input-datepicker-addon{
        margin:10px 0px;
        }
        .input-group-addon{
            padding: 6px 5px;
        }
        .forecast td{
            max-width: 110px;
        }
        .forecast td:last-child{
            max-width: 50px;
        }
        .forecast td:first-child{
            max-width: 80px;
        }
        .icon-container li,.forecast td:last-child{
            background-color: #153E81;          
        }

    </style>
<!-- ==========excel upload block start================-->

    <div id="excel_upload" class="tab-pane fade in active">
        <?php  echo $this->Form->create('Product',array('url'=>array('action'=>'excelImport'),'class'=>'form','type'=>'file'));?>
            <div class="row" style="padding-top: 20px">
                <div class="col-md-4">
                    <label class="btn btn-default btn-file">
                        Browse Excel file <input type="file" name="data[Product][file]" style="display: none;" onchange="$('#upload-file-info').html($(this).val());">                   
                    </label>
                    <span class='label label-info' id="upload-file-info"></span>
                </div>
                <div class="col-md-4">
                    <?php echo $this->Form->button('Upload',array('type'=>'submit','name'=>'upload','class'=>'btn btn-success btn-left-margin','label'=>false,'div'=>false));?>
               </div>              
            </div> 
        <?php echo $this->Form->end(); ?>
    </div>

<!-- ==========excel upload block end================-->

    <div id="excel_download" class="tab-pane fade">
        <div class="row" style="padding-top: 20px">           
            <div class="col-md-4">          
                <a href="<?php echo $this->webroot;?>files/excelFormat.xls" class="btn btn-primary">Download Excel</a>
            </div>
        </div>      
    </div>
</div>

   
 </div>
</div>


<script>
$(document).ready(function() {

$('.description').keyup(function(e){
   updateOutput();
});

function updateOutput(){
    var sampleInput = $('.description').val(),
        sampleInputLength = sampleInput.length;

    $('#charCounter').text(sampleInputLength);
    $('#sampleOutput').text(sampleInput);
}

});
</script>

