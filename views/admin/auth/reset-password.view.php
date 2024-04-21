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
            <?php if (isset($_SESSION['message'])): ?>
            <p class="text-center text-<?=$_SESSION['message_tag']; ?>"><?=$_SESSION['message']; ?></p>
            <?php endif ?>
            <form method="POST" action="" class="needs-validation" novalidate="">
              <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
              <input type="hidden" name="token" value="<?=$context['token']; ?>">
              <div class="form-group">
                <label for="email">Enter your new password</label>
                <input type="password" name="password1" class="form-control" minlength="5" maxlength="60" tabindex="2" required>
                <div class="invalid-feedback">
                  please fill in your new password
                </div>
              </div>
              <div class="form-group">
                <label for="email">Confirm password</label>
                <input type="password" name="password2" class="form-control" minlength="5" maxlength="60" tabindex="2" required>
                <div class="invalid-feedback">
                  please confirm your password
                </div>
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-lg btn-block" tabindex="4">
                  Submit
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>