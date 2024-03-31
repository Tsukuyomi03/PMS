<?php
include ("assets/php/config.php");
session_start();
if (isset($_SESSION["Admin"])){

}
else{
    header("Location: ../index_admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <title>
        ADMIN
    </title>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
</head>
<style>
    table.dataTable td.dt-type-numeric {
        text-align: left;
    }
</style>

<body class="g-sidenav-show  bg-gray-100" onload="loadAll();">
    <div>
        <?php if (isset($_SESSION["status"]) && $_SESSION['status'] == 'success'): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: '<?php echo $_SESSION['message'] ?>',
                })
            </script>
        <?php elseif (isset($_SESSION["status"]) && $_SESSION['status'] == 'error'): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    text: '<?php echo $_SESSION['message'] ?>',
                })
            </script>
        <?php endif; ?>
        <?php unset($_SESSION['message']); ?>
        <?php unset($_SESSION['status']); ?>
    </div>
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="admin_dashboard.php" target="_blank">
                <span class="ms-1 font-weight-bold text-white">ADMIN</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white " href="admin_dashboard.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-table-columns"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white active" href="admin_users.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <span class="nav-link-text ms-1">Poultries</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="admin_customers.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <span class="nav-link-text ms-1">Customers</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0 ">
            <div class="mx-3">
                <a class="btn btn-danger w-100" href="#" onclick="logout();">
                    <i class="fa-solid fa-sign-out"></i>&nbsp;Sign Out</a>
            </div>
        </div>
    </aside>
    <main class="main-content border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Poultries</li>
                    </ol>
                </nav>
            </div>
        </nav>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12 position-relative z-index-2">
                    <div class="card card-plain mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex flex-column h-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-3">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-secondary shadow-light shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">PENDING USERS</p>
                                        <h4 class="mb-0" id="totalUsers">0</h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-secondary shadow-light shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Active Poultry Breeding Chickens</p>
                                        <h4 class="mb-0" id="totalChicken">0</h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-secondary shadow-light shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Active Poultry Selling Eggs</p>
                                        <h4 class="mb-0" id="totalEgg">0</h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-secondary shadow-light shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Active Poultry Selling and Breeding</p>
                                        <h4 class="mb-0" id="totalBoth">0</h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-8">
                            <div class="card mb-4 ">
                                <div class="d-flex">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-xl mt-n3 ms-4">
                                        <i class="fa-solid fa-table"></i>
                                    </div>
                                    <h6 class="mt-3 mb-2 ms-3 ">Needs Approval</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover" style="table-layout:fixed; width:100%"
                                        id="tblPendingUsers">
                                        <thead>
                                            <tr>
                                                <td style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                                    ID</td>
                                                <td style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                                    Name</td>
                                                <td style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                                    Surname</td>
                                                <td style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                                    Address</td>
                                                <td style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                                    Contact</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM tbl_users WHERE Status='Pending'";
                                            $result = $db->query($sql);
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $row['User_ID']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['Name']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['Surname']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['Address']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['Contact']; ?>
                                                    </td>
                                                    <td><button class="btn btn-primary btn-sm"
                                                            onclick="approve(<?= $row['User_ID']; ?>);">Approve</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card mb-4 ">
                                <div class="d-flex">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-xl mt-n3 ms-4">
                                        <i class="fa-solid fa-table"></i>
                                    </div>
                                    <h6 class="mt-3 mb-2 ms-3 ">List Active Users</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover" style="table-layout:fixed; width:100%"
                                        id="tblApprovedUsers">
                                        <thead>
                                            <tr>
                                                <td>ID</td>
                                                <td>Name</td>
                                                <td>Surname</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM tbl_users WHERE Status='Approved'";
                                            $result = $db->query($sql);
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $row['User_ID']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['Name']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['Surname']; ?>
                                                    </td>
                                                    <td>
                                                        <a href="assets/php/redirect_page.php?id=<?= $row['User_ID']; ?>"
                                                            class="btn btn-success btn-sm">View</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="globe" class="position-absolute end-0 top-10 mt-sm-3 mt-7 me-lg-7">
                        <canvas width="700" height="600"
                            class="w-lg-100 h-lg-100 w-75 h-75 me-lg-0 me-n10 mt-lg-5"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="assets/vendors/simplebar/js/simplebar.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script>
        let table = new DataTable('#tblPendingUsers');
        let table2 = new DataTable('#tblApprovedUsers');
        function approve($___id) {
            Swal.fire({
                title: 'CONFIRMATION',
                text: "Approve this user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'assets/php/ajax_approve_users.php?oid=' + $___id;
                }
            })
        }
        function logout() {
            Swal.fire({
                title: 'CONFIRMATION',
                text: "Are you sure you want to logout?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'assets/php/session_logout.php';
                }
            })
        }
        function loadAll() {
            loadPendingUsers();
            loadBothUsers();
            loadEggsUsers();
            loadchickenUsers();
        }
        function loadPendingUsers() {
            $.ajax({
                url: 'assets/php/load_total_users2.php',
                success: function (data) {
                    document.getElementById("totalUsers").textContent = data;
                }
            })
        }
        function loadEggsUsers() {
            $.ajax({
                url: 'assets/php/load_users_egg.php',
                success: function (data) {
                    document.getElementById("totalEgg").textContent = data;
                }
            })
        }
        function loadchickenUsers() {
            $.ajax({
                url: 'assets/php/load_users_chicken.php',
                success: function (data) {
                    document.getElementById("totalChicken").textContent = data;
                }
            })
        }
        function loadBothUsers() {
            $.ajax({
                url: 'assets/php/load_users_both.php',
                success: function (data) {
                    document.getElementById("totalBoth").textContent = data;
                }
            })
        }
    </script>
</body>

</html>