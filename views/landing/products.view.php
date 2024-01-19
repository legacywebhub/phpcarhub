<style>
  .vehicle-img {
    width: 100%;
    height: 250px;
  }
</style>
<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Available Catalogue</h2>
        <ol>
          <li><a href="home">Home</a></li>
          <li>Catalogue</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

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
        <?php foreach($context['vehicles']['result'] as $vehicle): ?>
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

      <div class="blog-pagination">
        <ul class="justify-content-center">
          <?php if ($context['vehicles']['has_previous']): ?>
          <li><a href="?page=<?=$context['vehicles']['previous_page'] ?>">&laquo;</a></li>
          <?php else: ?>
          <li><a href="javascript:void(0);">&laquo;</a></li>
          <?php endif ?>
          
          <li class="active">
            <a href="javascript:void(0);"><?=$context['vehicles']['page'] ?></a>
          </li>

          <?php if ($context['vehicles']['has_next']): ?>
          <li><a href="?page=<?=$context['vehicles']['next_page'] ?>">&raquo;</a></li>
          <?php else: ?>
          <li><a href="javascript:void(0);">&raquo;</a></li>
          <?php endif ?>
        </ul>
      </div>

    </div>
  </section><!-- End Portfolio Section -->

</main><!-- End #main -->