<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Posts  &nbsp;&nbsp;&nbsp;<a href="addpost" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Add Post</a></h4>
                
                <div class="card-header-form">
                    <form action="" method="get">
                      <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="Search Post">
                        <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['message'])): ?>
                <div class="form-group">
                    <h6 class="col-12 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                        <?=$_SESSION['message']; ?>
                    </h6>
                </div>
                <?php endif ?>

                <div class="table-responsive">
                    <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Created</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                    <?php if (empty($context['posts']['result'])): ?>
                        <tr>
                            <td>
                            No Post
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($context['posts']['result'] as $post): ?>
                        <tr class="mt-2" style="margin-top: 10px !important;">
                            <td><?=$post['id']; ?></td>
                            <td><?=$post['created_at']; ?></td>
                            <td><?=fetch_user($post['user_id']); ?></td>
                            <td><?=fetch_post_category($post['category_id']); ?></td>
                            <td><?=truncate_string($post['title'], 5); ?></td>
                            <td>
                            <?php if($context['admin']['is_superuser'] == 1): ?>
                                <a href="editpost?id=<?=$post['id']; ?>" class="btn btn-primary btn-action" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                <a href="deletepost?id=<?=$post['id']; ?>" class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                            <?php else: ?>
                                <a href="javascript:void(0);" class="btn btn-primary btn-action" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0);" class="btn btn-danger btn-action " data-toggle="tooltip" title="Delete" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                            <?php endif ?>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                    </table>
                </div>

                <div class="pag-btns">
                <span style="margin: 0px 10px;">Showing Page <b><?=$context['posts']['page'] ?></b> 0f <b><?=$context['posts']['num_of_pages'] ?></b></span>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($context['posts']['has_previous']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['posts']['previous_page'] ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php else: ?>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php endif ?>

                        <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?=$context['posts']['page'] ?></a></li>


                        <?php if ($context['posts']['has_next']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['posts']['next_page'] ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                            </a>
                        </li>
                        <?php else: ?>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                            </a>
                        </li>
                        <?php endif ?>
                    </ul>
                    </nav>
                    <span style="margin: 0px 10px;"><b>Total (<?=$context['posts']['total'] ?>)</b></span>
                </div>
            </div>
        </div>
    </div>
</div>