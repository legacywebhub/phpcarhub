<section class="section">
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="card card-primary">
          <div class="card-header">
            <div style="width: 150px;">
              <img alt="image" src="<?=STATIC_ROOT; ?>/landing/img/logo-dark.png" width="100%" alt="<?=strtoupper($context['company']['name']); ?>" />
            </div>
          </div>
          <div class="card-body">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
            <?php if (isset($_SESSION['message'])): ?>
            <p class="text-center text-<?=$_SESSION['message_tag']; ?>"><?=$_SESSION['message']; ?></p>
            <?php endif ?>
            <form method="POST" action="" class="needs-validation" novalidate="">
              <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
              <div class="form-group">
                <label for="email">Enter your email:</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                  Please fill in your email
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                  Submit
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="mt-5 text-muted text-center">
          Go to <a href="login">login</a>
        </div>
      </div>
    </div>
  </div>
</section>