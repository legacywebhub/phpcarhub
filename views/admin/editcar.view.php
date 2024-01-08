<style>
    input {
        font-size: 18px !important;
        font-weight: bold;
    }
</style>

<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4>Edit Car</h4>
        </div>
        <div class="card-body">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="form-group">
                <h3 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                    <?=$_SESSION['message']; ?>
                </h3>
            </div>
        <?php endif ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">
            <div class="image-container my-3 text-center">
                <?php
                    $car_id = $context['car']['car_id'];
                    $car_images = query_fetch("SELECT * FROM car_images WHERE car_id = '$car_id'");
                    
                    if (!empty($car_images)) {
                        foreach($car_images as $car_image) {
                            echo '<img  width="100" src="'.MEDIA_ROOT.'/cars/'.$car_image["image"].'">';
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
                    <option value=<?=$context['car']['category_id']; ?>><?=fetch_post_category($context['car']['category_id']); ?></option>
                    <?php foreach($context['categories'] as $category): ?>
                        <option value=<?=$category['id']; ?>><?=$category['category']; ?></option>
                    <?php endforeach ?>
                </select>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                <div class="col-sm-12 col-md-7">
                <input name="name" value="<?=$context['car']['name']; ?>" maxlength="60" type="text" class="form-control" required>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Color</label>
                <div class="col-sm-12 col-md-7">
                <select name="color" class="form-control selectric">
                    <option value="<?=$context['car']['color']; ?>"><?=$context['car']['color'] || "Select Color"; ?></option>
                    <option value="Black">Black</option>
                    <option value="White">White</option>
                    <option value="Silver">Silver</option>
                    <option value="Gold">Gold</option>
                    <option value="Grey">Grey</option>
                    <option value="Red">Red</option>
                    <option value="Blue">Blue</option>
                    <option value="Reddish Brown">Reddish Brown</option>
                    <option value="Others">Others</option>
                </select>
                <small class="text-info">Current color: <?=$context['car']['color']; ?></small>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                <div class="col-sm-12 col-md-7">
                <textarea name="description" class="form-control" required><?=$context['car']['description']; ?></textarea>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                <div class="col-sm-12 col-md-7 input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">N</div>
                </div>
                <input type="number" class="form-control currency" name="price" value="<?=$context['car']['price']; ?>" onkeypress="return onlyNumberKey(event)" required>
                </div>
            </div>
            <div class="form-group row mb-4 mt-2">
                <div class="control-label col-form-label text-md-right col-sm-6 col-md-3 col-lg-3">Available</div>
                <label class="custom-switch">
                <?php if ($context['car']['available']==1): ?>
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
                <button name="editcar" class="btn btn-lg btn-primary">Submit</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>