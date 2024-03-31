<?php
include ("assets/php/config.php");
session_start();
if (!isset($_SESSION['Username'])) {
    header("Location: ../index.php");
    exit();

} else {
    $user = $_SESSION['Username'];
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
                    <?php echo $_SESSION['Username'] ?>
                </span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="poultry_dashboard.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-table-columns"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white" href="poultry_sales.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-coins"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sales</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white active" href="poultry_inventory.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-egg"></i>
                        </div>
                        <span class="nav-link-text ms-1">Inventory</span>
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
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">
                                <?php echo $_SESSION['Username'] ?>
                            </a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Inventory</li>
                    </ol>
                </nav>
            </div>
        </nav>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-primary" style="float:right;margin-top:2%; margin-left: 2%;"
                        data-bs-toggle="modal" data-bs-target="#addProducts">Add Products</button>
                        <button class="btn btn-primary" style="float:right;margin-top:2%; margin-left: 2%;" onclick="autoRefresh();" 
                        >Refresh</button>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4 ">
                                <div class="d-flex flex-row">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-xl mt-n3 ms-4">
                                        <i class="fa-solid fa-box"></i>
                                    </div>
                                    <h6 class="mt-3 mb-2 ms-3 ">List of Products</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive" id="">
                                                <table class="table table-bordered" id="tblProducts" style="width:100%">

                                                </table>
                                            </div>
                                        </div>
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
    <div class="modal fade" id="addProducts" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <h6>Product Type</h6>
                        <select id="ptype" class="form-control">
                            <option value="Chicken">Chicken</option>
                        </select>   
                    </div>
                    <div class="form-group">
                        <h6>Description</h6>
                        <input type="text" class="form-control" id="pdes">
                    </div>
                    <div class="form-group">
                        <h6>Price</h6>
                        <input type="number" class="form-control" id="pprice">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="saveProduct" class="btn btn-primary">ADD</button>
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
        let table = new DataTable('#tblSales');
        function loadAll() {

            loadProductTable();
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

        function loadProductTable() {
            $.ajax({
                url: "assets/php/load_product_table.php",
                type: "GET",
                cache: false,
                success: function (data) {
                    $('#tblProducts').html(data);
                    var table = $('#tblProducts').DataTable({
                        'columnDefs': [

                            { 'visible': false, 'targets': [0] }
                        ]
                    });
                }
            });
        }
        $('#saveProduct').on('click', function () {
            var ptype = $('#ptype').val();
            var pdes = $('#pdes').val();
            var pprice = $('#pprice').val();

            if (ptype != "" && pdes != "" && pprice != "") {
                if (pprice >= 1) {
                    $.ajax({
                        url: "assets/php/add_product.php",
                        type: "POST",
                        data: {
                            ptype: ptype,
                            pdes: pdes,
                            pprice: pprice,
                        },
                        cache: false,
                        success: function (dataResult) {
                            $('#addSales').modal('toggle')
                            $('#sdate').val('');
                            $('#sqty').val('');
                            $('#stotal').val('');
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Sales Updated Successfully',
                                })
                                
                            }
                            else if (dataResult.statusCode == 201) {
                                Swal.fire({
                                    icon: 'error',
                                    text: 'Something went Wrong, Please try again later',
                                })
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: 'You cant sell if its free,Input valid price',
                    })
                }
            }
            else {
                Swal.fire({
                    icon: 'error',
                    text: 'Please fill all fields',
                })
            }
        });
        function autoRefresh() {
        window.location.reload();
    }
    </script>
</body>

</html>