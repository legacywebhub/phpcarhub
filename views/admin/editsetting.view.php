<div class="row">
    <div class="col-12 col-md-9 col-lg-9">
        <div class="card">
            <div class="card-header">
            <h4>Edit Setting</h4>
            </div>

            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="form-group">
                        <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                            <?=$_SESSION['message']; ?>
                        </h6>
                    </div>
                <?php endif ?>
                <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Site Logo</label><br>
                    <img class="image-preview-edit my-3" src="<?=get_image($context['setting']['logo']); ?>" width="100">
                    <input type="file" onchange="displayImageEdit(this.files[0]);" name="logo" class="form-control">
                </div>
                <script>
                    let displayImageEdit = (file) => {
                        document.querySelector('.image-preview-edit').src = URL.createObjectURL(file);
                    };
                </script>
                <div class="form-group">
                    <label>Site Name</label>
                    <input type="text" name="name" value="<?=$context['setting']['name']; ?>"  class="form-control" aria-describedby="nameHelpBlock" required>
                    <small id="nameHelpBlock" class="form-text text-muted">
                    i.e mysite
                    </small>
                </div>
                <div class="form-group">
                    <label>Domain Name</label>
                    <input type="text" name="domain" value="<?=$context['setting']['domain']; ?>" class="form-control" aria-describedby="domainHelpBlock" required>
                    <small id="domainHelpBlock" class="form-text text-muted">
                    i.e mysite.com
                    </small>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="<?=$context['setting']['address']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="<?=$context['setting']['email']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="<?=$context['setting']['phone']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Whatsapp Link</label>
                    <input type="url" name="whatsapp_link" value="<?=$context['setting']['whatsapp_link']; ?>" class="form-control"  aria-describedby="whatsappHelpBlock" required>
                    <small id="whatsappHelpBlock" class="form-text text-muted">
                    This must be a link and not whatsapp phone number i.e http://wa.me/0801234567
                    </small>
                </div>
                <div class="card-footer text-left">
                    <button class="btn btn-lg btn-primary mr-1" type="submit" name="editsetting">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>