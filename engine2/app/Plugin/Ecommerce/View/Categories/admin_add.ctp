<div class="row bar bar-primary bar-top">
    <div class="col-md-12">
        <h1 class="bar-title"><?php echo __('Admin Add Category'); ?></h1>
    </div>
</div>

<div class="row bar bar-secondary">
    <div class="col-md-12">
        <?php echo $this->Html->link('<i class=\'glyphicon glyphicon-list\'></i> List Categories', array('action' => 'index', 'admin' => true), array('escape' => false, 'class' => 'btn btn-success')); ?>
    </div>
</div>

<div class="row bar bar-third">
    <div class="col-md-12">
        <?php
        echo $this->Form->create('Category', array('class' => 'form', 'type' => 'file'));

        echo $this->Form->input('parent_id', array('options' => $parentCategories, 'empty' => true, 'class' => 'form-control', 'div' => array('class' => 'form-group')));
        echo $this->Form->input('title', array('class' => 'form-control', 'div' => array('class' => 'form-group')));
        echo $this->Form->input('meta_keys', array('class' => 'form-control', 'div' => array('class' => 'form-group')));
        echo $this->Form->input('meta_description', array('type' => 'textarea', 'class' => 'form-control', 'div' => array('class' => 'form-group')));
        echo $this->Form->input('description', array('type' => 'textarea', 'class' => 'form-control editor', 'div' => array('class' => 'form-group')));
        echo $this->Form->input('CategoryImage.image', array('label' => 'Feature Image','type' => 'file', 'onchange' => 'catUploadThumb(this)', 'div' => array('class' => 'form-group'))); 
        echo $this->Form->input('CategoryImage.thumbImage', array('label'=>'Image','type' => 'file', 'div' => array('class' => 'form-group'),'after' => '<spna class="text-danger">Image Resulation : (width:1400) X  (Height:220px)</span>'));
       ?>
       <?php
            echo $this->Form->input('is_featured', 
                array('div' => true,
                'label' => false,
                'type' => 'checkbox',
                'before' => '<label class="checkbox">',
                'after' => 'Is Featured</label>'
                )); 
            
              
        echo $this->Form->input('status', array('options' => $status, 'class' => 'form-control', 'div' => array('class' => 'form-group')));
        echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-warning', 'label' => false, 'div' => false));
        echo $this->Form->button('Submit', array('type' => 'submit', 'class' => 'btn btn-success btn-left-margin', 'label' => false, 'div' => false));

        echo $this->Form->end();
        ?>    </div>
</div>


<script>
    function catUploadThumb(selector) {
        var file = selector.files[0];
        if (file) {
            var reader = new FileReader();
            var file_data = reader.readAsDataURL(file);
            reader.onload = function (evt) {
                $('.upload-image-thumbnail').remove();
                $('<img class="img-responsive upload-image-thumbnail" src="' + evt.target.result + '">').insertAfter(selector)
            }
        }
    }

</script>

<style>
    .upload-image-thumbnail {
        margin-top: 10px;
    }
</style>