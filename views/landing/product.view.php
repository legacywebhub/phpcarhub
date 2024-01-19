<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Vehicle Details</h2>
        <ol>
          <li><a href="home">Home</a></li>
          <li>Details</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Portfolio Details Section ======= -->
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-8">
          <div class="portfolio-details-slider swiper">
            <div class="swiper-wrapper align-items-center">
            <?php 
              $vehicle_id = $context['vehicle']['vehicle_id'];
              $vehicle_images = query_fetch("SELECT * FROM vehicle_images WHERE vehicle_id = '$vehicle_id'");
            ?>

            <?php foreach($vehicle_images as $vehicle_image): ?>
              <div class="swiper-slide">
                <img src="<?=fetch_image($vehicle_image['image'], 'vehicles'); ?>" alt="">
              </div>
            <?php endforeach ?>
            </div>

            <div class="swiper-pagination"></div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="portfolio-info">
            <h3>Product information</h3>
            <ul>
              <li><strong>Title</strong>: <?=$context['vehicle']['name']; ?></li>
              <li><strong>Price</strong>: N<?=$context['vehicle']['price']; ?></li>
              <li><strong>Date uploaded</strong>: <?=$context['vehicle']['date_uploaded']; ?></li>
              <li><strong>Available</strong>: <?php if ($context['vehicle']['available']==1){echo "Yes";}else{echo "No";} ?></li>
            </ul>
          </div>
          <div class="portfolio-description">
            <h2>Product Features & Description</h2>
            <p>
              <?=$context['vehicle']['description']; ?>
            </p>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->
