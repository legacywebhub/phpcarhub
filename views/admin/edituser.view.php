<div class="row">
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4>Edit User (<?=$context['this_user']['username']; ?>)</h4>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                    <h6 class="col-12 my-2 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                <?php endif ?>
                
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
                    <div class="form-group">
                        <div class="section-title">Profile Picture</div>
                        <img class="image-preview-edit my-3" src="<?=fetch_image($context['this_user']['profile_pic'], 'users'); ?>" width="150">
                        <input type="file" onchange="previewImage(this.files[0]);" name="profile_pic" class="form-control">
                    </div>
                    <script>
                        let displayImageEdit = (file) => {
                            document.querySelector('.image-preview-edit').src = URL.createObjectURL(file);
                        };
                    </script>
                    <div class="form-group">
                        <div class="section-title">Username</div>
                        <input type="text" maxlength="12" name="username" value="<?=$context['this_user']['username']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="section-title">Email</div>
                        <input type="email" maxlength="25" name="email" value="<?=$context['this_user']['email']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="section-title">Password</div>
                        <input type="password" maxlength="25" name="password1" class="form-control" placeholder="<?=$context['this_user']['password']; ?>">
                        <small>Leave blank to use old password</small>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Confirm Password</div>
                        <input type="password" maxlength="25" name="password2" class="form-control" placeholder="<?=$context['this_user']['password']; ?>">
                    </div>
                    <?php if($context['this_user']['is_staff'] == 1): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_staff" id="staff" checked>
                        <label class="form-check-label" for="staff">
                          Is Staff
                        </label>
                    </div>
                    <?php else: ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_staff" id="staff">
                        <label class="form-check-label" for="staff">
                          Is Staff
                        </label>
                    </div>
                    <?php endif ?>
                    <?php if($context['this_user']['is_superuser'] == 1): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_superuser" id="superuser" checked>
                        <label class="form-check-label" for="superuser">
                          Is Superuser
                        </label>
                    </div>
                    <?php else: ?>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_superuser" id="superuser">
                        <label class="form-check-label" for="superuser">
                          Is Superuser
                        </label>
                    </div>
                    <?php endif ?>
                    <div class="text-left mt-5">
                        <button class="btn btn-lg btn-primary" name="edituser"><span class="btn-text">Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>