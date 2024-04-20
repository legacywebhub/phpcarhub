<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Comment</h4>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                <?php endif ?>
                
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']; ?>">  
                    <div class="form-group">
                        <div class="section-title">Commenter Name </div>
                        <input type="text" class="form-control" name="name" maxlength="60" value="<?=$context['comment']['name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Commmenter Email </div>
                        <input type="email" class="form-control" name="email" maxlength="60" value="<?=$context['comment']['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <div class="section-title">Comment </div>
                        <textarea cols="30" rows="10" class="form-control" name="comment" maxlength="1050" required>
                        <?=$context['comment']['comment']; ?>
                        </textarea>
                    </div>
                    <div class="text-left mt-5">
                        <button class="btn btn-lg btn-primary" name="editcomment"><span class="btn-text">Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>