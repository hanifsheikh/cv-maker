<nav class="navbar p-2 p-lg-1 position-fixed navbar-dark navbar-expand-lg bg-dark w-100 z-3">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="<?php echo LOGO; ?>" alt="logo" class="align-center object-fit-contain" style="height:18px; width:22px;">
            CV Maker
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav w-100">
                <li class="nav-item mt-1">
                    <a class="nav-link" aria-current="page" href="<?php echo url('/cv/list'); ?>">
                        <i style="height:22px;" data-feather="align-justify"></i>
                        CV List
                    </a>
                </li>
                <li class="ms-auto nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img style="height:32px; width:32px; object-fit:cover; margin-right:5px;" class="rounded-5" src="<?php echo getPhoto(auth()['photo']); ?>" alt="photo">
                        <?php
                        echo auth()['name'];
                        ?>
                    </a>
                    <ul class="dropdown-menu shadow-lg">
                        <li>
                            <a class="dropdown-item" href="<?php echo url('/user/profile'); ?>">
                                <i style="height:18px;" data-feather="user"></i>
                                Profile
                            </a>
                        </li>
                        <li>
                            <a onclick="document.getElementById('logoutForm').submit()" class="dropdown-item" role="button">
                                <i style="height:16px;" data-feather="log-out"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<form id="logoutForm" action="<?php echo url('/auth/logout'); ?>" class="d-none" method="POST"></form>