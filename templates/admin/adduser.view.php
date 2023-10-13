<style>
    .form-check {
        display: inline-block;
        margin-right: 30px;
    }
    .form-check label {
        font-size: 18px;
        font-weight: bold;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Add User</h4>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                <div class="form-group">
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                </div>
                <?php endif ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="section-title">Profile Pic </div>
                    <div class="form-group mb-4">
                        <div class="col-sm-12 col-md-7">
                            <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose Image</label>
                            <input type="file" name="profile_pic" id="image-upload">
                            </div>
                        </div>
                    </div>   
                    <div class="form-group">
                        <div class="section-title">Username <span class="text-danger">*</span></div>
                        <input type="text" maxlength="12" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Email <span class="text-danger">*</span></div>
                        <input type="email" maxlength="25" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Password <span class="text-danger">*</span></div>
                        <input type="password" maxlength="25" name="password1" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Confirm Password <span class="text-danger">*</span></div>
                        <input type="password" maxlength="25" name="password2" class="form-control" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_staff" id="staff">
                        <label class="form-check-label" for="staff">
                          Is Staff
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_superuser" id="superuser">
                        <label class="form-check-label" for="superuser">
                          Is Superuser
                        </label>
                    </div>
                    <div class="text-left mt-5">
                        <button class="btn btn-lg btn-primary" name="adduser"><span class="btn-text">Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>