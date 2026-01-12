<!---ADMIN MY ACCOUNT---->


<?php 
$user = $conn->query("SELECT * FROM users where id ='".$_settings->userdata('id')."'");
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<form action="" id="manage-user">	
				<input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
				<div class="form-group">
					<label for="name">First Name</label>
					<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname']: '' ?>" required>
				</div>
				<div class="form-group">
					<label for="name">Last Name</label>
					<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname']: '' ?>" required>
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required  autocomplete="off">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
					<small><i>Leave this blank if you dont want to change the password.</i></small>
				</div>
				<div class="form-group">
					<label for="" class="control-label">Avatar</label>
					<div class="custom-file">
		              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
		              <label class="custom-file-label" for="customFile">Choose file</label>
		            </div>
				</div>
				<div class="form-group d-flex justify-content-center">
					<img src="<?php echo validate_image(isset($meta['avatar']) ? $meta['avatar'] :'') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
				</div>
			</form>
		</div>
	</div>
	<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary" form="manage-user">Update</button>
				</div>
			</div>
		</div>
</div>
<style>
body, .card.card-outline.card-primary, .card-body, .card-footer, #manage-user {
    background: #181c23 !important;
    color: #eaeaea !important;
}
.card.card-outline.card-primary {
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.25);
    border: none;
}
.card-body, .card-footer {
    border-radius: 16px;
}
label, .control-label {
    color: #7dcfff !important;
    font-weight: 700;
    font-family: 'Science Gothic', sans-serif;
}
.form-control, .custom-select, .custom-file-label {
    background: #232733 !important;
    color: #eaeaea !important;
    border: 1.5px solid #232733 !important;
    border-radius: 8px !important;
    font-family: 'Science Gothic', sans-serif;
    font-size: 1.05rem;
}
.form-control:focus, .custom-select:focus {
    background: #232733 !important;
    color: #fff !important;
    border-color: #7dcfff !important;
    box-shadow: 0 0 0 2px #7dcfff44;
}
.custom-file-input {
    background: #232733 !important;
    color: #eaeaea !important;
    border-radius: 100px !important;
}
.custom-file-label {
    background: #232733 !important;
    color: #b0b0b0 !important;
    border-radius: 8px !important;
}
.btn-primary {
    background: #7dcfff !important;
    color: #181c23 !important;
    border-radius: 8px;
    font-weight: 700;
    font-family: 'Science Gothic', sans-serif;
    box-shadow: 0 2px 8px #23273388;
    border: none;
}
.btn-primary:hover {
    background: #355c71 !important;
    color: #fff !important;
}
img#cimg {
    height: 15vh;
    width: 15vh;
    object-fit: cover;
    border-radius: 100% 100%;
    border: 2px solid #232733 !important;
    box-shadow: 0 2px 12px #23273388;
    background: #232733 !important;
}
.text-info, small, .alert-danger {
    color: #7dcfff !important;
}
.alert-danger {
    background: #232733 !important;
    color: #ff6b6b !important;
    border-radius: 8px;
    border: none;
}
</style>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage-user').submit(function(e){
		e.preventDefault();
var _this = $(this)
		start_loader()
		$.ajax({
			url:_base_url_+'classes/Users.php?f=save',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp ==1){
					location.reload()
				}else{
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_loader()
				}
			}
		})
	})

</script>