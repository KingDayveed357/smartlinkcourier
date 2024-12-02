<!DOCTYPE html>
<html lang="en">
<?php include_once ('./include/head.php') ?>

<body>
    <!-- Topbar Start -->
    <?php include('./include/topbar.php') ?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php include('./include/navbar.php') ?>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">Tracking Result</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="/">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Tracking Result</p>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <?php 
    $trackingid = isset($_GET['id']) ? cleaninput($_GET['id']) : '';
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = $conn->query("SELECT * FROM parcels WHERE reference_number='$trackingid'");
    if ($sql && $sql->num_rows > 0) {
        while ($row = $sql->fetch_assoc()) { 
    ?>
    <section class="blog-wrapper mx-lg-5 mx-3 news-wrapper section-padding">

    <!-- Print Button -->
    <div class="text-center mb-3">
        <button class="btn btn-primary" onclick="window.print()">Print Parcel Information</button>
    </div>

    <!-- Package Status -->
    <div class="text-center mb-3">
        <h3>Package Status:</h3>
        <h4>
            <?php
                $status = $row['status'];
                switch ($status) {
                    case '1': echo "<span class='badge badge-info'>Shipment Plan Started</span>"; break;
                    case '2': echo "<span class='badge badge-primary'>Shipment in transit</span>"; break;
                    case '3': echo "<span class='badge badge-warning'>In Transit</span>"; break;
                    case '4': echo "<span class='badge badge-success'>Arrived at Destination</span>"; break;
                    case '5': echo "<span class='badge badge-success'>Out for Delivery</span>"; break;
                    case '6': echo "<span class='badge badge-success'>Ready to Pickup</span>"; break;
                    case '7': echo "<span class='badge badge-success'>Delivered</span>"; break;
                    case '8': echo "<span class='badge badge-success'>Picked-up</span>"; break;
                    case '9': echo "<span class='badge badge-danger'>On-Hold</span>"; break;
                    default: echo "<span class='badge badge-secondary'>Item Accepted by Courier</span>"; break;
                }
            ?>
        </h4>
        <img src="./barcode1.png" alt="barcode"  width="180px" class="mt-3"/>
        <h5 class="mt-3 "><strong><?php echo htmlspecialchars($trackingid); ?></strong> </h5>
    </div>

    <!-- Sender and Recipient Information -->
    <div class="row">
        <!-- Sender Details -->
        <div class="col-md-6 mb-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Sender / Origin From</h5>
                </div>
                <div class="card-body">
                    <p><strong>Sender Address:</strong> 
                        <?php echo $row['sender_address'] . ', ' . $row['sender_state'] . ', ' . $row['sender_country']; ?>
                    </p>
                    <p><strong>From:</strong> <?php echo $row['sender_name']; ?></p>
                    <p><strong>Sender Email Address:</strong> <?php echo $row['sender_email']; ?></p>
                    <p><strong>Sender Contact:</strong> <?php echo $row['sender_contact']; ?></p>
                </div>
            </div>
        </div>

        <!-- Recipient Details -->
        <div class="col-md-6 mb-2">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Recipient / Destination To</h5>
                </div>
                <div class="card-body">
                    <p><strong>Recipient Address:</strong> 
                        <?php echo $row['recipient_address'] . ', ' . $row['recipient_state'] . ', ' . $row['recipient_country']; ?>
                    </p>
                    <p><strong>Name:</strong> <?php echo $row['recipient_name']; ?></p>
                    <p><strong>Recipient Contact:</strong> <?php echo $row['recipient_contact']; ?></p>
                    <p><strong>Recipient Email Address:</strong> <?php echo $row['recipient_email']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Shipment Information -->
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Shipment Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Shipment Status:</strong> 
                    <?php
                        $status = $row['status'];
                        switch ($status) {
                            case '1': echo "<span class='badge badge-info'>Collected</span>"; break;
                            case '2': echo "<span class='badge badge-primary'>Shipped</span>"; break;
                            case '3': echo "<span class='badge badge-warning'>In Transit</span>"; break;
                            case '4': echo "<span class='badge badge-success'>Arrived at Destination</span>"; break;
                            case '5': echo "<span class='badge badge-success'>Out for Delivery</span>"; break;
                            case '6': echo "<span class='badge badge-success'>Ready to Pickup</span>"; break;
                            case '7': echo "<span class='badge badge-success'>Delivered</span>"; break;
                            case '8': echo "<span class='badge badge-success'>Picked-up</span>"; break;
                            case '9': echo "<span class='badge badge-danger'>On-Hold</span>"; break;
                            default: echo "<span class='badge badge-secondary'>Item Accepted by Courier</span>"; break;
                        }
                    ?>
                    </p>
                    <hr>
                    <h6 class="text-primary">Shipment Information</h6>
                    <p><strong>Origin:</strong> <?php echo $row['sender_country']; ?></p>
                    <p><strong>Destination:</strong> <?php echo $row['recipient_country']; ?></p>
                    <p><strong>Carrier:</strong> <?php echo $row['carrier'] ?? 'Delivery Agent'; ?></p>
                    <p><strong>Type of Shipment:</strong> <?php echo $row['type_of_package']; ?></p>
                    <p><strong>Weight:</strong> <?php echo $row['weight']; ?></p>
                    <p><strong>Shipment Mode:</strong> <?php echo $row['shipment_method']; ?></p>
                    <p><strong>Carrier Reference No.:</strong> <?php echo htmlspecialchars($trackingid) ?? 'UK'; ?></p>
                    <p><strong>Product:</strong> <?php echo $row['type_of_package'] ?? 'Parcel'; ?></p>
                    <p><strong>Qty:</strong> <?php echo $row['quantity']; ?></p>
                    <p><strong>Payment Mode:</strong> <?php echo $row['payment_mode'] ?? 'Cash Payment'; ?></p>
                    <p><strong>Expected Delivery Date:</strong> <?php echo $row['estimated_date']; ?></p>
                    <p><strong>Departure Date/Time:</strong> <?php echo $row['date_created'] ?? '20:00 pm'; ?></p>
                    <p><strong>Comments:</strong> <?php echo $row['comments'] ?? 'THANKS FOR CHOOSING SMARTLINKCOURIER, WE ARE AT YOUR SERVICE.'; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Shipping History -->
    <div class="card my-5">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Shipping History</h5>
        </div>
        <div class="card-body">
            <?php
                $parcel_id = $row['id'];
                $sql = $conn->query("SELECT * FROM `shipping_history` WHERE parcel_id='$parcel_id'");
                if ($sql && $sql->num_rows > 0) {
                    while ($history = $sql->fetch_assoc()) {
            ?>
            <div class="mb-4">
                <h6><?php echo $history['timestamp']; ?></h6>
                <p>
                    <strong>Status:</strong>
                    <?php
                        $status = $history['status'];
                        switch ($status) {
                            case '1': echo "<span class='badge badge-info'>Collected</span>"; break;
                            case '2': echo "<span class='badge badge-primary'>Shipped</span>"; break;
                            case '3': echo "<span class='badge badge-warning'>In Transit</span>"; break;
                            case '4': echo "<span class='badge badge-success'>Arrived at Destination</span>"; break;
                            case '5': echo "<span class='badge badge-success'>Out for Delivery</span>"; break;
                            case '6': echo "<span class='badge badge-success'>Ready to Pickup</span>"; break;
                            case '7': echo "<span class='badge badge-success'>Delivered</span>"; break;
                            case '8': echo "<span class='badge badge-success'>Picked-up</span>"; break;
                            case '9': echo "<span class='badge badge-danger'>On-Hold</span>"; break;
                            default: echo "<span class='badge badge-secondary'>Item Accepted by Courier</span>"; break;
                        }
                    ?>
                </p>
                <p><strong>Location:</strong> <?php echo $history['location']; ?></p>
                <p><strong>Comments:</strong> <?php echo $history['comments']; ?></p>
                <div class="embed-responsive embed-responsive-16by9 mb-3">
                    <iframe class="embed-responsive-item" src="https://maps.google.com/maps?q=<?php echo urlencode($history['location']); ?>&amp;t=&amp;z=10&amp;ie=UTF8&amp;iwloc=&amp;output=embed"></iframe>
                </div>
            </div>
            <hr>
            <?php
                    }
                } else {
            ?>
            <p class="text-center">No shipping history found for Tracking ID: <?php echo htmlspecialchars($trackingid); ?></p>
            <?php } ?>																	
        </div>
    </div>

    <?php 
    }
} else { 
?>
    <div class="col-lg-12 my-5 text-center" style="display:flex; justify-content:center">
        <div class="alert alert-danger">
            <h6>No record found for Shipping ID: <?php echo htmlspecialchars($trackingid); ?></h6>
        </div>
    </div>
<?php 
}
?>  

</section>

<!-- Footer Start -->
<?php include './include/footer.php' ?>
<!-- Footer End -->


<!-- Back to Top -->
<!--<a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>-->

<!-- JavaScript Libraries -->
<?php include './include/script.php' ?>

</body>
</html>
