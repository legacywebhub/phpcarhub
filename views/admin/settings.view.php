<style>
    .table {
        font-size: 18px;
    }
</style>

<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Company Settings</h4>
                
                <?php if (empty($context['settings'])): ?>
                <div class="card-header-form">
                    <a href="addsetting" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Add Setting</a>
                </div>
                <?php endif ?>
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
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    <?php if (empty($context['settings'])): ?>
                        <tr>
                            <td>
                            No Results Found
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($context['settings'] as $setting): ?>
                        <tr class="mt-2" style="margin-top: 10px !important;">
                            <?php if(empty($setting['logo'])): ?>
                                <td>-</td>
                            <?php else: ?>
                                <td><img src="<?=get_image($setting['logo']); ?>" width="100"></td>
                            <?php endif ?>
                            <td><?=$setting['name']; ?></td>
                            <td><?=$setting['email']; ?></td>
                            <td>
                            <a href="editsetting?id=<?=$setting['id']; ?>" class="btn btn-primary btn-action" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0);" class="btn btn-danger btn-action" data-toggle="tooltip" title="" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="alert('Deleted')" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>