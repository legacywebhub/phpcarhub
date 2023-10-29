<style>
    .buttons {
        margin: 30px 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .table {
        font-size: 18px;
    }
</style>

<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Users List  &nbsp;&nbsp;&nbsp;<a href="adduser" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Add User</a></h4>
                
                <div class="card-header-form">
                    <form action="" method="get">
                      <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="Search username">
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
                        <th>Profile</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Staff</th>
                        <th>Superuser</th>
                        <th>Date Joined</th>
                        <th>Action</th>
                    </tr>
                    <?php if (empty($context['users']['result'])): ?>
                        <tr>
                            <td>
                            No Users Yet
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($context['users']['result'] as $user): ?>
                        <tr class="mt-2" style="margin-top: 10px !important;">
                            <td>
                                <img src="<?=get_image($user['profile_pic']); ?>" width="100">
                            </td>
                            <td><?=$user['username']; ?></td>
                            <td><?=$user['email']; ?></td>
                            <td class="align-middle">
                            <?php if($user['is_staff'] == 1): ?>
                            <div class="badge badge-success">Yes</div>
                            <?php else: ?>
                            <div class="badge badge-danger">No</div>
                            <?php endif ?>
                            </td>
                            <td class="align-middle">
                            <?php if($user['is_superuser'] == 1): ?>
                            <div class="badge badge-success">Yes</div>
                            <?php else: ?>
                            <div class="badge badge-danger">No</div>
                            <?php endif ?>
                            </td>
                            <td><?=date("d-m-Y", strtotime($user['date_joined'])); ?></td>
                            <td>
                            <?php if($context['user']['is_superuser'] == 1): ?>
                                <a href="edituser?id=<?=$user['id']; ?>" class="btn btn-primary btn-action" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                <a href="deleteuser?id=<?=$user['id']; ?>" class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-original-title="Delete"><i class="fas fa-trash"></i></a>
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

                <div class="buttons">
                <span style="margin: 0px 10px;">Showing Page <b><?=$context['users']['page'] ?></b> 0f <b><?=$context['users']['num_of_pages'] ?></b></span>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($context['users']['has_previous']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['users']['previous_page'] ?>" aria-label="Previous">
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

                        <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?=$context['users']['page'] ?></a></li>


                        <?php if ($context['users']['has_next']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['users']['next_page'] ?>" aria-label="Next">
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
                    <span style="margin: 0px 10px;"><b>Total (<?=$context['users']['total'] ?>)</b></span>
                </div>
            </div>
        </div>
    </div>
</div>