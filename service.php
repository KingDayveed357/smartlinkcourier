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
            <h1 class="text-white display-3">Service</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="/">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Service</p>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Services Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold">Our Services</h6>
                <h1 class="mb-4">Best Logistic Services</h1>
            </div>
            <div class="row pb-3">
                <div class="col-lg-3 col-md-6 text-center mb-5">
                    <img style="width: 250px; height: 150px;" src="/img/services/Air-Freight-101.png" alt="Air Freight Image" class="img-fluid mb-3">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-plane text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">Air Freight</h6>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-5">
                    <img style="width: 250px; height: 150px;" src="/img/services/Ocean-Freight-101.jpg" alt="Ocean Freight Image" class="img-fluid mb-3">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-ship text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">Ocean Freight</h6>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-5">
                    <img style="width: 250px; height: 150px;" src="/img/services/land-transport-101.jpg" alt="Land Transport Image" class="img-fluid mb-3">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-truck text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">Land Transport</h6>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-5">
                    <img style="width: 250px; height: 150px;" src="/img/services/cargo-101.jpg" alt="Cargo Storage Image" class="img-fluid mb-3">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-store text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">Cargo Storage</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->


    <!--  Quote Request Start -->
    <div class="container-fluid bg-secondary my-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 py-5 py-lg-0">
                    <h6 class="text-primary text-uppercase font-weight-bold">Get A Quote</h6>
                    <h1 class="mb-4">Request A Free Quote</h1>
                    <p class="mb-4">Ready to streamline your logistics needs? Our team of skilled experts is here to offer you reliable, cost-effective solutions tailored to your business. Whether it’s local deliveries or international shipping, we ensure efficiency, transparency, and peace of mind. Contact us today for a free quote and see how we can help you reach your logistics goals.</p>
                    <div class="row">
                        <div class="col-sm-4">
                            <h1 class="text-primary mb-2" data-toggle="counter-up">225</h1>
                            <h6 class="font-weight-bold mb-4">Skilled Experts</h6>
                        </div>
                        <div class="col-sm-4">
                            <h1 class="text-primary mb-2" data-toggle="counter-up">1050</h1>
                            <h6 class="font-weight-bold mb-4">Happy Clients</h6>
                        </div>
                        <div class="col-sm-4">
                            <h1 class="text-primary mb-2" data-toggle="counter-up">2500</h1>
                            <h6 class="font-weight-bold mb-4">Completed Projects</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="bg-primary py-5 px-4 px-sm-5">
                        <form class="py-5" action='price'>
                            <div class="form-group">
                                <input type="text" class="form-control border-0 p-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 p-4" placeholder="Your Email" required="required" />
                            </div>
                            <div class="form-group">
                                <select class="custom-select border-0 px-4" style="height: 47px;">
                                    <option selected>Select A Service</option>
                                    <option value="1">Freight Forwarding</option>
                                    <option value="2">Warehousing</option>
                                    <option value="3">Custom Brokerage</option>
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-dark btn-block border-0 py-3" type="submit">Get A Quote</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote Request Start -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold">Testimonial</h6>
                <h1 class="mb-4">Our Clients Say</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-1.jpg" style="width: 60px; height: 60px;" alt="Alice Brown">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Alice Brown</h6>
                            <small>- Marketing Specialist</small>
                        </div>
                    </div>
                    <p class="m-0">"The team at smartlinkcourier always goes above and beyond. Our shipments are consistently on time, and the customer support is incredible!"</p>
                </div>
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-2.jpg" style="width: 60px; height: 60px;" alt="Michael Lee">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Michael Lee</h6>
                            <small>- E-commerce Manager</small>
                        </div>
                    </div>
                    <p class="m-0">"We’ve never worked with a logistics provider as efficient and reliable. smartlinkcourier ensures our products reach customers on time, every time."</p>
                </div>
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-3.jpg" style="width: 60px; height: 60px;" alt="Sarah Johnson">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">Sarah Johnson</h6>
                            <small>- Retail Store Owner</small>
                        </div>
                    </div>
                    <p class="m-0">"Thanks to smartlinkcourier, we’ve been able to streamline our supply chain. Their dedication to service is unmatched."</p>
                </div>
                <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid rounded-circle" src="img/testimonial-4.jpg" style="width: 60px; height: 60px;" alt="James Williams">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0">James Williams</h6>
                            <small>- Small Business Owner</small>
                        </div>
                    </div>
                    <p class="m-0">"Exceptional service and attention to detail. smartlinkcourier is the most reliable logistics partner we've had."</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

 <!-- Footer Start -->
 <?php include('./include/footer.php') ?>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<?php include './include/script.php' ?>
</body>

</html>