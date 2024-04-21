<?php
$company = query_fetch("SELECT * FROM company LIMIT 1")[0]
?>

<!DOCTYPE html>
<html lang="en">

<!-- errors-404.html  21 Nov 2019 04:05:02 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?=ucwords($company['name']); ?> | 404</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/css/style.css">
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href="<?=STATIC_ROOT; ?>/landing/img/favicon.png" />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner">
            <h1>404</h1>
            <div class="page-description">
              The page you were looking for could not be found.
            </div>
            <div class="page-search">
              <div class="mt-3">
                <a class="btn btn-primary btn-bg text-light" onclick="goBack()">Go Back</a>
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
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="<?=ROOT; ?>/assets/admin/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="<?=ROOT; ?>/assets/admin/js/custom.js"></script>

  <script>
    function goBack() {
      // Check if the referring page is not the current page itself to avoid redirecting to the same page
      if (document.referrer !== window.location.href) {
        window.history.back();
      } else {
        // If the referring page is the same as the current page, simply redirect to a desired page
        window.location.href = '<?=ROOT; ?>/home';
      }
    }
  </script>
</body>

<!-- errors-404.html  21 Nov 2019 04:05:02 GMT -->
</html>