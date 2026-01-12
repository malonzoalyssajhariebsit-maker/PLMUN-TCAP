<?php 
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $user = $conn->query("SELECT s.*,d.name as department, c.name as curriculum,CONCAT(lastname,', ',firstname,' ',middlename) as fullname FROM student_list s inner join department_list d on s.department_id = d.id inner join curriculum_list c on s.curriculum_id = c.id where s.id ='{$_GET['id']}'");
    foreach($user->fetch_array() as $k =>$v){
        $$k = $v;
    }
}
?>
<style>
    body, #uni_modal .container-fluid {
        background: #181c23 !important;
        color: #eaeaea !important;
    }
    #uni_modal .modal-content {
        background: #181c23 !important;
        color: #eaeaea !important;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.25);
    }
    #uni_modal .modal-footer{
        display:none;
    }
    .student-img {
        object-fit:scale-down;
        object-position:center center;
        background: #232733 !important;
        border-radius: 12px;
        border: 2px solid #232733 !important;
        box-shadow: 0 2px 12px #23273388;
        padding: 0.5em;
    }
    dl dt {
        color: #7dcfff !important;
        font-weight: 700;
        font-size: 1.08rem;
        font-family: 'Science Gothic', sans-serif;
    }
    dl dd {
        color: #eaeaea !important;
        font-size: 1.05rem;
        font-family: 'Science Gothic', sans-serif;
    }
    .badge-success {
        background: #2ecc71 !important;
        color: #fff !important;
        font-weight: 700;
        font-size: 1rem;
        border-radius: 12px;
        padding: 0.35em 1em;
    }
    .badge-primary {
        background: #232733 !important;
        color: #fff !important;
        font-weight: 700;
        font-size: 1rem;
        border-radius: 12px;
        padding: 0.35em 1em;
    }
    .border {
        border: 2px solid #232733 !important;
        border-radius: 12px !important;
        box-shadow: 0 2px 12px #23273388;
    }
    .text-navy {
        color: #7dcfff !important;
    }
    .font-weight-bold {
        font-weight: 700 !important;
    }
    .btn-dark {
        background: #232733 !important;
        color: #fff !important;
        border-radius: 8px;
        font-weight: 700;
        font-family: 'Science Gothic', sans-serif;
        box-shadow: 0 2px 8px #23273388;
    }
    .btn-dark:hover {
        background: #355c71 !important;
        color: #fff !important;
    }
    .text-muted {
        color: #b0b0b0 !important;
    }
</style>
<div class="container-fluid">
	<div class="col-md-12">
		<div class="row">
			<div class="col-6">
				<center>
					<img src="<?= validate_image($avatar) ?>" alt="Student Image" class="img-fluid student-img bg-gradient-dark border">
				</center>
			</div>
			<div class="col-6">
				<dl>
					<dt class="text-navy">Student Name:</dt>
					<dd class="pl-4"><?= ucwords($fullname) ?></dd>
					<dt class="text-navy">Student Number:</dt>
					<dd class="pl-4"><?= $student_number ?></dd>
					<dt class="text-navy">Gender:</dt>
					<dd class="pl-4"><?= ucwords($gender) ?></dd>
					<dt class="text-navy">Email:</dt>
					<dd class="pl-4"><?= $email ?></dd>
					<dt class="text-navy">Department:</dt>
					<dd class="pl-4"><?= ucwords($department) ?></dd>
					<dt class="text-navy">Course:</dt>
					<dd class="pl-4"><?= ucwords($curriculum) ?></dd>
					<dt class="text-navy">System Account Status:</dt>
					<dd class="pl-4">
						<?php if($status == 1): ?>
							<span class="badge badge-pill badge-success">Verified</span>
						<?php else: ?>
						<span class="badge badge-pill badge-primary">Not Verified</span>
						<?php endif; ?>
					</dd>
				</dl>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-6 text-center">
				<label class="text-navy font-weight-bold">ID Picture (Front)</label><br>
				<?php if(!empty($id_front)): ?>
					<img src="<?= validate_image($id_front) ?>" alt="ID Front" class="img-fluid border" style="max-width:180px;max-height:180px;">
				<?php else: ?>
					<span class="text-muted">No ID Front Uploaded</span>
				<?php endif; ?>
			</div>
			<div class="col-6 text-center">
				<label class="text-navy font-weight-bold">ID Picture (Back)</label><br>
				<?php if(!empty($id_back)): ?>
					<img src="<?= validate_image($id_back) ?>" alt="ID Back" class="img-fluid border" style="max-width:180px;max-height:180px;">
				<?php else: ?>
					<span class="text-muted">No ID Back Uploaded</span>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-right">
				<button class="btn btn-dark btn-flat btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Close</button>
			</div>
		</div>
	</div>
</div>