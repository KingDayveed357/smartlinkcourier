<div class="container-fluid">
    <form action="" id="update_status">
    <input type="hidden" name="parcel_id" value="<?php echo $_GET['id'] ?>">
        <div class="form-group">
            <label for="">Update History</label>
            <?php $status_arr = array("Item Accepted by Courier","Collected","Shipped","In-Transit","Arrived At Destination","Out for Delivery","Ready to Pickup","Delivered","Picked-up","On-hold"); ?>
            <select name="status" id="" class="custom-select custom-select-sm">
                <?php foreach($status_arr as $k => $v): ?>
                    <option value="<?php echo $k ?>" <?php echo $_GET['cs'] == $k ? "selected" :'' ?>><?php echo $v; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="">Location</label>
            <input name="location" required="" class="form-control form-control-sm" placeholder="Location">
            <label for="">Comments</label>
            <input name="comments" class="form-control form-control-sm" placeholder="Comments">
            <label for="">Date</label>
            <input name="timestamp" type="datetime-local" required="" class="form-control form-control-sm">
        </div>
    </form>
</div>

<div class="modal-footer display p-0 m-0">
    <button class="btn btn-primary" form="update_status">Update</button>
    <button type="button" class="btn btn-secondary" onclick="uni_modal('Parcel\'s Details','view_parcel.php?id=<?php echo $_GET['id'] ?>','large')">Close</button>
</div>
<style>
    #uni_modal .modal-footer{
        display: none
    }
    #uni_modal .modal-footer.display{
        display: flex
    }
</style>
<script>
    $('#update_status').submit(function(e){
        e.preventDefault();
        start_load();
        $.ajax({
            url:'ajax.php?action=update_history',
            method:'POST',
            data:$(this).serialize(),
            error:(err)=>{
                console.log(err);
                alert_toast('An error occurred.',"error");
                end_load();
            },
            success:function(resp){
                if(resp==1){
                    alert_toast("Parcel's shipping history successfully updated",'success');
                    setTimeout(function(){
                        location.reload();
                    },750);
                }
            }
        });
    });
</script>
