<?php
include ("assets/php/config.php");
session_start();
if (!isset($_SESSION['User'])) {
    header("Location: ../customer_login.php");
    exit();

} else {
    $customer = $_SESSION['User'];
    if (!isset($_GET['id'])) {
        header("Location: customer_poultry.php");
        exit();
    } else {
        $user = $_GET['id'];
        $sql = "SELECT * FROM tbl_users WHERE User_ID = '$user'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $seller = $row['Username'];
        } else {
            header("Location: customer_poultry.php");
            exit();
        }
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

<body class="g-sidenav-show  bg-gray-100">
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
                <span class="ms-1 font-weight-bold text-white">
                    <?php echo $_SESSION['User'] ?>
                </span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="customer_dashboard.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-table-columns"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white active" href="customer_poultry.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-egg"></i>
                        </div>
                        <span class="nav-link-text ms-1">Poultries</span>
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
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;"
                                style="text-decoration:none;">
                                <?php echo $_SESSION['User'] ?>
                            </a>
                        </li>
                        <li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-dark"
                                href="javascript:;" style="text-decoration:none;">Poultries</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                            <?php echo $row['Name'] ?>
                            <?php echo $row['Surname'] ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </nav>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-4 position-relative z-index-2">
                    <a class="btn btn-secondary" href="customer_poultry.php"> <i class="fa-solid fa-backward"></i> GO
                        BACK</a>
                    <div class="row" style="margin-top:2%">
                        <div class="col-12">
                            <div class="card mb-4 ">
                                <div class="d-flex flex-row">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-xl mt-n3 ms-4">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <h6 class="mt-3 mb-2 ms-3 ">POULTRY PROFILE :
                                    </h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-7">
                                            <table class="table">
                                                <tr>
                                                    <td>Full Name :
                                                        <?php echo $row['Name'] ?>
                                                        <?php echo $row['Surname'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Address :
                                                        <?php echo $row['Address'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Contact No :
                                                        <?php echo $row['Contact'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>User Type :
                                                        <?php if ($row['Type'] == 1): ?>
                                                            <span class="card-text">Chicken Seller</span>
                                                        <?php elseif ($row['Type'] == 2): ?>
                                                            <span class="card-text">Egg Seller</span>
                                                        <?php else: ?>
                                                            <span class="card-text">Chicken + Egg Seller </span>
                                                        <?php endif; ?>

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
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4 ">
                                <div class="d-flex flex-row">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-secondary shadow text-center border-radius-xl mt-n3 ms-4">
                                        <i class="fa-solid fa-egg"></i>
                                    </div>
                                    <h6 class="mt-3 mb-2 ms-3 ">PRODUCTS
                                    </h6>
                                </div>
                                <div class="card-body p-3">
                                    <table class="table table-bordered" id="tblProducts">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>TYPE</th>
                                                <th>DESCRIPTION</th>
                                                <th>PRICE</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM tbl_products WHERE P_Seller='$seller'";
                                            $result = $db->query($sql);
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['P_ID'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['P_Type'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['P_Description'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['P_Price'] ?>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#Orders" data-pid="<?php echo $row['P_ID'] ?>"
                                                            data-customer="<?php echo $customer ?>"
                                                            data-seller="<?php echo $seller ?>"
                                                            data-type="<?php echo $row['P_Type'] ?>"
                                                            data-price="<?php echo $row['P_Price'] ?>">ORDER</button>
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
            </div>
            <div class="row">
                <div class="col-lg-6 position-relative z-index-2">

                </div>
                <div class="col-lg-6">

                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="Orders" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Order <span id="oprod"></span> from <span
                            id="oseller"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="oid">
                    <input type="hidden" class="form-control" id="ocustomer">
                    <input type="hidden" class="form-control" id="oseller2">
                    <input type="hidden" class="form-control" id="oprice">
                    <table class="table">

                        <tr>
                            <td>Enter Quantity</td>
                            <td>:</td>
                            <td><input type="number" class="form-control" id="oqty"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="orderProduct();">Understood</button>
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
        let table = new DataTable('#tblProducts');

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
        $('#Orders').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var type = button.data('type')
            var seller = button.data('seller');
            var customer = button.data('customer')
            var pid = button.data('pid')
            var price = button.data('price')

            var modal = $(this)

            document.getElementById("oprod").innerHTML = type;
            document.getElementById("oseller").innerHTML = seller;
            document.getElementById('ocustomer').value = customer;
            document.getElementById('oid').value = pid;
            document.getElementById('oseller2').value = seller;
            document.getElementById('oprice').value = price;
        })
        function orderProduct() {
            var qty = $('#oqty').val();
            if (qty > 0) {
                $.ajax({
                    type: "POST",
                    url: "assets/php/add_order.php",
                    data: {
                        oid: $("#oid").val(),
                        ocustomer: $("#ocustomer").val(),
                        oseller2: $("#oseller2").val(),
                        oqty: $("#oqty").val(),
                        oprod: $("#oprod").val(),
                        oprice: $("#oprice").val(),
                    },
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {
                            Swal.fire({
                                icon: 'success',
                                text: 'Ordered Successfully',
                            })
                            $('#Orders').modal('toggle');
                        }
                        else if (dataResult.statusCode == 201) {
                            Swal.fire({
                                icon: 'error',
                                text: 'Failed',
                            })
                        }
                    }
                });
            }
            else {
                Swal.fire({
                    icon: 'error',
                    text: 'Enter valid number',
                })
            }

        }
    </script>
</body>

</html>