<?php
include ("assets/php/config.php");
session_start();

$id = $_GET['id'];
$sql = "SELECT * FROM tbl_users WHERE User_ID='$id'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user = $row['Username'];
    $dc = $row['Date_Created'];
    $name = $row['Name'];
    $sname = $row['Surname'];
    $add = $row['Address'];
    $contact = $row['Contact'];
    $data1 = '';
    $data2 = '';
    $sql = "SELECT  DATE_FORMAT(`Sales_Date`,'%m-%d-%y') AS `Current`, SUM(`Sales_Quantity`) AS `Total` FROM `tbl_saleseggs`  WHERE `Sales_Date` BETWEEN CURDATE()-7 AND CURDATE() AND `Sales_User`='$user' GROUP BY `Current`";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result)) {

        $data1 = $data1 . '"' . $row['Current'] . '",';
        $data2 = $data2 . '"' . $row['Total'] . '",';
    }
    $data1 = trim($data1, ",");
    $data2 = trim($data2, ",");
} else {
    header("Location: " . $path . "admin/admin_users.php");
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
        Poultry System
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
</head>

<body class="g-sidenav-show  bg-gray-100" onload="loadAll();">
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="admin_dashboard.php" target="_blank">
                <span class="ms-1 font-weight-bold text-white">
                    ADMIN
                </span>
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
                    <a class="nav-link text-white " href="admin_users.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
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
                        <li class="breadcrumb-item text-sm text-dark" aria-current="page">Dashboard</li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                            <?php echo $user ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </nav>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-6 position-relative z-index-2">
                    <a class="btn btn-secondary" href="admin_users.php"> <i class="fa-solid fa-backward"></i> GO
                        BACK</a>
                    <div class="row" style="margin-top:2%">
                        <div class="col-12">
                            <div class="card mb-4 ">
                                <div class="d-flex flex-row">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-xl mt-n3 ms-4">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <h6 class="mt-3 mb-2 ms-3 ">USER PROFILE :
                                        <?php echo $user ?>
                                    </h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-7">
                                            <table class="table">
                                                <tr>
                                                    <td>Full Name :
                                                        <?php echo $name ?>
                                                        <?php echo $sname ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Address :
                                                        <?php echo $add ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Contact No :
                                                        <?php echo $contact ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>User Type : Egg Seller

                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row" style="margin-top:2%">
                        <div class="col-lg-6 col-sm-3">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="fa-solid fa-egg"></i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Total Egg Sold</p>
                                        <?php
                                        $sql4 = "SELECT SUM(`Sales_Quantity`) AS total_qty FROM `tbl_saleseggs` WHERE `Sales_User` = '$user'";
                                        $result4 = $db->query($sql4);
                                        $row4 = $result4->fetch_assoc();
                                        ?>
                                        <h4 class="mb-0" id="totalEggSold">
                                            <?php echo $row4['total_qty']; ?>
                                        </h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-3">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="fa-solid fa-coins"></i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Total Sales</p>
                                        <?php
                                        $sql6 = "SELECT SUM(`Sales_Total`) AS total_sales FROM `tbl_saleseggs` WHERE `Sales_User` = '$user'";
                                        $result6 = $db->query($sql6);
                                        $row6 = $result6->fetch_assoc();
                                        ?>
                                        <h4 class="mb-0" id="totalSalesCounter">
                                            <?php echo $row6['total_sales']; ?>
                                        </h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4 ">
                                <div class="d-flex">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-xl mt-n3 ms-4">
                                        <i class="fa-solid fa-chart-line"></i>
                                    </div>
                                    <h6 class="mt-3 mb-2 ms-3 ">Sales Chart For The Past 7 Days</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-7">
                                            <canvas id="mychart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="globe" class="position-absolute end-0 top-10 mt-sm-3 mt-7 me-lg-7">
                    <canvas width="700" height="600"
                        class="w-lg-100 h-lg-100 w-75 h-75 me-lg-0 me-n10 mt-lg-5"></canvas>
                </div>
            </div>
        </div>
    </main>

    <!--=====THIS MODAL IS FOR ADDING SALES=====-->
    <div class="modal fade" id="addSales" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Sales</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <h6>Date</h6>
                        <input type="date" class="form-control addSalesDate" id="sdate">
                    </div>
                    <div class="form-group">
                        <h6>Quantity of Eggs</h6>
                        <input type="number" class="form-control" id="sqty">
                    </div>
                    <div class="form-group">
                        <h6>Total Sales</h6>
                        <input type="number" class="form-control" id="stotal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="saveSales" class="btn btn-primary">ADD</button>
                </div>
            </div>
        </div>
    </div>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="assets/js/material-dashboard.min.js?v=3.1.0"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        function loadAll() {
            loadChart();
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
        function loadChart() {
            var ctx = document.getElementById("mychart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    color: "pink",
                    labels: [<?php echo $data1; ?>],
                    datasets: [
                        {
                            label: 'Egg Sold',
                            data: [<?php echo $data2; ?>,],
                            backgroundColor: 'transparent',
                            borderColor: 'Pink',
                            borderWidth: 3,
                            tension: 0.1,

                        },
                    ]
                },
                animation: {
                    animateScale: true
                },
                options: {
                    responsive: true,
                    legend: {
                        display: false,
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function (value) {
                                    if (Number.isInteger(value)) {
                                        return value;
                                    }
                                },
                            }
                        }],
                    }
                }
            });
        }
    </script>
</body>

</html>