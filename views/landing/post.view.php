<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Post</h2>
        <ol>
          <li><a href="home">Home</a></li>
          <li><a href="blog">Blog</a></li>
          <li>Post</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Blog Single Section ======= -->
  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-8 entries">

          <article class="entry entry-single">
            <?php if($context['post']['image']): ?>
            <div class="entry-img">
              <img src="<?=$context['post']['image']; ?>" alt="" class="img-fluid">
            </div>
            <?php endif ?>
            <h2 class="entry-title">
              <a href="javascript:void(0);"><?=$context['post']['title']; ?></a>
            </h2>

            <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="javascript:void(0);"><?=fetch_user($context['post']['user_id']); ?></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="javascript:void(0);"><?=format_datetime($context['post']['created_at']); ?></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="javascript:void(0);"><?=post_comments_total($context['post']['id']); ?> Comments</a></li>
              </ul>
            </div>

            <div class="entry-content my-5">
              <?=htmlspecialchars_decode($context['post']['content']); ?>
            </div>

            <?php if($context['post']['quote']): ?>
            <blockquote class="blockquote my-5">
                <p><?=$context['post']['quote']; ?></p>
            </blockquote>
            <?php endif ?>

            <div class="entry-footer">
              <i class="bi bi-tags"></i>
              <ul class="tags">
                <li><a href="posts?category=<?=fetch_post_category($context['post']['category_id']); ?>"><?=fetch_post_category($context['post']['category_id']); ?></a></li>
              </ul>
            </div>

          </article><!-- End blog entry -->

          <div class="blog-author d-flex align-items-center">
            <img src="<?=ROOT; ?>/assets/landing/img/blog/blog-author.jpg" class="rounded-circle float-left" alt="">
            <div>
              <h4><?=fetch_user($context['post']['user_id']); ?></h4>
              <div class="social-links">
                <a href="javascript:void(0);"><i class="bi bi-twitter"></i></a>
                <a href="javascript:void(0);"><i class="bi bi-facebook"></i></a>
                <a href="javascript:void(0);"><i class="biu bi-instagram"></i></a>
              </div>
              <p>
                Itaque quidem optio quia voluptatibus dolorem dolor. Modi eum sed possimus accusantium. Quas repellat voluptatem officia numquam sint aspernatur voluptas. Esse et accusantium ut unde voluptas.
              </p>
            </div>
          </div><!-- End blog author bio -->

          <div class="blog-comments">

            <h4 class="comments-count"><?=post_comments_total($context['post']['id']); ?> Comments</h4>

            <?php 
              $post_id  = intval($context['post']['id']);
              $comments = query_fetch("SELECT * FROM comments WHERE post_id = $post_id"); 
            ?>

            <?php if (!empty($comments)): ?> 
              <?php foreach($comments as $comment): ?>
              <div id="comment-2" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><img src="<?=ROOT; ?>/assets/admin/img/default.png" alt=""></div>
                  <div>
                    <h5><a href="javascript:void(0);"><?=$comment['name']; ?></a> <a href="javascript:void(0);" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                    <time><?=format_datetime($comment['date']); ?></time>
                    <p>
                      <?=$comment['comment']; ?>
                    </p>
                  </div>
                </div>
              </div><!-- End comment #2-->
              <?php endforeach ?>
            <?php endif ?>


            <div class="reply-form">
              <h4>Leave a Reply</h4>
              <p>Your email address will not be published. Required fields are marked * </p>
              <form method="post">
                <div class="row">
                  <input name="csrf_token" type="hidden" value="<?=$_SESSION['csrf_token']; ?>">
                  <input name="post_id" type="hidden" class="form-control" value=<?=$context['post']['id']; ?>>
                  <?php if(empty($_SESSION['user'])): ?>
                  <div class="col-md-6 form-group">
                    <input name="name" type="text" class="form-control" maxlength="30" placeholder="Your Name*" required>
                  </div>
                  <div class="col-md-6 form-group">
                    <input name="email" type="text" class="form-control" maxlength="60" placeholder="Your Email*" required>
                  </div>
                  <input name="user_id" type="hidden" class="form-control" value="">
                  <?php else: ?>
                    <input name="user_id" type="hidden" class="form-control" value=<?=$_SESSION['user']['id']; ?> required>
                    <input name="name" type="hidden" class="form-control" value="<?=$_SESSION['user']['username']; ?>" required>
                    <input name="email" type="hidden" class="form-control" value="<?=$_SESSION['user']['email']; ?>" required>
                  <?php endif ?>
                </div>
                <div class="row">
                  <div class="col form-group">
                    <textarea name="comment" class="form-control" maxlength="500" placeholder="Your Comment*" required></textarea>
                  </div>
                </div>
                <?php if (isset($_SESSION['message'])): ?>
                <div class="form-group">
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                </div>
                <?php endif ?>
                <button type="submit" class="btn btn-primary">Post Comment</button>

              </form>

            </div>

          </div><!-- End blog comments -->

        </div><!-- End blog entries list -->

        <div class="col-lg-4">

          <div class="sidebar">

            <h3 class="sidebar-title">Search</h3>
            <div class="sidebar-item search-form">
              <form method="get">
                <input type="text" name="search">
                <button type="submit"><i class="bi bi-search"></i></button>
              </form>
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
                    <img src="<?=$recent_post['image']; ?>" alt="">
                  <?php else: ?>
                    <img src="<?=ROOT; ?>/assets/post_default.jpg" alt="">
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
  </section><!-- End Blog Single Section -->

</main><!-- End #main -->