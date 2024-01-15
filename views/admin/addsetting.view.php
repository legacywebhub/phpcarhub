<div class="row">
    <div class="col-12 col-md-9 col-lg-9">
        <div class="card">
            <div class="card-header">
            <h4>Add Setting</h4>
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
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                    <div class="form-group">
                        <label>Site Logo</label>
                        <input type="file" name="logo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Site Name <span class="text-danger">*</span></label>
                        <input type="text" name="name"  class="form-control" aria-describedby="nameHelpBlock" required>
                        <small id="nameHelpBlock" class="form-text text-muted">
                        i.e mysite
                        </small>
                    </div>
                    <div class="form-group">
                        <label>Domain Name <span class="text-danger">*</span></label>
                        <input type="text" name="domain" class="form-control" aria-describedby="domainHelpBlock" required>
                        <small id="domainHelpBlock" class="form-text text-muted">
                        i.e mysite.com
                        </small>
                    </div>
                    <div class="form-group">
                        <label>Address <span class="text-danger">*</span></label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Phone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Whatsapp Link <span class="text-danger">*</span></label>
                        <input type="url" name="whatsapp_link" class="form-control"  aria-describedby="whatsappHelpBlock">
                        <small id="whatsappHelpBlock" class="form-text text-muted">
                        This must be a link and not whatsapp phone number i.e http://wa.me/0801234567
                        </small>
                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-lg btn-primary mr-1" type="submit" name="addsetting">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>