<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Flattern Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?=ROOT; ?>/assets/landing/img/favicon.png" rel="icon">
  <link href="<?=ROOT; ?>/assets/landing/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=ROOT; ?>/assets/landing/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?=ROOT; ?>/assets/landing/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?=ROOT; ?>/assets/landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=ROOT; ?>/assets/landing/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=ROOT; ?>/assets/landing/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=ROOT; ?>/assets/landing/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?=ROOT; ?>/assets/landing/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=ROOT; ?>/assets/landing/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Flattern - v4.7.0
  * Template URL: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com"><?=$context['company']['email']; ?></a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span><?=$context['company']['phone']; ?></span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="<?=ROOT; ?>/home">Flattern</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="<?=ROOT; ?>/home"><img src="<?=ROOT; ?>/assets/landing/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="active" href="<?=ROOT; ?>/home">Home</a></li>
          <li><a href="<?=ROOT; ?>/about">About</a></li>
          <li><a href="<?=ROOT; ?>/services">Services</a></li>
          <li><a href="<?=ROOT; ?>/testimonials">Testimonials</a></li>
          <li><a href="<?=ROOT; ?>/portfolio">Portfolio</a></li>
          <li><a href="<?=ROOT; ?>/blog">Blog</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a href="<?=ROOT; ?>/contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

<section>
    <!-- Content Goes Here -->
    <?php require("$name.view.php"); ?>
    <!-- End Content -->
</section>

<!-- ======= Footer ======= -->
<footer id="footer">

<div class="footer-top">
  <div class="container">
    <div class="row">

      <div class="col-lg-4 col-md-6 footer-contact">
        <h3><?=$context['company']['name']; ?></h3>
        <p>
          <?=$context['company']['address']; ?><br><br>
          <strong>Phone:</strong> <?=$context['company']['phone']; ?><br>
          <strong>Email:</strong> <?=$context['company']['email']; ?><br>
        </p>
      </div>

      <div class="col-lg-4 col-md-6 footer-links">
        <h4>Useful Links</h4>
        <ul>
          <li><i class="bx bx-chevron-right"></i> <a href="<?=ROOT; ?>/home">Home</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="<?=ROOT; ?>/about">About us</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
          <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-6 footer-newsletter">
        <h4>Join Our Newsletter</h4>
        <p>Get updates on our newest vehicles and accessories, offers and discounts!</p>
        <form action="" method="post">
          <input type="email" name="email"><input type="submit" value="Subscribe">
        </form>
      </div>

    </div>
  </div>
</div>

<div class="container d-md-flex py-4">

  <div class="me-md-auto text-center text-md-start">
    <div class="copyright">
      &copy; Copyright <strong><span>Flattern</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </div>
  <div class="social-links text-center text-md-right pt-3 pt-md-0">
    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
    <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
  </div>
</div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?=ROOT; ?>/assets/landing/vendor/aos/aos.js"></script>
<script src="<?=ROOT; ?>/assets/landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=ROOT; ?>/assets/landing/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?=ROOT; ?>/assets/landing/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?=ROOT; ?>/assets/landing/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?=ROOT; ?>/assets/landing/vendor/waypoints/noframework.waypoints.js"></script>
<script src="<?=ROOT; ?>/assets/landing/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?=ROOT; ?>/assets/landing/js/main.js"></script>

</body>

</html>