<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Post</h4>
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
                        <div class="section-title">Category </div>
                        <select name="category" class="form-control selectric" required>
                            <option value=<?=$context['post']['category_id']; ?>><?=fetch_post_category($context['post']['category_id']); ?></option>
                            <?php foreach($context['categories'] as $category): ?>
                                <option value=<?=$category['id']; ?>><?=$category['category']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Image </div>
                        <div class="image-container"></div>
                        <input type="text" class="form-control" name="image" placeholder="Insert image address" maxlength="2050" onchange="previewPostImage(this.value)" value="<?=$context['post']['image']; ?>">
                    </div>
                    <div class="form-group">
                        <div class="section-title">Title <span class="text-danger">*</span></div>
                        <input type="text" class="form-control" name="title" maxlength="200" value="<?=$context['post']['title']; ?>" required>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Content <span class="text-danger">*</span></div>
                        <textarea class="form-control summernote" name="content" maxlength="50500" required>
                        <?=$context['post']['content']; ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Quote </div>
                        <textarea cols="30" rows="10" class="form-control" name="quote" maxlength="200">
                        <?=$context['post']['quote']; ?>
                        </textarea>
                    </div>
                    <div class="text-left mt-5">
                        <button class="btn btn-lg btn-primary" name="addpost"><span class="btn-text">Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>