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
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" style="visibility: hidden;">Preview</label>
                <img class="image-preview-edit my-3" src="<?=get_image($context['car']['image']); ?>" width="100">
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Car Image</label>
                <div class="col-sm-12 col-md-7">
                <input name="image" type="file" onchange="displayImageEdit(this.files[0]);">
                </div>
            </div>
            <script>
                let displayImageEdit = (file) => {
                    document.querySelector('.image-preview-edit').src = URL.createObjectURL(file);
                };
            </script>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                <div class="col-sm-12 col-md-7">
                <input name="name" value="<?=$context['car']['name']; ?>" maxlength="60" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Color</label>
                <div class="col-sm-12 col-md-7">
                <select name="color" value="<?=$context['car']['color']; ?>" class="form-control selectric">
                    <option value="">Select Color</option>
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
                <small>Current color: <?=$context['car']['color']; ?></small>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
                <div class="col-sm-12 col-md-7">
                <textarea name="description" class="form-control"><?=$context['car']['description']; ?></textarea>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
                <div class="col-sm-12 col-md-7 input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">N</div>
                </div>
                <input name="price" value="<?=$context['car']['price']; ?>" type="number" class="form-control currency">
                </div>
            </div>
            <div class="form-group row mb-4 mt-2">
                <div class="control-label col-form-label text-md-right col-sm-6 col-md-3 col-lg-3">Available</div>
                <label class="custom-switch">
                <input type="checkbox" name="available" class="custom-switch-input">
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