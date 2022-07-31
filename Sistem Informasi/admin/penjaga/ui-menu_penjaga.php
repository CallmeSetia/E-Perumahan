<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="../index-penjaga.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people  "></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
<!--                <li>-->
<!--                    <a href="list-user.php?user_role=tamu">-->
<!--                        <i class="bi bi-circle"></i><span>Tamu</span>-->
<!--                    </a>-->
<!--                </li>-->
                <li>
                    <a href="list-user.php?user_role=warga">
                        <i class="bi bi-circle"></i><span>Warga</span>
                    </a>
                </li>
                <li>
                    <a href="list-user.php?user_role=penjaga">
                        <i class="bi bi-circle"></i><span>Penjaga</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-text  "></i><span>History</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="history-tamu.php">
                        <i class="bi bi-circle"></i><span>Tamu (Bertamu)</span>
                    </a>
                </li>
                <li>
                    <a href="history-warga.php">
                        <i class="bi bi-circle"></i><span>Warga (Keluar-Masuk)</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="list-rumah-warga.php">
                <i class="bi bi-house-door"></i><span>Rumah Warga</span>
            </a>

        </li>
<!--        <li class="nav-item">-->
<!--            <a class="nav-link collapsed" href="#otp-tamu">-->
<!--                <i class="bi bi-shield"></i><span>OTP Tamu</span>-->
<!--            </a>-->
<!---->
<!--        </li> End Tables Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="streaming.php">
                <i class="bi bi-tv"></i>
                <span>Streaming</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="../logout.php">
                <i class="bi bi-power"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Login Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
