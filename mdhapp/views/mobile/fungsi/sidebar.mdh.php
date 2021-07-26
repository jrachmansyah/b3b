<div class="nav-container">
    <ul class="main-menu">
        <li <?= $page == "Employee Dashboard" ? 'class="active"' : null; ?>>
            <a href="<?= base_url('mobile/dashboard'); ?>">
                <i class="fa fa-home" style="color: #2147e7;"></i> Home
            </a>
        </li>
        <li <?= $page == "Attendance" ? 'class="active"' : null; ?>>
            <a href="<?= base_url('attendance'); ?>">
                <i class="fa fa-calendar" style="color: #2147e7;"></i> Absensi
            </a>
        </li>
        <li <?= $page == "Leave" ? 'class="active"' : null; ?>>
            <a href="<?= base_url('leave/list'); ?>">
                <i class="fa fa-plane" style="color: #2147e7;"></i> Cuti
            </a>
        </li>
        <!-- <li <?= $page == "Raimbes" ? 'class="active"' : null; ?>>
            <a href="<?= base_url('raimbes/list'); ?>">
                <i class="fa fa-money" style="color: #2147e7;"></i> Raimbes
            </a>
        </li>
        <li <?= $page == "Award List" ? 'class="active"' : null; ?>>
            <a href="<?= base_url('award/list'); ?>">
                <i class="fa fa-gift" style="color: #2147e7;"></i> Award
            </a>
        </li>
        <li <?= $page == "Notification" ? 'class="active"' : null; ?>>
            <a href="<?= base_url('notif/list'); ?>">
                <i class="fa fa-bell" style="color: #2147e7;"></i> Notification
            </a>
        </li> -->
        <!-- <li <?= $page == "My Log" ? 'class="active"' : null; ?>>
            <a href="<?= base_url('log'); ?>">
                <i class="fa fa-history" style="color: #2147e7;"></i> Log Activity
            </a>
        </li> -->
        <li <?= $page == "Overtime List" ? 'class="active"' : null; ?>>
            <a href="<?= base_url('overtime/list'); ?>">
                <i class="fa fa-calendar-plus-o" style="color: #2147e7;"></i> Lembur
            </a>
        </li>
        <li <?= $page == "Salary List" ? 'class="active"' : null; ?>>
            <a href="<?= base_url('salary/list'); ?>">
                <i class="fa fa-usd" style="color: #2147e7;"></i> Gaji
            </a>
        </li>
        <!-- <li <?= $page == "News List" ? 'class="active"' : null; ?>>
            <a href="<?= base_url('news/list'); ?>">
                <i class="fa fa-newspaper-o" style="color: #2147e7;"></i> News
            </a>
        </li>
        <li <?= $page == "Notice List" ? 'class="active"' : null; ?>>
            <a href="<?= base_url('notice/list'); ?>">
                <i class="fa fa-volume-up" style="color: #2147e7;"></i> Notice Board
            </a>
        </li> -->
        <li <?= $page == "Today Tracker" ? 'class="active"' : null; ?>>
            <a href="<?= base_url('map/today'); ?>">
                <i class="fa fa-map-marker" style="color: #2147e7;"></i> Map Tracker
            </a>
        </li>
        <li <?= $page == "Today Tracker" ? 'class="active"' : null; ?>>
            <a href="<?= base_url('mobile/logout'); ?>">
                <i class="fa fa-sign-out" style="color: #2147e7;"></i> Logout
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-pie-chart" style="color: #2147e7;"></i> Laporan
                <span class="fa fa-angle-down"></span>
            </a>
            <ul>
                <li>
                    <a href="<?= base_url('reports/attendance'); ?>" data-loader="show">Absensi</a>
                </li>
                <li>
                    <a href="<?= base_url('reports/leave'); ?>" data-loader="show">Cuti</a>
                </li>
                <!-- <li>
                    <a href="<?= base_url('reports/task'); ?>" data-loader="show">Task</a>
                </li> -->
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-area-chart" style="color: #2147e7;"></i> More
                <span class="fa fa-angle-down"></span>
            </a>
            <ul>
                <li>
                    <a href="<?= base_url('company'); ?>" data-loader="show">About Company</a>
                </li>
                <li>
                    <a href="<?= base_url('app'); ?>" data-loader="show">About App</a>
                </li>
            </ul>
        </li>
    </ul>
</div>