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
            <h5 class="text-success">Password reset sent</h5><br/>
            <p style="font-size: 16px;">We've emailed you instructions for setting your password. If an account exists with the email you entered, you should receive them shortly. 
            If you don't receive an email, please make sure you have entered the email address you registered with, or check your spam folder
            </p>
            <div class="mt-5 text-muted text-center">
              Go to <a href="<?=ROOT; ?>/home">home</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>