<?php  // Assuming you already have a database connection established as $conn
include ('./db_connect.php');
$parcel_id = $_GET['id'] ?? 0;
$reference_number = '';
$recipientEmail = '';
$recipientName = '';
$senderEmail = '';
$senderName = '';

// Fetch recipient and sender details using the parcel ID
$query = "SELECT recipient_email, recipient_name, sender_email, sender_name, reference_number FROM parcels WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $parcel_id);
$stmt->execute();
$stmt->bind_result($recipientEmail, $recipientName, $senderEmail, $senderName, $reference_number);
$stmt->fetch();
$stmt->close();
?>


<div class="container-fluid">
    <form action="" id="update_history">
        <input type="hidden" name="parcel_id" value="<?php echo $_GET['id']; ?>">
      <input type="hidden" name="reference_number" value="<?php echo $reference_number; ?>">
        <!-- Hidden fields to pass recipient and sender information -->
        <input type="hidden" name="recipient_email" value="<?php echo $recipientEmail; ?>"> <!-- Fetch this value dynamically -->
        <input type="hidden" name="recipient_name" value="<?php echo $recipientName; ?>"> <!-- Fetch this value dynamically -->
        <input type="hidden" name="sender_email" value="<?php echo $senderEmail; ?>"> <!-- Fetch this value dynamically -->
        <input type="hidden" name="sender_name" value="<?php echo $senderName; ?>"> <!-- Fetch this value dynamically -->

        <div class="form-group">
            <label for="">Update History</label>
            <?php 
                $status_arr = array("Item Accepted by Courier","Shipment Plan Started","Shipment in transit","In-Transit","Arrived At Destination","Out for Delivery","Ready to Pickup","Delivered","Picked-up","On-Hold"); 
            ?>
            <select name="status" id="" class="custom-select custom-select-sm">
                <?php foreach($status_arr as $k => $v): ?>
                    <option value="<?php echo $k; ?>" <?php echo $_GET['cs'] == $k ? "selected" :''; ?>><?php echo $v; ?></option>
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
    <button class="btn btn-primary" form="update_history">Update</button>
    <button type="button" class="btn btn-secondary" onclick="uni_modal('Parcel\'s Details','view_parcel.php?id=<?php echo $_GET['id']; ?>','large')">Close</button>
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
$('#update_history').submit(function (e) {
    e.preventDefault();
    console.log('Form submission triggered'); // Debugging step
    start_load();
    $.ajax({
        url: 'ajax.php?action=update_history',
        method: 'POST',
        data: $(this).serialize(),
        error: (err) => {
            console.error(err); // Log the error
            alert_toast('An error occurred.', 'error');
            end_load();
        },
        success: function (resp) {
            console.log('Response received:', resp); // Debugging step
            if (resp == 1) {
                alert_toast("Parcel's shipping history successfully updated", 'success');
                setTimeout(function () {
                    location.reload();
                }, 750);
            } else {
                alert_toast('An error occurred while updating.', 'error');
            }
        },
    });
});

</script>
