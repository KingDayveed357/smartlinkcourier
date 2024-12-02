<?php 
   if(isset($_POST['contact_message'])){
       include_once('contact-process.php');
   } 
?>
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
            <h1 class="text-white display-3">Contact</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="/">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Contact</p>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 pb-4 pb-lg-0">
                    <div class="bg-primary text-dark text-center p-4">
                        <h4 class="m-0"><i class="fa fa-map-marker-alt text-white mr-2"></i>815 Woolwich Rd, London SE7 8LJ, UK</h4>
                    </div>
                    <iframe style="width: 100%; height: 470px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2484.1603309737397!2d0.040666492463051075!3d51.491925217722816!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!
                    4f13.1!3m3!1m2!1s0x47d8a85e4e83b881%3A0x64f39b9d50d0774f!2s815%20Woolwich%20Rd%2C%20London%20SE7%208LJ%2C%20UK!5e0!3m2!1sen!2sng!4v1732323662193!5m2!1sen!2sng"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="col-lg-7">
                    <h6 class="text-primary text-uppercase font-weight-bold">Contact Us</h6>
                    <h1 class="mb-4">Contact For Any Queries</h1>
                    <div class="contact-form bg-secondary" style="padding: 30px;">
                        <div id="success"></div>
<form action="contact.php" method="POST" novalidate="novalidate">
     <?php if (!empty($success)): ?>
        <p class="text-success"><?= $success ?></p>
    <?php endif; ?>
    <?php if (!empty($errors['general'])): ?>
        <p class="text-danger"><?= $errors['general'] ?></p>
    <?php endif; ?>
    <div class="control-group">
        <input type="text" class="form-control border-0 p-4" id="name" name="name" placeholder="Your Name" 
               value="<?= htmlspecialchars($name ?? '') ?>" />
        <p class="help-block text-danger"><?= $errors['name'] ?? '' ?></p>
    </div>
    <div class="control-group">
        <input type="email" class="form-control border-0 p-4" id="email" name="email" placeholder="Your Email" 
               value="<?= htmlspecialchars($email ?? '') ?>" />
        <p class="help-block text-danger"><?= $errors['email'] ?? '' ?></p>
    </div>
    <div class="control-group">
        <input type="text" class="form-control border-0 p-4" id="subject" name="subject" placeholder="Subject" 
               value="<?= htmlspecialchars($subject ?? '') ?>" />
        <p class="help-block text-danger"><?= $errors['subject'] ?? '' ?></p>
    </div>
    <div class="control-group">
        <textarea class="form-control border-0 py-3 px-4" rows="3" id="message" name="message" placeholder="Message"><?= htmlspecialchars($message ?? '') ?></textarea>
        <p class="help-block text-danger"><?= $errors['message'] ?? '' ?></p>
    </div>
    <div>
        <button class="btn btn-primary py-3 px-4" type="submit" name="contact_message">Send Message</button>
    </div>
   
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

<!-- Footer Start -->
 <?php include('./include/footer.php') ?>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<?php include './include/script.php' ?>
</body>

</html>