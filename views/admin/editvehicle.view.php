<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4>Edit Vehicle</h4>
        </div>
        <div class="card-body">
        <?php if (isset($_SESSION['message'])): ?>
            <h6 class="col-12 my-2 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                <?=$_SESSION['message']; ?>
            </h6>
        <?php endif ?>
        
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
            <div class="image-container my-3 text-center">
                <?php
                    $vehicle_id = $context['vehicle']['vehicle_id'];
                    $vehicle_images = query_fetch("SELECT * FROM vehicle_images WHERE vehicle_id = '$vehicle_id'");
                    
                    if (!empty($vehicle_images)) {
                        foreach($vehicle_images as $vehicle_image) {
                            echo '<img  width="100" src="'.MEDIA_ROOT.'/vehicles/'.$vehicle_image["image"].'">';
                        }
                    }
                ?>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Choose Images</label>
                <div class="col-sm-12 col-md-7">
                    <input type="file" multiple name="images[]" class="form-control" onchange="previewImages(this.files)">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category </label>
                <div class="col-sm-12 col-md-7">
                <select name="category" class="form-control selectric" required>
                    <option value=<?=$context['vehicle']['category_id']; ?>><?=fetch_vehicle_category($context['vehicle']['category_id']); ?></option>
                    <?php foreach($context['categories'] as $category): ?>
                        <option value=<?=$category['id']; ?>><?=$category['category']; ?></option>
                    <?php endforeach ?>
                </select>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                <div class="col-sm-12 col-md-7">
                <input name="name" value="<?=$context['vehicle']['name']; ?>" maxlength="60" type="text" class="form-control" required>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Color</label>
                <div class="col-sm-12 col-md-7">
                <select name="color" class="form-control selectric">
                    <option value="<?=$context['vehicle']['color']; ?>"><?=$context['vehicle']['color']; ?></option>
                    <option value="Black">Black</option>
                    <option value="White">White</option>
                    <option value="Silver">Silver</option>
                    <option value="Gold">Gold</option>
                    <option value="Grey">Grey</option>
                    <option value="Red">Red</option>
                    <option value="Blue">Blue</option>
                    <option value="Yellow">Yellow</option>
                    <option value="Reddish Brown">Reddish Brown</option>
                    <option value="Others">Others</option>
                </select>
                <small class="text-info">Current color: <?=$context['vehicle']['color']; ?></small>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                <div class="col-sm-12 col-md-7">
                <textarea name="description" class="form-control" required><?=$context['vehicle']['description']; ?></textarea>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                <div class="col-sm-12 col-md-7 input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">N</div>
                </div>
                <input type="number" class="form-control currency" name="price" value="<?=$context['vehicle']['price']; ?>" onkeypress="return onlyNumberKey(event)" required>
                </div>
            </div>
            <div class="form-group row mb-4 mt-2">
                <div class="control-label col-form-label text-md-right col-sm-6 col-md-3 col-lg-3">Available</div>
                <label class="custom-switch">
                <?php if ($context['vehicle']['available']==1): ?>
                    <input type="checkbox" name="available" class="custom-switch-input" checked>
                <?php else: ?>
                    <input type="checkbox" name="available" class="custom-switch-input">
                <?php endif ?>
                <span class="custom-switch-indicator"></span>
                </label>
            </div>
            <div class="form-group row my-3">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <div class="col-sm-12 col-md-7">
                <button name="editvehicle" class="btn btn-lg btn-primary">Submit</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>