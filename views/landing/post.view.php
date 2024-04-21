<style>
  .reply {
    cursor: pointer;
    font-weight: bold;
  }
  .reply:hover {
    color: #ad1b30 !important;
  }
</style>

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
            <?php if(!is_null($context['author']) && !empty($context['author']['profile_pic'])): ?>
            <img src="<?=fetch_image($context['author']['profile_pic'], 'users')?>" class="rounded-circle float-left" alt="">
            <?php else: ?>
            <img src="<?=ROOT; ?>/assets/landing/img/ceo.jpg" class="rounded-circle float-left" alt="">
            <?php endif ?>
            <div>
              <h4><?=$context['author']['fullname'] ?? "Mr. Emmanuel Sunday"; ?></h4>
              <div class="social-links">
                <a href="javascript:void(0);"><i class="bi bi-twitter"></i></a>
                <a href="javascript:void(0);"><i class="bi bi-facebook"></i></a>
                <a href="javascript:void(0);"><i class="biu bi-instagram"></i></a>
              </div>
              <p>
                Hello, My name is <?=$context['author']['fullname'] ?? "Emmanuel Sunday"; ?> and I'm an automobile enthusiast and also a major stakeholder for Adex Carshop.  I talk about cars and automobiles generally so feel free to drop and share your ideas on this platform.
              </p>
            </div>
          </div><!-- End blog author bio -->

          <div class="blog-comments">

            <h4 class="comments-count"><span id="comments-count"><?=post_comments_total($context['post']['id']) ?? 0; ?></span> Comments</h4>

            <?php 
              $post_id  = intval($context['post']['id']);
              $comments = query_fetch("SELECT * FROM comments WHERE post_id = $post_id"); 
            ?>

              <div class="comments-div">
                <?php if (!empty($comments)): ?> 
                <?php foreach($comments as $comment): ?>
                <div id="comment-2" class="comment">
                  <div class="d-flex">
                    <div class="comment-img"><img src="<?=ROOT; ?>/assets/admin/img/default.png" alt=""></div>
                    <div>
                      <h5><a href="javascript:void(0);"><?=$comment['name']; ?></a> <span class="reply"><i class="bi bi-reply-fill"></i> Reply</span></h5>
                      <time><?=format_datetime($comment['date']); ?></time>
                      <p>
                        <?=$comment['comment']; ?>
                      </p>
                    </div>
                  </div>
                </div><!-- End comment #2-->
                <?php endforeach ?>
                <?php endif ?>
              </div>

            <div class="comment-form mt-3">
              <h4>Leave a Reply</h4>

              <?php if(empty($_SESSION['user'])): ?>
              <p>Your email address will not be published. Required fields are marked * </p>
              <?php endif ?>

              <form method="post" name="comment-form">
                <div class="row">
                  <input name="csrf_token" type="hidden" value="<?=$_SESSION['csrf_token']; ?>">
                  <input name="post_id" type="hidden" class="form-control" value=<?=$context['post']['id']; ?>>
                  <input name="user_id" type="hidden" class="form-control" value="">
                  <?php if(empty($_SESSION['user'])): ?>
                    <div class="col-md-6 form-group">
                      <input name="name" type="text" class="form-control name" maxlength="30" placeholder="Your Name*" maxlength="100" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="email" type="text" class="form-control email" maxlength="60" placeholder="Your Email*" maxlength="100" required>
                    </div>
                  <?php else: ?>
                    <input name="user_id" type="hidden" class="form-control" value=<?=$_SESSION['user']['id']; ?> required>
                    <input name="name" type="hidden" class="form-control name" value="<?=$_SESSION['user']['username']; ?>" required>
                    <input name="email" type="hidden" class="form-control email" value="<?=$_SESSION['user']['email']; ?>" required>
                  <?php endif ?>
                </div>
                <div class="row">
                  <div class="col form-group">
                    <textarea name="comment" class="form-control comment" maxlength="500" placeholder="Your Comment*" required></textarea>
                  </div>
                </div>
                <?php if (isset($_SESSION['message'])): ?>
                <div class="form-group">
                  <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                    <?=$_SESSION['message']; ?>
                  </h6>
                </div>
                <?php endif ?>
                <button class="btn btn-primary mt-2"><span class="btn-text">Post Comment</span></button>
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

<script>
  let totalComments = parseInt(<?=post_comments_total($context['post']['id']) ?? 0; ?>),
  commentsCount = document.querySelector('#comments-count'),
  commentsDiv = document.querySelector('.comments-div'),
  commentForm = document.forms['comment-form'],
  commentBtn = document.querySelector('.btn'),
  btnText = commentBtn.querySelector('.btn-text');

  commentForm.addEventListener('submit', (e)=> {
    e.preventDefault()

    // Loading animation
    let name = commentForm.querySelector('.name').value;
    comment = commentForm.querySelector('.comment').value;
    btnText.innerHTML = `Posting...<img width='30px' src="<?=STATIC_ROOT; ?>/admin/img/spinner-white.svg">`;
    commentBtn.disabled = true;

    // Creating a form object from our form
    let formData = new FormData(commentForm);

    setTimeout(()=> {
      fetch(window.location.href, {
        method: "POST",
        headers: {},
        body: formData
      })
      .then((response)=>{
        return response.json();
      })
      .then((data)=>{
        if (data['status'] == 'success') {
          commentForm.reset();
          commentBtn.disabled = false;
          btnText.innerHTML = `Post Comment`;
          // Updating comments
          let commentDiv = document.createElement('div');
          commentDiv.classList.add('comment');
          commentDiv.innerHTML = `
            <div class="d-flex">
              <div class="comment-img"><img src="<?=ROOT; ?>/assets/admin/img/default.png" alt=""></div>
              <div>
                <h5><a href="javascript:void(0);">${name}</a> <span class="reply"><i class="bi bi-reply-fill"></i> Reply</span></h5>
                <time>${formattedCurrentDateTime()}</time>
                <p>
                  ${comment}
                </p>
              </div>
            </div>
          `;
          commentsDiv.append(commentDiv);
          // Updating total comments
          totalComments += 1;
          commentsCount.textContent = totalComments;
        } else {
          btnText.innerHTML = `Post Comment`;
          commentBtn.disabled = false;
          swal(data['message'], {icon: 'error'});
        }
      })
      .catch((err)=>{
        console.log(err);
        btnText.innerHTML = `Post Comment`;
        commentBtn.disabled = false;
        swal("Error please check network connection", {icon: 'error'});
      })
    }, 1000);
  });
</script>

<script>
  function formatAMPM(date) {
    let hours = date.getHours();
    let minutes = date.getMinutes();
    let ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    let strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
  }

  function formatDate(date) {
    let months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    let day = date.getDate();
    let monthIndex = date.getMonth();
    let year = date.getFullYear();
    return day + ' ' + months[monthIndex] + ', ' + year;
  }

  function formattedCurrentDateTime() {
    let currentDate = new Date();
    let formattedDate = formatDate(currentDate);
    let formattedTime = formatAMPM(currentDate);

    let formattedDateTime = `${formattedDate} ${formattedTime}`;
    return formattedDateTime
  }
</script>

<script type="text/javascript">
  let reply = document.querySelectorAll('.reply')

  reply.forEach((each)=>{
    each.addEventListener('click', function(){
      replyParent = each.parentElement
      name = replyParent.querySelector('a').textContent;
      commentForm['comment'].value = `@${name} `;
      commentForm['comment'].focus();
    })
  })
</script>