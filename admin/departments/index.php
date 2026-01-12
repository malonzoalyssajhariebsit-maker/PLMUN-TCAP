<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
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
    .table {
        background: #181c23 !important;
        color: #ffffffff !important;
        border-radius: 10px;
        overflow: hidden;
    }
    .table thead th {
        background: #616275ff !important;
        color: #fff !important;
        border: none;
        font-weight: 600;
        font-size: 1rem;
        padding: 0.75rem;
    }
    .table tbody tr {
        background: #181c23 !important;
        color: #eaeaea !important;
        border-bottom: 1px solid #282a2dff;
    }
    .table tbody tr:nth-child(even) {
        background: #232733 !important;
    }
    .table tbody tr:last-child {
        border-bottom: none;
    }
    .table td {
        padding: 0.7rem 0.5rem;
        font-size: 0.98rem;
        vertical-align: middle;
        border: none;
    }
    .badge-success {
        background: #2ecc71 !important;
        color: #fff !important;
        border-radius: 12px;
        font-size: 0.95rem;
        padding: 0.35em 1em;
    }
    .badge-secondary {
        background: #4a545eff !important;
        color: #fff !important;
        border-radius: 12px;
        font-size: 0.95rem;
        padding: 0.35em 1em;
    }
    .dropdown-menu {
        background: #181c23 !important;
        color: #fff !important;
        border-radius: 10px !important;
        border: 1.2px solid #3a4157 !important;
        box-shadow: 0 4px 16px rgba(0,0,0,0.18);
        min-width: 140px;
        padding: 0.3em 0.1em;
        font-size: 0.98rem;
    }
    .dropdown-menu .dropdown-item:hover, .dropdown-menu .dropdown-item:focus, .dropdown-menu .dropdown-item.active {
        background: #232733 !important;
        color: #4b9fff !important;
    }
    .dropdown-item {
        color: #fff !important;
        padding: 0.45em 0.8em;
        border-radius: 6px;
        font-weight: 500;
        transition: background 0.2s, color 0.2s;
        font-size: 0.98rem;
    }
    .btn.dropdown-toggle {
        background: #181c23 !important;
        color: #fff !important;
        border: 1.2px solid #3a4157 !important;
        border-radius: 10px !important;
        font-size: 0.98rem;
        font-weight: 500;
        padding: 0.35em 0.8em;
        min-width: 110px;
    }
    .btn.dropdown-toggle:after {
        margin-left: 0.7em;
        color: #fff;
        font-size: 1.1em;
    }
    body, .content-wrapper {
        background: 
            radial-gradient(circle at 20% 20%, rgba(30, 37, 47, 1), transparent 60%),
            radial-gradient(circle at 80% 30%, rgba(47, 56, 56, 0.45), transparent 60%),
            radial-gradient(circle at 50% 70%, rgba(49, 55, 57, 0.45), transparent 60%),
            radial-gradient(circle at 30% 80%, rgba(24, 12, 62, 0.45), transparent 60%),
            #000000ff !important;
    }
    .dataTables_filter label {
        position: relative;
        width: 100%;
        display: block;
        color: #fff !important;
    }
    .dataTables_filter input[type="search"] {
        border: 1.2px solid #3a4157 !important;
        background: #232733 !important;
        border-radius: 10px;
        padding: 0.7em 2.5em 0.7em 1.2em;
        font-size: 1rem;
        color: #fff;
        box-shadow: none;
        width: 220px;
        outline: none;
        transition: border 0.2s;
    }
    .dataTables_filter input[type="search"]:focus {
        border: 1.5px solid #4b9fff !important;
    }
    .dataTables_filter input[type="search"]::placeholder {
        color: #bdbdbd;
        font-weight: 500;
        opacity: 1;
    }
    .search-icon {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        background: #191a3e;
        color: #fff;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        pointer-events: none;
    }
    .dataTables_length select {
        background: #232733 !important;
        color: #fff !important;
    }
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Department</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Add New Department</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="20%">
					<col width="30%">
					<col width="15%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Name</th>
						<th>Description</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `department_list`order by `name` asc ");
						while($row = $qry->fetch_assoc()):
						
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td><?php echo ucwords($row['name']) ?></td>
							<td class="truncate-1"><?php echo $row['description'] ?></td>
							<td class="text-center">
                                <?php
                                    switch($row['status']){
                                        case '1':
                                            echo "<span class='badge badge-success badge-pill'>Active</span>";
                                            break;
                                        case '0':
                                            echo "<span class='badge badge-secondary badge-pill'>Inactive</span>";
                                            break;
                                    }
                                ?>
                            </td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
        $('#create_new').click(function(){
			uni_modal("Department Details","departments/manage_department.php")
		})
        $('.edit_data').click(function(){
			uni_modal("Department Details","departments/manage_department.php?id="+$(this).attr('data-id'))
		})
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Department permanently?","delete_department",[$(this).attr('data-id')])
		})
		$('.view_data').click(function(){
			uni_modal("Department Details","departments/view_department.php?id="+$(this).attr('data-id'))
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
	})
	function delete_department($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_department",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>