<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Vehicle List  &nbsp;&nbsp;&nbsp;<a href="addvehicle" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Add Vehicle</a></h4>
                
                <div class="card-header-form">
                    <form action="" method="get">
                      <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="Search vehicle name">
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
                        <th>Category</th>
                        <th>Images</th>
                        <th>Vehicle Name</th>
                        <th>Price</th>
                        <th>Available</th>
                        <th>Date Uploaded</th>
                        <th>Action</th>
                    </tr>
                    <?php if (empty($context['vehicles']['result'])): ?>
                        <tr>
                            <td>
                            No Results Found
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($context['vehicles']['result'] as $vehicle): ?>
                        <tr class="mt-2" style="margin-top: 10px !important;">
                            <td><?=fetch_vehicle_category($vehicle['category_id']); ?></td>
                            <td>
                                <?php
                                $vehicle_id = $vehicle['vehicle_id'];
                                $vehicle_images = query_fetch("SELECT * FROM vehicle_images WHERE vehicle_id = '$vehicle_id'");
                                
                                if (empty($vehicle_images)) {
                                    echo "No Image";
                                } else {
                                    foreach($vehicle_images as $vehicle_image) {
                                        echo '<img  width="30" src="'.MEDIA_ROOT.'/vehicles/'.$vehicle_image["image"].'">';
                                    }
                                }
                                
                                ?>
                            </td>
                            <td><?=$vehicle['name']; ?></td>
                            <td><?=$vehicle['price']; ?></td>
                            <td class="align-middle">
                            <?php if($vehicle['available'] == 1): ?>
                            <div class="badge badge-success">Yes</div>
                            <?php else: ?>
                            <div class="badge badge-danger">No</div>
                            <?php endif ?>
                            </td>
                            <td><?=date("d-m-Y", strtotime($vehicle['date_uploaded'])); ?></td>
                            <td>
                            <a href="editvehicle?id=<?=$vehicle['id']; ?>" class="btn btn-primary btn-action" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                            <a href="deletevehicle?id=<?=$vehicle['id']; ?>" class="btn btn-danger btn-action" data-toggle="tooltip" title="" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="alert('Deleted')" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                    </table>
                </div>

                <div class="pag-btns">
                <span style="margin: 0px 10px;">Showing Page <b><?=$context['vehicles']['page'] ?></b> 0f <b><?=$context['vehicles']['num_of_pages'] ?></b></span>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($context['vehicles']['has_previous']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['vehicles']['previous_page'] ?>" aria-label="Previous">
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

                        <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?=$context['vehicles']['page'] ?></a></li>


                        <?php if ($context['vehicles']['has_next']): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?=$context['vehicles']['next_page'] ?>" aria-label="Next">
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
                    <span style="margin: 0px 10px;"><b>Total (<?=$context['vehicles']['total'] ?>)</b></span>
                </div>
            </div>
        </div>
    </div>
</div>