<?php
use aabc\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['id' => 'file-input','multiple' => true, 'accept' => 'image/*']) ?>
   
    <button>Submit</button>

<?php ActiveForm::end() ?>

<script src="http://localhost/20170715/ad/assets/273b8bce/jquery.js"></script>

<div id="preview"></div>


<script type="text/javascript">
    finalFiles = {};

	function previewImages() {

	  var $preview = $('#preview').empty();

       $.each(this.files,function(idx,elm){
           finalFiles[idx]=elm;
        });

	  if (this.files) $.each(this.files, readAndPreview);

	  function readAndPreview(i, file) {
	    
	    if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
	      return alert(file.name +" is not an image");
	    } // else...
	    
	    var reader = new FileReader();

	    $(reader).on("load", function() {
	      $preview.append($("<img/>", {src:this.result, height:100, id: 'pre_'+file.name}));
	    });

	    reader.readAsDataURL(file);
	    
	  }

	}

	$("#clear").click(function () {
        delete finalFiles[1];
		// console.log($('#file-input').val());
	})

	$('#file-input').on("change", previewImages);
</script>







<style type="text/css">
	#preview img {
	    height: 100px;
	    margin: 10px;
	    border: 1px solid #eee;
	}
</style>




