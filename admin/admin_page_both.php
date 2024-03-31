<?php
include ("assets/php/config.php");
session_start();
if (!isset($_SESSION["Admin"])){
    header("Location: ../index_admin.php");
    exit();
}
else{
    $id = $_GET['id'];
    $sql3 = "SELECT * FROM tbl_users WHERE User_ID='$id'";
    $result3 = $db->query($sql3);
    if ($result3->num_rows > 0) {
        $row3 = $result3->fetch_assoc();
        $user = $row3['Username'];
        $dc = $row3['Date_Created'];
        $name = $row3['Name'];
        $sname = $row3['Surname'];
        $add = $row3['Address'];
        $contact = $row3['Contact'];
        
    
        $data1 = '';
        $data2 = '';
        $sql = "SELECT  DATE_FORMAT(`O_Date`,'%m-%d-%y') AS `Current`, SUM(`O_QTY`) AS `Total` FROM `tbl_orders` LEFT JOIN tbl_products ON tbl_orders.O_ProductID = tbl_products.P_ID WHERE `O_Date` BETWEEN CURDATE()-7 AND CURDATE() AND `O_Seller`='$user' AND O_Status='Completed' GROUP BY `Current`";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_array($result)) {
    
            $data1 = $data1 . '"' . $row['Current'] . '",';
            $data2 = $data2 . '"' . $row['Total'] . '",';
        }
        $data1 = trim($data1, ",");
        $data2 = trim($data2, ",");
    
    
        $data3 = '';
        $data4 = '';
        $sql2 = "SELECT  DATE_FORMAT(`O_Date`,'%m-%d-%y') AS `Current`, SUM(`O_Total`) AS `Total` FROM `tbl_orders` LEFT JOIN tbl_products ON tbl_orders.O_ProductID = tbl_products.P_ID WHERE `O_Date` BETWEEN CURDATE()-7 AND CURDATE() AND `O_Seller`='$user' AND O_Status='Completed' GROUP BY `Current`";
        $result2 = mysqli_query($db, $sql2);
        while ($row2 = mysqli_fetch_array($result2)) {
    
            $data3 = $data3 . '"' . $row2['Current'] . '",';
            $data4 = $data4 . '"' . $row2['Total'] . '",';
        }
        $data3 = trim($data3, ",");
        $data4 = trim($data4, ",");
    
    
    } else {
        header("Location: " . $path . "admin/admin_users.php");
    }
   
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
                    <a class="nav-link text-white active" href="admin_users.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <span class="nav-link-text ms-1">Poultries</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="admin_customers.php">
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
                                                    <td>User Type : Chicken Seller

                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                    <div class="col-lg-6 col-sm-3" style="margin-top:2%">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="fa-solid fa-drumstick-bite"></i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Total Chicken Sold</p>
                                        <?php
                                        $sql4 = "SELECT SUM(O_QTY) AS totalEggs FROM `tbl_orders` LEFT JOIN tbl_products ON tbl_orders.O_ProductID = tbl_products.P_ID WHERE O_Seller='$user' AND O_Status='Completed' AND P_Type='Chicken'";
                                        $result4 = $db->query($sql4);
                                        $row4 = $result4->fetch_assoc();
                                        ?>
                                        <h4 class="mb-0" id="totalEggSold">
                                            <?php if($row4['totalEggs'] == ''): ?>
                                                0
                                            <?php else:?>
                                                <?php echo $row4['totalEggs']; ?>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-3" style="margin-top:2%">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="fa-solid fa-egg"></i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Total Egg Sold</p>
                                        <?php
                                        $sql4 = "SELECT SUM(O_QTY) AS totalEggs FROM `tbl_orders` LEFT JOIN tbl_products ON tbl_orders.O_ProductID = tbl_products.P_ID WHERE O_Seller='$user' AND O_Status='Completed' AND P_Type='Egg'";
                                        $result4 = $db->query($sql4);
                                        $row4 = $result4->fetch_assoc();
                                        ?>
                                        <h4 class="mb-0" id="totalEggSold">
                                            <?php if($row4['totalEggs'] == ''): ?>
                                                0
                                            <?php else:?>
                                                <?php echo $row4['totalEggs']; ?>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-3 " style="margin-top:2%">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="fa-solid fa-coins"></i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Total Sales</p>
                                        <?php
                                        $sql6 = "SELECT SUM(O_Total) AS totalSales FROM `tbl_orders` LEFT JOIN tbl_products ON tbl_orders.O_ProductID = tbl_products.P_ID WHERE O_Seller='$user' AND O_Status='Completed'";
                                        $result6 = $db->query($sql6);
                                        $row6 = $result6->fetch_assoc();
                                        ?>
                                        <h4 class="mb-0" id="totalSalesCounter">
                                        <?php if($row6['totalSales'] == ''): ?>
                                                0
                                            <?php else:?>
                                                <?php echo $row6['totalSales']; ?>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-3" style="margin-top:2%">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="fa-solid fa-box"></i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Total Products</p>
                                        <?php
                                        $sql7 = "SELECT COUNT(P_ID) AS totalProducts FROM `tbl_products` WHERE P_Seller='$user'";
                                        $result7 = $db->query($sql7);
                                        $row7 = $result7->fetch_assoc();
                                        ?>
                                        <h4 class="mb-0" id="totalSalesCounter">
                                        <?php if($row7['totalProducts'] == ''): ?>
                                                0
                                            <?php else:?>
                                                <?php echo $row7['totalProducts']; ?>
                                            <?php endif; ?>
                                        </h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
        </div>
        <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4 ">
                                <div class="d-flex">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-xl mt-n3 ms-4">
                                        <i class="fa-solid fa-chart-line"></i>
                                    </div>
                                    <h6 class="mt-3 mb-2 ms-3 ">Weekly Inventory Chart</h6>
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
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4 ">
                                <div class="d-flex">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-xl mt-n3 ms-4">
                                        <i class="fa-solid fa-chart-line"></i>
                                    </div>
                                    <h6 class="mt-3 mb-2 ms-3 ">Weekly Sales Chart</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-7">
                                            <canvas id="mychart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            loadChart2();
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
        function loadChart2() {
            var ctx = document.getElementById("mychart2").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    color: "pink",
                    labels: [<?php echo $data3; ?>],
                    datasets: [
                        {
                            label: 'Sales',
                            data: [<?php echo $data4; ?>,],
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