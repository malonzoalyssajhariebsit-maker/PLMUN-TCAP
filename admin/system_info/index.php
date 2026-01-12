<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
    img#cimg{
        height: 15vh;
        width: 15vh;
        object-fit: scale-down;
        border-radius: 100% 100%;
    }
    img#cimg2{
        height: 50vh;
        width: 100%;
        object-fit: contain;
    }
    .card.card-outline.card-primary {
        background: #1f20221f !important;
        color: #fff !important;
        border: none;
        border-radius: 14px 14px 0 0 !important;
        box-shadow: 0 4px 16px rgba(0,0,0,0.18);
    }
    .card-header {
        background: #131518ff !important;
        color: #fff !important;
        border-radius: 14px 14px 0 0 !important;
        border: none;
    }
    .card-footer {
        background: #181c23 !important;
        color: #fff !important;
        border-radius: 0 0 14px 14px !important;
        border: none;
    }
    .form-control, .custom-file-input, .custom-file-label, .summernote {
        background: #232733 !important;
        color: #fff !important;
        border: 1.2px solid #3a4157 !important;
        border-radius: 8px !important;
        font-size: 1rem;
        font-weight: 500;
    }
    .form-control:focus, .custom-file-input:focus, .custom-file-label:focus, .summernote:focus {
        border: 1.5px solid #4b9fff !important;
        background: #232733 !important;
        color: #fff !important;
    }
    label, .control-label, legend {
        color: #bdbdbd !important;
        font-weight: 500;
    }
    .btn-primary {
        background: #528ae4ff !important;
        color: #fff !important;
        border-radius: 8px;
        border: none;
        font-weight: 500;
    }
    .btn.btn-primary[form="system-frm"] {
    padding: 0.7em 2.2em !important;
    font-size: 15px !important;
    border-radius: 12px !important;
    font-weight: 600 !important;
}
    .alert-danger {
        background: #232733 !important;
        color: #ff6b6b !important;
        border-radius: 8px;
        border: none;
    }
    body, .content-wrapper {
        background: 
            radial-gradient(circle at 20% 20%, rgba(30, 37, 47, 1), transparent 60%),
            radial-gradient(circle at 80% 30%, rgba(47, 56, 56, 0.45), transparent 60%),
            radial-gradient(circle at 50% 70%, rgba(49, 55, 57, 0.45), transparent 60%),
            radial-gradient(circle at 30% 80%, rgba(24, 12, 62, 0.45), transparent 60%),
            #000000ff !important;
    }
    .note-editor.note-frame, .note-editing-area .note-editable {
        background: #232733 !important;
        color: #fff !important;
        border-radius: 8px !important;
    }
    .note-editing-area .note-editable {
        min-height: 150px;
    }
    .note-toolbar {
        background: #181c23 !important;
        color: #fff !important;
        border-radius: 8px 8px 0 0 !important;
    }
    .note-toolbar .note-btn {
        background: #232733 !important;
        color: #fff !important;
        border: 1px solid #3a4157 !important;
    }
    .note-toolbar .note-btn.active, .note-toolbar .note-btn:focus, .note-toolbar .note-btn:hover {
        background: #4b9fff !important;
        color: #fff !important;
        border: 1px solid #4b9fff !important;
    }
</style>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<h5 class="card-title">System Information</h5>
			<!-- <div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_department" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
			</div> -->
		</div>
		<div class="card-body">
			<form action="" id="system-frm">
			<div id="msg" class="form-group"></div>
			<div class="form-group">
				<label for="name" class="control-label">System Name</label>
				<input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo $_settings->info('name') ?>">
			</div>
			<div class="form-group">
				<label for="short_name" class="control-label">System Short Name</label>
				<input type="text" class="form-control form-control-sm" name="short_name" id="short_name" value="<?php echo  $_settings->info('short_name') ?>">
			</div>
			<div class="form-group">
				<label for="content[about_us]" class="control-label">Welcome Content</label>
				<textarea type="text" class="form-control form-control-sm summernote" name="content[welcome]" id="welcome"><?php echo  is_file(base_app.'welcome.html') ? file_get_contents(base_app.'welcome.html') : '' ?></textarea>
			</div>
			<div class="form-group">
				<label for="content[about_us]" class="control-label">About Us</label>
				<textarea type="text" class="form-control form-control-sm summernote" name="content[about_us]" id="about_us"><?php echo  is_file(base_app.'about_us.html') ? file_get_contents(base_app.'about_us.html') : '' ?></textarea>
			</div>
			<div class="form-group">
				<label for="" class="control-label">System Logo</label>
				<div class="custom-file">
	              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
	              <label class="custom-file-label" for="customFile">Choose file</label>
	            </div>
			</div>
			<div class="form-group d-flex justify-content-center">
				<img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
			</div>
			<div class="form-group">
				<label for="" class="control-label">Cover</label>
				<div class="custom-file">
	              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="cover" onchange="displayImg2(this,$(this))">
	              <label class="custom-file-label" for="customFile">Choose file</label>
	            </div>
			</div>
			<div class="form-group d-flex justify-content-center">
				<img src="<?php echo validate_image($_settings->info('cover')) ?>" alt="" id="cimg2" class="img-fluid img-thumbnail bg-gradient-dark border-dark">
			</div>
			<fieldset>
				<legend>School Information</legend>
				<div class="form-group">
					<label for="email" class="control-label">Email</label>
					<input type="email" class="form-control form-control-sm" name="email" id="email" value="<?php echo $_settings->info('email') ?>">
				</div>
				<div class="form-group">
					<label for="contact" class="control-label">Contact #</label>
					<input type="text" class="form-control form-control-sm" name="contact" id="contact" value="<?php echo $_settings->info('contact') ?>">
				</div>
				<div class="form-group">
					<label for="address" class="control-label">Address</label>
					<textarea rows="3" class="form-control form-control-sm" name="address" id="address" style="resize:none"><?php echo $_settings->info('address') ?></textarea>
				</div>
			</fieldset>
			</form>
		</div>
		<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary" form="system-frm">Update</button>
				</div>
			</div>
		</div>

	</div>
</div>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function displayImg2(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        	$('#cimg2').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function displayImg3(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        	$('#cimg3').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(document).ready(function(){
		 $('.summernote').summernote({
		        height: 200,
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
					['insert', ['link', 'picture']],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
	})
</script>