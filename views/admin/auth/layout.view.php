<!DOCTYPE html>
<html lang="en">

<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?=$context['title']; ?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/admin/css/app.min.css">
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/admin/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/admin/css/style.css">
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/admin/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?=STATIC_ROOT; ?>/admin/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href="<?=STATIC_ROOT; ?>/landing/img/favicon.png" />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <!-- Content Goes Here -->
    <?php require("$name.view.php"); ?>
    <!-- End Content -->
  </div>
  <!-- General JS Scripts -->
  <script src="<?=STATIC_ROOT; ?>/admin/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="<?=STATIC_ROOT; ?>/admin/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="<?=STATIC_ROOT; ?>/admin/js/custom.js"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>