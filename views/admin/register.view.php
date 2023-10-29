<!DOCTYPE html>
<html lang="en">

<!-- auth-register.html  21 Nov 2019 04:05:01 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?=$context['title']; ?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/css/app.min.css">
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/bundles/jquery-selectric/selectric.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/css/style.css">
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='<?=ROOT; ?>/assets/admin/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Register</h4>
              </div>
              <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                  <p class="text-center text-<?=$_SESSION['message_tag']; ?>"><?=$_SESSION['message']; ?></p>
                <?php endif ?>
                <form method="POST" action="">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="username">Username</label>
                      <input id="username" type="text" class="form-control" name="username" autofocus required>
                    </div>
                    <div class="form-group col-6">
                      <label for="email">Email</label>
                      <input id="email" type="text" class="form-control" name="email" required>
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email">
                    <div class="invalid-feedback">
                    </div>
                  </div> -->
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password1" class="d-block">Password</label>
                      <input id="password1" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password1" required>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="password2" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button name="register" type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
                  </div>
                </form>
              </div>
              <div class="mb-4 text-muted text-center">
                Already Registered? <a href="login">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="<?=ROOT; ?>/assets/admin/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?=ROOT; ?>/assets/admin/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="<?=ROOT; ?>/assets/admin/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?=ROOT; ?>/assets/admin/js/page/auth-register.js"></script>
  <!-- Template JS File -->
  <script src="<?=ROOT; ?>/assets/admin/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="<?=ROOT; ?>/assets/admin/js/custom.js"></script>
</body>


<!-- auth-register.html  21 Nov 2019 04:05:02 GMT -->
</html>