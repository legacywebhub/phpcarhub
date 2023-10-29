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
            <h4>Add Car</h4>
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
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Car Image <span class="text-danger">*</span></label>
                <div class="col-sm-12 col-md-7">
                <div id="image-preview" class="image-preview">
                    <label for="image-upload" id="image-label">Choose File</label>
                    <input name="image" type="file" name="image" id="image-upload" multiple />
                </div>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name <span class="text-danger">*</span></label>
                <div class="col-sm-12 col-md-7">
                <input name="name" maxlength="60" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Color <span class="text-danger">*</span></label>
                <div class="col-sm-12 col-md-7">
                <select name="color" class="form-control selectric" required>
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
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description <span class="text-danger">*</span></label>
                <div class="col-sm-12 col-md-7">
                <textarea name="description" class="form-control" required></textarea>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price <span class="text-danger">*</span></label>
                <div class="col-sm-12 col-md-7 input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">N</div>
                </div>
                <input name="price" type="number" class="form-control currency" required>
                </div>
            </div>
            <!--
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-sm-6 col-md-3 col-lg-3">Available</label>
                <div class="selectgroup w-50" style="margin-left: 15px;">
                <label class="selectgroup-item">
                    <input type="radio" name="available" value=1 class="selectgroup-input-radio" checked>
                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-check"></i></span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="available" value=0 class="selectgroup-input-radio" disabled>
                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-times"></i></span>
                </label>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-sm-6 col-md-3 col-lg-3">Available</label>
                <div class="selectgroup selectgroup-pills" style="margin-left: 15px;">
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked>
                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-check"></i></span>
                </label>
                <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input">
                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-times"></i></span>
                </label>
                </div>
            </div>
            -->
            <div class="form-group row mb-4 mt-2">
                <div class="control-label col-form-label text-md-right col-sm-6 col-md-3 col-lg-3">Available</div>
                <label class="custom-switch">
                <input type="checkbox" name="available" class="custom-switch-input" checked>
                <span class="custom-switch-indicator"></span>
                </label>
            </div>
            <div class="form-group row my-3">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <div class="col-sm-12 col-md-7">
                <button name="addcar" class="btn btn-lg btn-primary">Submit</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>
