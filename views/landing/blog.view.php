<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Blog</h2>
        <ol>
          <li><a href="home">Home</a></li>
          <li>Blog</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Blog Section ======= -->
  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-8 entries">
          <?php if (isset($_SESSION['message'])): ?>
            <h4 class="col-12 my-5 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
              <?=$_SESSION['message']; ?>
            </h4>
          <?php endif ?>
          <?php foreach($context['posts']['result'] as $post): ?>
          <article class="entry">
            <?php if($post['image']): ?>
            <div class="entry-img">
              <img src="<?=$post['image']; ?>" alt="" class="ml-3 img-fluid">
            </div>
            <?php endif ?>
            <h2 class="entry-title">
              <a href="post?title=<?=$post['slug']; ?>"><?=$post['title']; ?></a>
            </h2>

            <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="bi bi-tags"></i> <a href="posts?category=<?=fetch_post_category($post['category_id']); ?>"><?=fetch_post_category($post['category_id']); ?></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="post?title=<?=$post['slug']; ?>"><?=fetch_user($post['user_id']); ?></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="post?title=<?=$post['slug']; ?>"><?=format_datetime($post['created_at']); ?></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="javascript:void(0);"><?=post_comments_total($post['id']); ?> Comments</a></li>
              </ul>
            </div>

            <div class="entry-content">
              <?=truncate_HTML($post['content'], 250); ?>
            </div>

            <div class="read-more">
              <a href="post?title=<?=$post['slug']; ?>"> Read More</a>
            </div>

          </article><!-- End blog entry -->
          <?php endforeach ?>

          <div class="blog-pagination">
            <ul class="justify-content-center">
              <?php if ($context['posts']['has_previous']): ?>
              <li><a href="?page=<?=$context['posts']['previous_page'] ?>">&laquo;</a></li>
              <?php else: ?>
              <li><a href="javascript:void(0);">&laquo;</a></li>
              <?php endif ?>
              
              <li class="active">
                <a href="javascript:void(0);"><?=$context['posts']['page'] ?></a>
              </li>

              <?php if ($context['posts']['has_next']): ?>
              <li><a href="?page=<?=$context['posts']['next_page'] ?>">&raquo;</a></li>
              <?php else: ?>
              <li><a href="javascript:void(0);">&raquo;</a></li>
              <?php endif ?>
            </ul>
          </div>

        </div><!-- End blog entries list -->

        <div class="col-lg-4">

          <div class="sidebar">

            <h3 class="sidebar-title">Search</h3>
            <div class="sidebar-item search-form">
              <form method="get">
                <input type="text" name="search">
                <button type="submit"><i class="bi bi-search"></i></button>
              </form>
              <?php if (isset($_SESSION['message'])): ?>
                <h6 class="col-12 my-2 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                  <?=$_SESSION['message']; ?>
                </h6>
              <?php endif ?>
            </div><!-- End sidebar search formn-->

            <h3 class="sidebar-title">Categories</h3>
            <div class="sidebar-item categories">
              <ul>
                <?php foreach($context['post_categories'] as $post_category): ?>
                <li><a href="posts?category=<?=$post_category['category']; ?>" class="text-capitalize"><?=$post_category['category']; ?> <span>(<?=post_category_total($post_category['id']);?>)</span></a></li>
                <?php endforeach ?>
              </ul>
            </div><!-- End sidebar categories-->

            <h3 class="sidebar-title">Recent Posts</h3>
            <div class="sidebar-item recent-posts">
              <?php foreach($context['recent_posts'] as $recent_post): ?>
                <div class="post-item clearfix">
                  <?php if($recent_post['image']): ?>
                    <img src="<?=$recent_post['image']; ?>" width="100px" alt="image">
                  <?php else: ?>
                    <img src="<?=ROOT; ?>/assets/post_default.jpeg" width="100px" alt="image">
                  <?php endif ?>
                  <h4><a href="post?title=<?=$recent_post['slug']; ?>"><?=$recent_post['title']; ?></a></h4>
                  <time><?=format_datetime($recent_post['created_at']); ?></time>
                </div>
              <?php endforeach ?>

            </div><!-- End sidebar recent posts-->

            <h3 class="sidebar-title">Tags</h3>
            <div class="sidebar-item tags">
              <ul>
                <?php foreach($context['post_categories'] as $post_category): ?>
                <li><a href="posts?category=<?=$post_category['category']; ?>" class="text-capitalize"><?=$post_category['category']; ?></a></li>
                <?php endforeach ?>
              </ul>
            </div><!-- End sidebar tags-->

          </div><!-- End sidebar -->

        </div><!-- End blog sidebar -->

      </div>

    </div>
  </section><!-- End Blog Section -->

</main><!-- End #main -->
