<style>
#about {
  margin: 0rem .2rem;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap !important;
}

#about div {
  width: 500px;
  margin: 0px 20px;
}

.about-img img {
  width: 100%;
}

.about-text {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.about-text h6, .about-text h3  {
  color: #dc3545;
}

.car-img {
  width: 100%;
  height: 250px;
}

.brands {
  margin-top: 0px !important;
}

.brand-container {
  width: 100vw;
}

.brand-container img {
  width: 100%;
}

@media only screen and (max-width: 650px) {
  .car-img {
    width: 100%;
    height: 300px;
  }
}
</style>
<!-- ======= Hero Section ======= -->
<section id="hero">
  <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <div class="carousel-inner" role="listbox">

      <!-- Slide 1 -->
      <div class="carousel-item active" style="background-image: url(<?=ROOT; ?>/assets/landing/img/slide/slide-1.jpg);">
        <div class="carousel-container">
          <div class="carousel-content animate__animated animate__fadeInUp">
            <h2>Welcome to <span class="text-capitalize"><?=$context['company']['name']; ?></span></h2>
            <p>New or used, find your perfect fit to fuel your journey and unleash your freedom. Start your adventure today with our diverse selection of cars, trucks, and SUVs—let our expert team guide you to the right wheels for your budget and lifestyle!</p>
            <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item" style="background-image: url(<?=ROOT; ?>/assets/landing/img/slide/slide-2.jpg);">
        <div class="carousel-container">
          <div class="carousel-content animate__animated animate__fadeInUp">
            <h2>Top-quality parts at competitive prices</h2>
            <p>Find the perfect fit with our complete inventory of genuine and aftermarket parts for every car. Whether you crave factory precision or performance upgrades, we've got your engine purring again in no time</p>
            <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
          </div>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item" style="background-image: url(<?=ROOT; ?>/assets/landing/img/slide/slide-3.jpg);">
        <div class="carousel-container">
          <div class="carousel-content animate__animated animate__fadeInUp">
            <h2>Incredible repair services</h2>
            <p>Worried about repairs? Relax and get back on the road in no time with our trustworthy experts. Reliable auto repair you can trust, mile after mile—schedule your appointment today!</p>
            <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
          </div>
        </div>
      </div>

    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bx bx-left-arrow" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bx bx-right-arrow" aria-hidden="true"></span>
    </a>

    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

  </div>
</section><!-- End Hero -->

<main id="main">

  <!-- ======= Cta Section ======= -->
  <section id="cta" class="cta">
    <div class="container">

      <div class="row">
        <div class="col-lg-9 text-center text-lg-left">
          <h3>We've sold more than <span>200 cars</span> this year!</h3>
          <p>Our service and parts departments also deserve recognition for helping keep these cars in top shape before and after purchase. From major repairs to routine maintenance to installing the latest accessories, our mechanics and technicians play a major role in our sales success.</p>
        </div>
        <div class="col-lg-3 cta-btn-container text-center">
          <a class="cta-btn align-middle" href="javascript:void(0);">Request a quote</a>
        </div>
      </div>

    </div>
  </section><!-- End Cta Section -->

  <!-- ======= About Section ======= -->
  <section id="about">
    <div class="about-text">
      <h3>About us</h3>
      <h6>At <span class="text-capitalize"><?=$context['company']['name']; ?></span>, we are your one-stop shop for all things automotive!</h6>
      <p>But we don't just sell cars - we also keep them running smoothly for years to come. Our service technicians are factory-trained professionals who can handle everything from routine maintenance to major repairs. We use only top-quality parts and fluids to ensure your car continues performing at its best.</p>
      <p>We also offer a full stock of automotive parts and accessories. Need new brakes, a battery, tires, or a performance upgrade? We've got it in stock or can order it for you right away. With competitive pricing, we make it easy to get the parts you need to keep your ride in tip-top shape.</p>
      <p>Our experienced sales staff can help you find the perfect new or used car to fit your needs and budget. We have a huge selection of makes and models, so you're sure to drive off our lot satisfied.</p>
    </div>
    <div class="about-img">
      <img src="<?=ROOT; ?>/assets/landing/img/mechanic.jpg" alt="">
    </div>
  </section><!-- End About Section -->

  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container">
      <div class="section-title" data-aos="fade-up">
        <h2>Our <strong>Features</strong></h2>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="icon-box" data-aos="fade-up">
            <div class="icon"><i class="bi bi-briefcase"></i></div>
            <h4 class="title"><a href="">Diverse Selection</a></h4>
            <p class="description">Whether you're a city cruiser, a weekend warrior, or a family on the go, we have the perfect car, truck, or SUV to match your lifestyle</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
            <div class="icon"><i class="bi bi-card-checklist"></i></div>
            <h4 class="title"><a href="">New & Used Options</a></h4>
            <p class="description">Choose from sparkling new models or reliable pre-owned gems, all meticulously inspected and ready to roll</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="bi bi-bar-chart"></i></div>
            <h4 class="title"><a href="">Genuine & Aftermarket Parts</a></h4>
            <p class="description">We offer a vast selection of high-quality parts to keep your car running smoothly, at prices that won't break the bank</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="bi bi-binoculars"></i></div>
            <h4 class="title"><a href="">Top-Tier Repairs</a></h4>
            <p class="description">Our skilled mechanics will diagnose and fix any issue, big or small, using the latest tools and techniques</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
            <div class="icon"><i class="bi bi-brightness-high"></i></div>
            <h4 class="title"><a href="">Safety First</a></h4>
            <p class="description">We prioritize your safety with thorough inspections and adherence to the highest safety standards</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
            <div class="icon"><i class="bi bi-calendar4-week"></i></div>
            <h4 class="title"><a href="">Customer Satisfaction</a></h4>
            <p class="description">Your satisfaction is our top priority. We go the extra mile to ensure you have a positive and hassle-free experience</p>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Services Section -->

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
    <div class="container">

      <div class="row" data-aos="fade-up">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <?php foreach($context['car_categories'] as $car_category): ?>
            <li data-filter=".filter-<?=$car_category['category']; ?>"><?=$car_category['category']; ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up">
        <?php foreach($context['cars'] as $car): ?>
          <?php 
            $car_id = $car['car_id'];
            $car_image = query_fetch("SELECT * FROM car_images WHERE car_id = '$car_id' LIMIT 1")[0];
          ?>
        <div class="col-lg-4 col-md-6 col-sm-12 my-4 portfolio-item filter-<?=fetch_car_category($car['category_id']); ?>">
          <img src="<?=fetch_image($car_image['image'], 'cars'); ?>" class="car-img" alt="">
          <div class="portfolio-info">
            <h4><?=$car['name']; ?></h4>
            <p>N<?=$car['price']; ?></p>
            <a href="<?=fetch_image($car_image['image'], 'cars'); ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="<?=$car['name']; ?>"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
          </div>
        </div>
        <?php endforeach ?>

      </div>

    </div>
  </section><!-- End Portfolio Section -->

  <!-- ======= Brands Section ======= -->
  <section class="brands">
    <div class="container">
      <div class="section-title" data-aos="fade-up">
        <h2>Popular car <strong>Brands</strong></h2>
        <p>More than just cars, we're fueled by the vibrant community of individuals who make our autohub a second home. City savviness, family adventures, weekend escapes, eco-conscious drives, and second-chance seekers—we celebrate the unique stories and dreams behind every wheel</p>
      </div>
    </div>

    <div class="brand-container">
      <img src="<?=ROOT; ?>/assets/landing/img/clients/brands-1.jpg" alt="">
    </div>
  </section><!-- End Brands Section -->

</main><!-- End #main -->