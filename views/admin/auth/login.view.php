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
            <p class="ml-3 my-2 font-20 font-weight-bold">Ciao Admin!</p>
            <?php if (isset($_SESSION['message'])): ?>
            <p class="text-center text-<?=$_SESSION['message_tag']; ?>"><?=$_SESSION['message']; ?></p>
            <?php endif ?>
            <form method="POST" action="" class="needs-validation" novalidate="">
              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                  Please fill in your email
                </div>
              </div>
              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                  <div class="float-right">
                    <a href="forgot-password" class="text-small">
                      Forgot Password?
                    </a>
                  </div>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                <div class="invalid-feedback">
                  please fill in your password
                </div>
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                  <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
              </div>
              <div class="form-group">
                <button name="login" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                  Login
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="mt-5 text-muted text-center">
          Go to <a href="<?=ROOT; ?>/home">home</a>
        </div>
      </div>
    </div>
  </div>
</section>