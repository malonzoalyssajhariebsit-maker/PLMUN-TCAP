<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT c.*, d.name as department from `curriculum_list` c inner join `department_list` d on c.department_id = d.id where c.id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
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
        display:none !important;
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
    .badge-secondary {
        background: #232733 !important;
        color: #fff !important;
        font-weight: 700;
        font-size: 1rem;
        border-radius: 12px;
        padding: 0.35em 1em;
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
    .fw-bold {
        font-weight: 700 !important;
    }
    .fs-4 {
        font-size: 1.15rem !important;
    }
</style>
<div class="container-fluid">
    <dl>
        <dt class="text-muted">Department</dt>
        <dd class='pl-4 fs-4 fw-bold'><?= isset($department) ? $department : '' ?></dd>
        <dt class="text-muted">Name</dt>
        <dd class='pl-4 fs-4 fw-bold'><?= isset($name) ? $name : '' ?></dd>
        <dt class="text-muted">Description</dt>
        <dd class='pl-4'>
            <p class=""><small><?= isset($description) ? $description : '' ?></small></p>
        </dd>
        <dt class="text-muted">Status</dt>
        <dd class='pl-4'>
            <?php
            if(isset($status)):
                switch($status){
                    case '1':
                        echo "<span class='badge badge-success badge-pill'>Active</span>";
                        break;
                    case '0':
                        echo "<span class='badge badge-secondary badge-pill'>Inactive</span>";
                        break;
                }
            endif;
            ?>
        </dd>
    </dl>
    <div class="col-12 text-right">
        <button class="btn btn-flat btn-sm btn-dark" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>