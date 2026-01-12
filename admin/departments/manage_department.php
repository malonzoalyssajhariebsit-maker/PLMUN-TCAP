<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `department_list` where id = '{$_GET['id']}'");
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
#uni_modal .modal-content {
    background: #181c23 !important;
    color: #fff !important;
    border-radius: 14px;
    border: none;
}
#uni_modal .modal-header {
    background: #232733 !important;
    color: #fff !important;
    border: none;
    border-radius: 14px 14px 0 0;
}
#uni_modal .modal-title {
    color: #fff !important;
}
#uni_modal label.control-label {
    color: #bdbdbd !important;
    font-weight: 500;
}
#uni_modal .form-control,
#uni_modal textarea.form-control,
#uni_modal select.form-control {
    background: #232733 !important;
    color: #fff !important;
    border: 1.2px solid #3a4157 !important;
    border-radius: 8px !important;
    font-size: 1rem;
    font-weight: 500;
}
#uni_modal .form-control:focus,
#uni_modal textarea.form-control:focus,
#uni_modal select.form-control:focus {
    border: 1.5px solid #4b9fff !important;
    background: #232733 !important;
    color: #fff !important;
}
#uni_modal .btn-primary {
    background: #528ae4ff !important;
    color: #fff !important;
    border-radius: 8px;
    border: none;
}
#uni_modal .btn-secondary, #uni_modal .btn-dark {
    background: #383e3f !important;
    color: #fff !important;
    border-radius: 8px;
    border: none;
}
</style>

<div class="container-fluid">
    <form action="" id="department-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Department Name" value ="<?php echo isset($name) ? $name : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <textarea rows="3" name="description" id="description" class="form-control form-control-border" placeholder="Write the Department description here." required><?php echo isset($description) ? $description : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="" class="control-label">Status</label>
            <select name="status" id="status" class="form-control form-control-border" required>
                <option value="1" <?= isset($status) && $status == 1 ? "selected" :"" ?>>Active</option>
                <option value="0" <?= isset($status) && $status == 0 ? "selected" :"" ?>>Inactive</option>
            </select>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#uni_modal #department-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_department",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.reload();
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    end_loader();
                }
            })
        })
    })
</script>