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

.vehicle-img {
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
            <?php foreach($context['vehicle_categories'] as $vehicle_category): ?>
            <li data-filter=".filter-<?=$vehicle_category['category']; ?>"><?=$vehicle_category['category']; ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up">
        <?php foreach($context['vehicles'] as $vehicle): ?>
          <?php 
            $vehicle_id = $vehicle['vehicle_id'];
            $vehicle_image = query_fetch("SELECT * FROM vehicle_images WHERE vehicle_id = '$vehicle_id' LIMIT 1")[0];
          ?>
        <div class="col-lg-4 col-md-6 col-sm-12 my-4 portfolio-item filter-<?=fetch_vehicle_category($vehicle['category_id']); ?>">
          <img src="<?=fetch_image($vehicle_image['image'], 'vehicles'); ?>" class="vehicle-img" alt="">
          <div class="portfolio-info">
            <h4><?=$vehicle['name']; ?></h4>
            <p>N<?=$vehicle['price']; ?></p>
            <a href="<?=fetch_image($vehicle_image['image'], 'vehicles'); ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="<?=$vehicle['name']; ?>"><i class="bx bx-plus"></i></a>
            <a href="product?vehicle_id=<?=$vehicle['vehicle_id']; ?>" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
          </div>
        </div>
        <?php endforeach ?>

      </div>

    </div>
  </section><!-- End Portfolio Section -->

  <!-- ======= Testimonials Section ======= -->
  <section id="testimonials" class="testimonials">
    <div class="container">
      <div class="section-title" data-aos="fade-up">
        <h2><strong>Testimonials</strong></h2>
        <p>Here's what our customers say about us</p>
      </div>

      <div class="row">

        <div class="col-lg-6" data-aos="fade-up">
          <div class="testimonial-item">
            <img src="<?=ROOT; ?>/assets/landing/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
            <h3>Saul Goodman</h3>
            <h4>Ceo &amp; Founder</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
        </div>

        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
          <div class="testimonial-item mt-4 mt-lg-0">
            <img src="<?=ROOT; ?>/assets/landing/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
            <h3>Sara Wilsson</h3>
            <h4>Designer</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
        </div>

        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
          <div class="testimonial-item mt-4">
            <img src="<?=ROOT; ?>/assets/landing/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
            <h3>Jena Karlis</h3>
            <h4>Store Owner</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
        </div>

        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
          <div class="testimonial-item mt-4">
            <img src="<?=ROOT; ?>/assets/landing/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
            <h3>Matt Brandon</h3>
            <h4>Freelancer</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
        </div>

        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
          <div class="testimonial-item mt-4">
            <img src="<?=ROOT; ?>/assets/landing/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
            <h3>John Larson</h3>
            <h4>Entrepreneur</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
        </div>

        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
          <div class="testimonial-item mt-4">
            <img src="<?=ROOT; ?>/assets/landing/img/testimonials/testimonials-6.jpg" class="testimonial-img" alt="">
            <h3>Emily Harison</h3>
            <h4>Store Owner</h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Eius ipsam praesentium dolor quaerat inventore rerum odio. Quos laudantium adipisci eius. Accusamus qui iste cupiditate sed temporibus est aspernatur. Sequi officiis ea et quia quidem.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Testimonials Section -->

  <!-- ======= Brands Section ======= -->
  <section class="contact">
    <div class="container">
      <div class="section-title" data-aos="fade-up">
        <h2>Book an appointment with us <strong>Today</strong></h2>
    </div>

    <div class="row mt-5 justify-content-center" data-aos="fade-up">
      <div class="col-lg-10">
        <form method="post" name="contact-form">
          <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="text" name="name" class="form-control" placeholder="Your Name" maxlength="100" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="email" placeholder="Your Email" maxlength="100" required>
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="text" class="form-control" name="subject" placeholder="Subject" maxlength="150" required>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Message" maxlength="3000" required></textarea>
          </div>
          <div class="my-3">
            <div class="message"></div>
          </div>
          <div class="text-center"><button class="btn btn-danger" type="submit"><span class="btn-text">Send Message</span></button></div>
        </form>
      </div>
    </div>
  </section><!-- End Brands Section -->

</main><!-- End #main -->

<script>
  let contactForm = document.forms['contact-form'],
  contactBtn = document.querySelector('.btn'),
  btnText = contactBtn.querySelector('.btn-text'),
  url = window.location.href;

  contactForm.addEventListener('submit', (e)=> {
    e.preventDefault()

    // Loading animation
    btnText.innerHTML = `Sending...<img width='30px' src="<?=STATIC_ROOT; ?>/admin/img/spinner-white.svg">`;
    contactBtn.disabled = true;

    fetch(url, {
      method: "POST",
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        'name': contactForm['name'].value,
        'email': contactForm['email'].value,
        'subject': contactForm['subject'].value,
        'message': contactForm['message'].value,
        'csrf_token': contactForm['csrf_token'].value
      })
    })
    .then((response)=>{
      return response.json()
    })
    .then((data)=>{
      if (data['status'] == 'success') {
        contactForm.reset();
        contactBtn.disabled = false;
        btnText.innerHTML = `Send Message`;
        swal(data['message'], {icon: 'success'});
      } else {
        btnText.innerHTML = `Send Message`;
        contactBtn.disabled = false;
        swal(data['message'], {icon: 'error'});
      }
    })
    .catch((err)=>{
      console.log(err);
      btnText.innerHTML = `Send Message`;
      contactBtn.disabled = false;
      swal("Error please check network connection", {icon: 'error'});
    })


  });

</script>