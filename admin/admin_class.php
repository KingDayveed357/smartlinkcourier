<?php
session_start();
ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Include PHPMailer classes
require '../PHPMailer-PHPMailer-cd72ef3/src/Exception.php';
require '../PHPMailer-PHPMailer-cd72ef3/src/PHPMailer.php';
require '../PHPMailer-PHPMailer-cd72ef3/src/SMTP.php';
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where email = '".$email."' and password = '".md5($password)."'  ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 2;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function login2(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM students where student_code = '".$student_code."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['rs_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function save_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!empty($password)){
					$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	function signup(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass')) && !is_numeric($k)){
				if($k =='password'){
					if(empty($v))
						continue;
					$v = md5($v);

				}
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");

		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			if(empty($id))
				$id = $this->db->insert_id;
			foreach ($_POST as $key => $value) {
				if(!in_array($key, array('id','cpass','password')) && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
					$_SESSION['login_id'] = $id;
			return 1;
		}
	}

	function update_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if($_FILES['img']['tmp_name'] != '')
			$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function save_system_settings(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k => $v){
			if(!is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['cover']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", cover_img = '$fname' ";

		}
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set $data where id =".$chk->fetch_array()['id']);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set $data");
		}
		if($save){
			foreach($_POST as $k => $v){
				if(!is_numeric($k)){
					$_SESSION['system'][$k] = $v;
				}
			}
			if($_FILES['cover']['tmp_name'] != ''){
				$_SESSION['system']['cover_img'] = $fname;
			}
			return 1;
		}
	}
	function save_image(){
		extract($_FILES['file']);
		if(!empty($tmp_name)){
			$fname = strtotime(date("Y-m-d H:i"))."_".(str_replace(" ","-",$name));
			$move = move_uploaded_file($tmp_name,'../assets/uploads/'. $fname);
			$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
			$hostName = $_SERVER['HTTP_HOST'];
			$path =explode('/',$_SERVER['PHP_SELF']);
			$currentPath = '/'.$path[1]; 
			if($move){
				return $protocol.'://'.$hostName.$currentPath.'/assets/uploads/'.$fname;
			}
		}
	}
	function save_branch(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($id)){
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$i = 0;
			while($i == 0){
				$bcode = substr(str_shuffle($chars), 0, 15);
				$chk = $this->db->query("SELECT * FROM branches where branch_code = '$bcode'")->num_rows;
				if($chk <= 0){
					$i = 1;
				}
			}
			$data .= ", branch_code='$bcode' ";
			$save = $this->db->query("INSERT INTO branches set $data");
		}else{
			$save = $this->db->query("UPDATE branches set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_branch(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM branches where id = $id");
		if($delete){
			return 1;
		}
	}
function save_parcel() {
  extract($_POST);
  
  // Initialize an array to store item IDs
  $save = [];
  $ids = [];
  
  // Loop through all parcels (based on the price array length)
  foreach($price as $k => $v) {
    $data = "";
    
    // Loop through each post variable and prepare the SQL data
    foreach($_POST as $key => $val) {
      if (!in_array($key, ['id', 'weight', 'price'])) {
        if (empty($data)) {
          $data .= " $key='$val' ";
        } else {
          $data .= ", $key='$val' ";
        }
      }
    }
    
    // If type is not set, default to type '2'
    if (!isset($type)) {
      $data .= ", type='2' ";
    }
    
    // Adding weight and price
    $data .= ", weight='{$weight[$k]}' ";
    $price[$k] = str_replace(',', '', $price[$k]);
    $data .= ", price='{$price[$k]}' ";
    
    // Calculate the quantity as the number of rows (parcels) added
    $quantity = count($weight); // Assuming each row is a new item
    
    $data .= ", quantity='{$quantity}' "; // Add quantity to data
    
    // Handle the creation of a new reference number
    if (empty($id)) {
      $i = 0;
      while ($i == 0) {
        $ref = sprintf("%'09d", mt_rand(0, 999999999));
        $chk = $this->db->query("SELECT * FROM parcels WHERE reference_number = '$ref'")->num_rows;
        if ($chk <= 0) {
          $i = 1;
        }
      }
      $data .= ", reference_number='$ref' ";
      if ($save[] = $this->db->query("INSERT INTO parcels SET $data")) {
        $ids[] = $this->db->insert_id;
      }
    } else {
      // If updating, we allow changing of reference_number
      if (!empty($reference_number)) {
        $ref = str_replace('SLC', '', $reference_number);
        $data .= ", reference_number='$ref' ";
      }
      if ($save[] = $this->db->query("UPDATE parcels SET $data WHERE id = $id")) {
        $ids[] = $id;
      }
    }
  }

  // If we have successfully inserted or updated the parcel
  if (isset($save) && isset($ids)) {
    return 1;
  }
}

	function delete_parcel(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM parcels where id = $id");
		if($delete){
			return 1;
		}
	}
	function update_parcel(){
		extract($_POST);
		$update = $this->db->query("UPDATE parcels set status= $status where id = $id");
		$save = $this->db->query("INSERT INTO parcel_tracks set status= $status , parcel_id = $id");
		if($update && $save)
			return 1;  
	}
	


function update_history() {
    // Ensure POST data is extracted and sanitized
    $id = $this->db->real_escape_string($_POST['parcel_id'] ?? '');
    $reference_number = $this->db->real_escape_string($_POST['reference_number'] ?? '');
    $status = $this->db->real_escape_string($_POST['status'] ?? '');
    $location = $this->db->real_escape_string($_POST['location'] ?? '');
    $comments = $this->db->real_escape_string($_POST['comments'] ?? '');
    $timestamp = $this->db->real_escape_string($_POST['timestamp'] ?? '');
    $recipientEmail = $this->db->real_escape_string($_POST['recipient_email'] ?? '');
    $recipientName = $this->db->real_escape_string($_POST['recipient_name'] ?? '');
    $senderEmail = $this->db->real_escape_string($_POST['sender_email'] ?? '');
    $senderName = $this->db->real_escape_string($_POST['sender_name'] ?? '');

    // Check required fields
    if (!$id || !$status || !$location || !$recipientEmail || !$recipientName) {
        error_log("Missing required fields for updating history.");
        return 0;
    }

    // Save to database
    $save = $this->db->query("INSERT INTO `shipping_history` (parcel_id, status, location, comments, timestamp) 
                              VALUES ('$id', '$status', '$location', '$comments', '$timestamp')");

    if (!$save) {
        error_log("Database insert failed: " . $this->db->error);
        return 0;
    }

    // Determine status badge
    $statusBadge = '';
    switch ($status) {
        case '1':
            $statusBadge = "<span class='badge badge-pill badge-info'>Shipment Plan Started</span>";
            break;
        case '2':
            $statusBadge = "<span class='badge badge-pill badge-info'>Shipment in transit</span>";
            break;
        case '3':
            $statusBadge = "<span class='badge badge-pill badge-primary'>In-Transit</span>";
            break;
        case '4':
            $statusBadge = "<span class='badge badge-pill badge-primary'>Arrived At Destination</span>";
            break;
        case '5':
            $statusBadge = "<span class='badge badge-pill badge-primary'>Out for Delivery</span>";
            break;
        case '6':
            $statusBadge = "<span class='badge badge-pill badge-primary'>Ready to Pickup</span>";
            break;
        case '7':
            $statusBadge = "<span class='badge badge-pill badge-success'>Delivered</span>";
            break;
        case '8':
            $statusBadge = "<span class='badge badge-pill badge-success'>Picked-up</span>";
            break;
        case '9':
            $statusBadge = "<span class='badge badge-pill badge-danger'>On-Hold</span>";
            break;
        default:
            $statusBadge = "<span class='badge badge-pill badge-info'>Item Accepted by Courier</span>";
            break;
    }

    // Email content
    $subject = "Shipment Update";
    $message = "
   <html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #fff;
            width: 90%;
            margin: 20px auto;
        }
        .header {
            background-color: #00274C;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: white;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f4f4f4;
            font-size: 12px;
            color: #555;
        }
        .content h4, .content p, .content h2 {
            color: #333;
        }
    </style>
</head>
    <body>
    <div style='font-family: Arial, sans-serif;'>
        <div style='background-color: #002b5c; padding: 10px; text-align: center; color: white; font-size: 20px;'>
            SmartlinkCourier
        </div>
        <div style='padding: 20px;'>
            <p>Hello $recipientName,</p>
            <p>We are pleased to inform you that your shipment status has been updated.</p>
            <h3>Tracking Information</h3>
            <p><strong>Tracking Number:</strong> $reference_number</p>
            <p><strong>Location:</strong> $location</p>
            <p><strong>Status:</strong> $statusBadge</p>
            <p><strong>Comments:</strong> $comments</p>
            <p>We hope this email meets your approval. Please do not hesitate to get in touch via email at 
            <a href='mailto:info@smartlinkcourier.com'>info@smartlinkcourier.com</a> if we can be of any further assistance.</p>
            <p>Yours sincerely,</p>
            <p>SmartlinkCourier Team</p>
        </div>
    </div>
    </body>
    </html>
    ";

    try {
        // Initialize PHPMailer
        $mail = new PHPMailer(true);

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smartlinkcourier.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'info@smartlinkcourier.com'; // SMTP username
        $mail->Password = 'admin@smartlinkcourier'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption type
        $mail->Port = 587; // SMTP port

        // Email headers and content
        $mail->setFrom('info@smartlinkcourier.com', 'SmartlinkCourier');
        $mail->addAddress($recipientEmail, $recipientName);
        $mail->addReplyTo('info@smartlinkcourier.com', 'SmartlinkCourier');
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $message;

        // Send email
        $mail->send();
        return 1; // Success
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        return 0; // Failed
    }
}


	
	function get_parcel_heistory(){
		extract($_POST);
		$data = array();
		$parcel = $this->db->query("SELECT * FROM `parcels` WHERE reference_number = '$ref_no'");
		if($parcel->num_rows <=0){
			return 2;
		}else{
			$parcel = $parcel->fetch_array();
			$data[] = array('status'=>'Item accepted by Courier','date_created'=>date("M d, Y h:i A",strtotime($parcel['date_created'])));
			$history = $this->db->query("SELECT * FROM parcel_tracks where parcel_id = {$parcel['id']}");
			$status_arr = array("Item Accepted by Courier","Collected","Shipped","In-Transit","Arrived At Destination","Out for Delivery","Ready to Pickup","Delivered","Picked-up","On Hold");
			while($row = $history->fetch_assoc()){
				$row['date_created'] = date("M d, Y h:i A",strtotime($row['date_created']));
				$row['status'] = $status_arr[$row['status']];
				$data[] = $row;
			}
			return json_encode($data);
		}
	}
	
	function get_report(){
		extract($_POST);
		$data = array();
		$get = $this->db->query("SELECT * FROM parcels where date(date_created) BETWEEN '$date_from' and '$date_to' ".($status != 'all' ? " and status = $status " : "")." order by unix_timestamp(date_created) asc");
		$status_arr = array("Item Accepted by Courier","Collected","Shipped","In-Transit","Arrived At Destination","Out for Delivery","Ready to Pickup","Delivered","Picked-up","On Hold");
		while($row=$get->fetch_assoc()){
			$row['sender_name'] = ucwords($row['sender_name']);
			$row['recipient_name'] = ucwords($row['recipient_name']);
			$row['date_created'] = date("M d, Y",strtotime($row['date_created']));
			$row['status'] = $status_arr[$row['status']];
			$row['price'] = number_format($row['price'],2);
			$data[] = $row;
		}
		return json_encode($data);
	}
}