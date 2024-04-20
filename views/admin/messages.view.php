<div class="row">
    <div class="col-12 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>Messages</h4>
        </div>
        <div class="card-body">
            <?php if (isset($_SESSION['message'])): ?>
                <h6 class="col-12 my-2 text-<?=$_SESSION['message_tag']; ?>" style="display: flex; justify-content: center;">
                    <?=$_SESSION['message']; ?>
                </h6>
            <?php endif ?>
            <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
            <?php if (empty($context['messages']['result'])): ?>
                <li class="media" style="font-size: 16px;">No Messages</li>
            <?php else: ?>
                <?php foreach($context['messages']['result'] as $message): ?>
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
                        <a href="deletemessage?id=<?=$message['id']; ?>" class="text-danger" title="delete"><i class="fas fa-trash"></i></a>
                        </p>
                        <div class="text-info"><?=date("D, d M Y", strtotime($message['date'])); ?></div>
                    </div>
                    </li>
                <?php endforeach ?>
            <?php endif ?>
            </ul>

            <div class="pag-btns">
                <span style="margin: 0px 10px;">Showing Page <b><?=$context['messages']['page'] ?></b> 0f <b><?=$context['messages']['num_of_pages'] ?></b></span>
                <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($context['messages']['has_previous']): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?=$context['messages']['previous_page'] ?>" aria-label="Previous">
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

                    <li class="page-item active"><a class="page-link" href="javascript:void(0)"><?=$context['messages']['page'] ?></a></li>


                    <?php if ($context['messages']['has_next']): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?=$context['messages']['next_page'] ?>" aria-label="Next">
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
                <span style="margin: 0px 10px;"><b>Total (<?=$context['messages']['total'] ?>)</b></span>
            </div>
        </div>
    </div>
    </div>
</div>


<script>
    let messageList = document.querySelectorAll('.media'),
    deleteBtns = document.querySelectorAll('.delete-btn');

    for (i=0; i < deleteBtns.length; i++) {

        deleteBtns[i].addEventListener('click', function(){
            let messageId = this.dataset.id;
            
            fetch(window.location.href, {
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
                return response.json();
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