<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $context['title']; ?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/css/app.min.css">
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/css/app.min.css">
  <!-- Libraries -->
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/bundles/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/bundles/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/css/style.css">
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?=ROOT; ?>/assets/admin/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href="<?=ROOT; ?>/assets/admin/img/favicon.ico" />
  <!-- Inline style CSS -->
  <style>
    .form-check {
        display: inline-block;
        margin-right: 30px;
    }
    .form-check label {
        font-size: 18px;
        font-weight: bold;
    }
    input {
        font-size: 18px !important;
        font-weight: bold;
    }
    .table {
        font-size: 15px;
    }
    .pag-btns {
        margin: 30px 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .image-preview {
      width: 100px;
      height: 100px;
    }
  </style>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                <i data-feather="align-justify"></i>
                </a>
            </li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <?php if (!empty($context['user']['profile_pic'])): ?>
              <img alt="image" src="<?=fetch_image($context['admin']['profile_pic'], 'users'); ?>" class="user-img-radious-style">
            <?php else: ?>
              <img alt="image" src="<?=ROOT; ?>/assets/admin/img/default.png" class="user-img-radious-style">
            <?php endif ?>
            <span class="d-sm-none d-lg-inline-block"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">WELCOME <?=$context['admin']['username']; ?></div>
              <a href="<?=ROOT; ?>/admin/edituser?id=<?=$context['admin']['id']; ?>" class="dropdown-item has-icon"> <i class="far fa-user"></i> 
                Profile
              </a>
              <a href="<?=ROOT; ?>/admin/cars" class="dropdown-item has-icon"> <i class="fas fa-car"></i>
                Cars
              </a>
              <a href="<?=ROOT; ?>/admin/settings" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Company Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?=ROOT; ?>/admin/logout" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?=ROOT; ?>/admin/dashboard">
            <?php if (!empty($context['company']['logo'])): ?>
              <img alt="image" src="<?=fetch_image($context['company']['logo'], 'users'); ?>" class="header-logo" />
            <?php else: ?>
              <img alt="image" src="<?=ROOT; ?>/assets/admin/img/logo.png" class="header-logo" />
            <?php endif ?>
            <span class="logo-name"><?=strtoupper($context['company']['name']); ?></span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="dropdown active">
              <a href="<?=ROOT; ?>/admin/dashboard" class="nav-link"><i data-feather="grid"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user"></i><span>Users</span></a>
              <ul class="dropdown-menu">
                <li><a  href="<?=ROOT; ?>/admin/users" class="nav-link">Users</a></li>
                <li><a  href="<?=ROOT; ?>/admin/adduser" class="nav-link">Add Users</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Cars</span></a>
              <ul class="dropdown-menu">
              <li><a  href="<?=ROOT; ?>/admin/car-categories" class="nav-link">Categories</a></li>
                <li><a  href="<?=ROOT; ?>/admin/addcarcategory" class="nav-link">Add Category</a></li>
                <li><a  href="<?=ROOT; ?>/admin/cars" class="nav-link">Cars</a></li>
                <li><a  href="<?=ROOT; ?>/admin/addcar" class="nav-link">Add Car</a></li>
                <li><a  href="<?=ROOT; ?>/admin/car-images" class="nav-link">Car Images</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="file-text"></i><span>Blog</span></a>
              <ul class="dropdown-menu">
                <li><a  href="<?=ROOT; ?>/admin/post-categories" class="nav-link">Categories</a></li>
                <li><a  href="<?=ROOT; ?>/admin/addpostcategory" class="nav-link">Add Category</a></li>
                <li><a  href="<?=ROOT; ?>/admin/posts" class="nav-link">Posts</a></li>
                <li><a  href="<?=ROOT; ?>/admin/addpost" class="nav-link">Add Post</a></li>
                <li><a  href="<?=ROOT; ?>/admin/comments" class="nav-link">Comments</a></li>
              </ul>
            </li>
            <li class="menu-header">Others</li>
            <li class="dropdown">
              <a href="<?=ROOT; ?>/admin/settings" class="nav-link"><i data-feather="settings"></i><span>Settings</span></a>
            </li>
            <li class="dropdown">
              <a href="<?=ROOT; ?>/admin/messages" class="nav-link"><i data-feather="mail"></i><span>Messages</span></a>
            </li>
            <li class="dropdown">
              <a href="<?=ROOT; ?>/admin/logout" class="nav-link"><i data-feather="log-out"></i><span>Logout</span></a>
            </li>
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <!-- Content Goes Here -->
          <?php require("$name.view.php"); ?>
          <!-- End Content -->
        </section>
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          <span>Copyright &copy; <?=date("Y"); ?></span>
        </div>
        <div class="footer-right">
          Developed by: Legacy Tech Hub - 09160755152, 09017570620 
        </div>
      </footer>
    </div>
  </div>

    <!-- General JS Scripts -->
    <script src="<?=ROOT; ?>/assets/admin/js/app.min.js"></script>
    <!-- JS Libraies -->
    <script src="<?=ROOT; ?>/assets/admin/bundles/summernote/summernote-bs4.js"></script>
    <script src="<?=ROOT; ?>/assets/admin/bundles/upload-preview/jquery.uploadPreview.min.js"></script>
    <script src="<?=ROOT; ?>/assets/admin/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="<?=ROOT; ?>/assets/admin/bundles/jquery-selectric/jquery.selectric.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="<?=ROOT; ?>/assets/admin/js/page/create-post.js"></script>
    <!-- Page Specific JS File -->
    <script src="<?=ROOT; ?>/assets/admin/js/page/index.js"></script>
    <!-- Template JS File -->
    <script src="<?=ROOT; ?>/assets/admin/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="<?=ROOT; ?>/assets/admin/js/custom.js"></script>
    <!-- Inline script -->
    <script>
      // This function previews single uploaded images from file input
      let previewImage = (file) => {
        document.querySelector('.image-preview').src = URL.createObjectURL(file);
      };

      // This function previews multiple uploaded images from file input 
      let previewImages = (files) => {
        // Get the container element where image previews will be displayed
        let imageContainer = document.querySelector('.image-container');
        
        // Clear existing previews
        imageContainer.innerHTML = '';

        // Loop through each selected file and create a preview
        for (const file of files) {
            // Create a new image element
            let imageElement = document.createElement('img');
            imageElement.classList.add('image-preview');

            // Set the source of the image element to the URL of the selected file
            imageElement.src = URL.createObjectURL(file);

            // Append the image element to the container
            imageContainer.appendChild(imageElement);
        }
      };

      // This function previews image from external image link
      let previewPostImage = (text) => {
        try {
          console.log(text);

          // Get the container element where image previews will be displayed
          let imageContainer = document.querySelector('.image-container');
        
          // Clear existing previews
          imageContainer.innerHTML = '';

          // Create a new image element
          let imageElement = document.createElement('img');
          imageElement.classList.add('image-preview');
          imageElement.style.width = "150px";

          // Set the source of the image element to the URL of the selected file
          imageElement.src = text;

          // Append the image element to the container
          imageContainer.appendChild(imageElement);
          //document.querySelector('.image-preview').src = text;
        } catch (error) {
          //console.error('Error previewing image:', error);
          alert('Error occured. Paste another image address');
        }
      };

      // This functions only allows input fields to accept numbers
      function onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false; 
        return true;
        // use onkeypress="return onlyNumberKey(event)" on the input field
      }

      // Copy texts js
      function copyText(arg) {
        console.log('clicked a button');
        // Get the input or text field
        //var copyText = document.getElementById("myInput");

        // Select the text field
        arg.select();
        arg.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(arg.value).then(()=>{
          // Alert the copied text
          alert("Copied");
        }).catch(()=>{
          // Alert the copied text
          alert("Something went wrong");
        });
      }
    </script>
</body>

<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>