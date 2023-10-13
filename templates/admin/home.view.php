<style>
    .total {
        font-size: 30px;
    }
</style>
<div class="row ">
    <div class="col-xl-6 col-lg-6">
    <div class="card l-bg-green">
        <div class="card-statistic-3">
        <div class="card-icon card-icon-large"><i class="fa fa-user"></i></div>
        <div class="card-content">
            <h4 class="card-title">Total Users</h4>
            <span class="total"><?=$context['total_users']; ?></span>
            <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
            <div class="progress-bar l-bg-purple" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
            </div>
            <p class="mb-0 text-sm">
            <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
            <span class="text-nowrap">Since last month</span>
            </p>
        </div>
        </div>
    </div>
    </div>
    <div class="col-xl-6 col-lg-6">
    <div class="card l-bg-cyan">
        <div class="card-statistic-3">
        <div class="card-icon card-icon-large"><i class="fa fa-car"></i></div>
        <div class="card-content">
            <h4 class="card-title">Total Cars</h4>
            <span class="total"><?=$context['total_cars']; ?></span>
            <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
            <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
            </div>
            <p class="mb-0 text-sm">
            <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
            <span class="text-nowrap">Since last month</span>
            </p>
        </div>
        </div>
    </div>
    </div>
    <div class="col-xl-6 col-lg-6">
    <div class="card l-bg-purple">
        <div class="card-statistic-3">
        <div class="card-icon card-icon-large"><i class="fa fa-envelope"></i></div>
        <div class="card-content">
            <h4 class="card-title">Total Messages</h4>
            <span class="total"><?=$context['total_messages']; ?></span>
            <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
            </div>
            <p class="mb-0 text-sm">
            <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
            <span class="text-nowrap">Since last month</span>
            </p>
        </div>
        </div>
    </div>
    </div>
    <div class="col-xl-6 col-lg-6">
    <div class="card l-bg-orange">
        <div class="card-statistic-3">
        <div class="card-icon card-icon-large"><i class="fa fa-user-circle"></i></div>
        <div class="card-content">
            <h4 class="card-title">Total Staffs</h4>
            <span class="total"><?=$context['total_staffs']; ?></span>
            <div class="progress mt-1 mb-1" data-height="8" style="height: 8px;">
            <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
            </div>
            <p class="mb-0 text-sm">
            <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
            <span class="text-nowrap">Since last month</span>
            </p>
        </div>
        </div>
    </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>Most Recent Messages</h4>
        </div>
        <div class="card-body">
            <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
            <?php if (empty($context['messages'])): ?>
                <li class="media" style="font-size: 16px;">No Messages</li>
            <?php else: ?>
                <?php foreach($context['messages'] as $message): ?>
                    <li class="media" style="font-size: 16px;">
                    <span class="mr-3"><i data-feather="bell"></i></span>
                    <div class="media-body">
                        <h5 class="mb-1 text-uppercase"><?=$message['subject']; ?></h5>
                        <div class="media-description text-muted mt-2"><?=$message['message']; ?></div>
                        <p class="mt-3">
                        <span><?=$message['name']; ?></span>
                        <span class="bullet"></span>
                        <span><?=$message['email']; ?></span>
                        <span class="bullet"></span>
                        <span class="text-danger delete-btn" title="delete" data-id=<?=$message['id']; ?>><i class="fas fa-trash"></i></span>
                        </p>
                        <div class="text-info"><?=date("D, d M Y", strtotime($message['date'])); ?></div>
                    </div>
                    </li>
                <?php endforeach ?>
            <?php endif ?>
            </ul>
        </div>
    </div>
    </div>
</div>

<script>
    let messageList = document.querySelectorAll('.media'),
    deleteBtns = document.querySelectorAll('.delete-btn'),
    url = `<?=ROOT; ?>/admin/home.php/`;

    for (i=0; i < deleteBtns.length; i++) {

        deleteBtns[i].addEventListener('click', function(){
            let messageId = this.dataset.id;
            
            fetch(url, {
                method: "POST",
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': "application/json"
                },
                body: JSON.stringify({'id':messageId})
            })
            .then((response)=>{
                return response.json()
            })
            .then((data)=>{
                console.log(data);
                if (data == "success") {
                    this.parentElement.parentElement.parentElement.innerHTML = "";
                } else {
                    alert("Unknown error occured");
                }
            })
            .catch((err)=>{
                console.log(err);
            })

        });
    }
</script>