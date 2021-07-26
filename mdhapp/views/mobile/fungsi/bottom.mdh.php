<?php if ($page == "Task Detail") { ?>
    <div class="FABMenu">
        <input type="checkbox" checked />
        <div class="hamburger">
            <div class="dots">
                <span class="first"></span>
                <span class="second"></span>
                <span class="third"></span>
            </div>
        </div>
        <div class="action_items_bar">
            <div class="action_items">
                <span class="first_item">
                    <a href="<?= base_url('task/list'); ?>">
                        <i class="fa fa-list" style="color: white;"></i>
                    </a>
                </span>
                <span class="second_item">
                    <a href="#" data-popup="reports">
                        <i class="fa fa-check" style="color: white;"></i>
                    </a>
                </span>
                <span class="third_item">
                    <a href="#" data-popup="formPopup">
                        <i class="fa fa-pencil" style="color: white;"></i>
                    </a>
                </span>
                <span class="fourth_item">
                    <a href="#" data-popup="addprogress">
                        <i class="fa fa-plus" style="color: white;"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="row d-flex col-sm-12 col-lg-0">
        <div class="navbar menu-mobile my-auto mx-auto">
            <div class="row">
                <div class="col">
                    <a class="active" href="<?= base_url('map/today'); ?>"><i class="fa fa-lg fa-map-marker"></i>
                        <p>Maps</p>
                    </a>
                </div>
                <!-- <div class="col">
                    <a class="active" href="<?= base_url('task/list'); ?>"><i class="fa fa-lg fa-list"></i>
                        <p>Task</p>
                    </a>
                </div> -->
                <div class="col gedean">
                    <a href="<?= base_url('mobile/dashboard'); ?>"><i class="fa fa-home"></i>
                        <p>Home</p>
                    </a>
                </div>
                <!-- <div class="col">
                    <a href="<?= base_url('news/list'); ?>"><i class="fa fa-lg fa-newspaper-o"></i>
                        <p>News</p>
                    </a>
                </div> -->
                <div class="col">
                    <a href="<?= base_url('account'); ?>"><i class="fa fa-lg fa-user"></i>
                        <p>Account</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>