<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Car Category</h4>
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
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">  
                    <div class="form-group">
                        <div class="section-title">Car Category <span class="text-danger">*</span></div>
                        <input type="text" class="form-control" name="category" maxlength="60" value="<?=$context['category']['category']; ?>" required>
                    </div>
                    <div class="text-left mt-5">
                        <button class="btn btn-lg btn-primary" name="addpostcategory"><span class="btn-text">Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>