<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Contact</h2>
        <ol>
          <li><a href="home">Home</a></li>
          <li>Contact</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Contact Section ======= -->
  <div class="map-section">
    <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
  </div>

  <section id="contact" class="contact">
    <div class="container">

      <div class="row justify-content-center" data-aos="fade-up">

        <div class="col-lg-10">

          <div class="info-wrap">
            <div class="row">
              <div class="col-lg-4 info">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p><?=$context['company']['address']; ?></p>
              </div>

              <div class="col-lg-4 info mt-4 mt-lg-0">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p><?=$context['company']['email']; ?></p>
              </div>

              <div class="col-lg-4 info mt-4 mt-lg-0">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p><?=$context['company']['phone']; ?></p>
              </div>
            </div>
          </div>

        </div>

      </div>

      <div class="row mt-5 justify-content-center" data-aos="fade-up">
        <div class="col-lg-10">
          <form method="post" name="contact-form">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="my-3">
              <div class="message"></div>
            </div>
            <div class="text-center"><button class="btn btn-danger" type="submit"><span class="btn-text">Send Message</span></button></div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

</main><!-- End #main -->

<script>
    let contactForm = document.forms['contact-form'],
    contactBtn = document.querySelector('.btn'),
    url = window.location.href;


    contactForm.addEventListener('submit', (e)=> {
        e.preventDefault()

        let data = {
            'name': contactForm['name'].value,
            'email': contactForm['email'].value,
            'subject': contactForm['subject'].value,
            'message': contactForm['message'].value,
            'csrf_token': contactForm['csrf_token'].value,
        };

        console.log(data);

        // Loading animation
        let btnText = contactBtn.querySelector('.btn-text');
        btnText.innerHTML = `Sending...<img width='30px' src="<?=ROOT; ?>/assets/admin/img/spinner-white.svg">`;
        contactBtn.disabled = true;

        fetch(url, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then((response)=>{
            return response.json()
        })
        .then((data)=>{
            console.log(data);
            if (data == 'success') {
                btnText.innerHTML = `Success`;
                setTimeout(()=>{
                    if (confirm('Message was successfully sent')) {
                        contactForm.reset();
                    }
                }, 2000)
            } else {
                btnText.innerHTML = `Send`;
                contactBtn.disabled = false;
                alert("Service not available at the moment");
            }
        })
        .catch((err)=>{
            console.log(err);
            btnText.innerHTML = `Send`;
            contactBtn.disabled = false;
            alert("Service not available at the moment");
        })


    });

</script>