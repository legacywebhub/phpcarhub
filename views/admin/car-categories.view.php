<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Car Categories  &nbsp;&nbsp;&nbsp;<a href="addcarcategory" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Add Category</a></h4>
                
                <div class="card-header-form">
                    <form action="" method="get">
                      <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="Search Category">
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
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                    <?php if (empty($context['car_categories']['result'])): ?>
                        <tr>
                            <td>
                            No Categories
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($context['car_categories']['result'] as $category): ?>
                        <tr class="mt-2" style="margin-top: 10px !important;">
                            <td><?=$category['id']; ?></td>
                            <td><?=$category['category']; ?></td>
                            <td>
                            <?php if($context['admin']['is_superuser'] == 1): ?>
                                <a href="editcarcategory?id=<?=$category['id']; ?>" class="btn btn-primary btn-action" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                <a href="deletecarcategory?id=<?=$category['id']; ?>" class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-original-title="Delete"><i class="fas fa-trash"></i></a>
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
                <span style="margin: 0px 10px;">Showing Page <b><?=$context['car_categories']['page'] ?></b> 0f <b><?=$context['car_categories']['num_of_pages'] ?></b></span>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($context['car_categories']['has_previous']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['car_categories']['previous_page'] ?>" aria-label="Previous">
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

                        <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?=$context['car_categories']['page'] ?></a></li>


                        <?php if ($context['car_categories']['has_next']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['car_categories']['next_page'] ?>" aria-label="Next">
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
                    <span style="margin: 0px 10px;"><b>Total (<?=$context['car_categories']['total'] ?>)</b></span>
                </div>
            </div>
        </div>
    </div>
</div>