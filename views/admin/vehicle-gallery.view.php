<!-- Main Content -->
<div class="main-content">
<section class="section">
    <div class="section-body">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
        <div class="card">
            <div class="card-header">
            <h4>Vehicle Gallery</h4>
            </div>
            <div class="card-body">
                <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                    <?php foreach($context['images']['result'] as $image): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <a href="editvehicleimage?id=<?=$image['id']; ?>" data-sub-html="Demo Description">
                        <img class="img-responsive thumbnail" src="<?=fetch_image($image['image'], 'vehicles')?>" alt="">
                    </a>
                    </div>
                    <?php endforeach ?>
                    
                    <div class="pag-btns">
                        <span style="margin: 0px 10px;">Showing Page <b><?=$context['images']['page'] ?></b> 0f <b><?=$context['images']['num_of_pages'] ?></b></span>
                        <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php if ($context['images']['has_previous']): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?=$context['images']['previous_page'] ?>" aria-label="Previous">
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

                            <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?=$context['images']['page'] ?></a></li>


                            <?php if ($context['images']['has_next']): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?=$context['images']['next_page'] ?>" aria-label="Next">
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
                        <span style="margin: 0px 10px;"><b>Total (<?=$context['images']['total'] ?>)</b></span>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
</div>