<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Image</h4>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                    <h6 class="col-12 my-2 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                <?php endif ?>
                <img class="image-preview my-3" src="<?=fetch_image($context['image']['image'], 'vehicles'); ?>">
                <form method="post" enctype="multipart/form-data">
                  <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>"> 
                  <div class="form-group">
                    <label>Choose Image</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-file"></i>
                        </div>
                      </div>
                      <input type="file" name="image" class="form-control" accept=".jpg, .jpeg, .png" onchange="previewImage(this.files[0]);" required>
                    </div>
                    <small class="text-danger">Only .jpeg, jpg, .png files are accepted</small>
                  </div>
                  <button class="btn btn-primary mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>