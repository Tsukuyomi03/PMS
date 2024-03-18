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
</head>

<body class="g-sidenav-show  bg-gray-100" onload="loadAll();">
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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
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
                                        <h2 class="font-weight-bolder mb-0">General Statistics</h2>
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
                                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">USERS</p>
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
                                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="material-icons opacity-10">leaderboard</i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                                        <h4 class="mb-0">2,300</h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="card-footer p-3">
                                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3%
                                        </span>than last month</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="material-icons opacity-10">weekend</i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Bookings</p>
                                        <h4 class="mb-0">281</h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="card-footer p-3">
                                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55%
                                        </span>than last week</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="card  mb-2">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="material-icons opacity-10">leaderboard</i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                                        <h4 class="mb-0">2,300</h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="card-footer p-3">
                                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3%
                                        </span>than last month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-10">
                            <div class="card mb-4 ">
                                <div class="d-flex">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-xl mt-n3 ms-4">
                                        <i class="material-icons opacity-10" aria-hidden="true">language</i>
                                    </div>
                                    <h6 class="mt-3 mb-2 ms-3 ">Sales by Country</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-7">
                                            <div class="table-responsive">
                                                <table class="table align-items-center ">
                                                    <tbody>
                                                        <tr>
                                                            <td class="w-30">
                                                                <div class="d-flex px-2 py-1 align-items-center">
                                                                    <div>
                                                                        <img src="./assets/img/icons/flags/US.png"
                                                                            alt="Country flag">
                                                                    </div>
                                                                    <div class="ms-4">
                                                                        <p class="text-xs font-weight-bold mb-0 ">
                                                                            Country:</p>
                                                                        <h6 class="text-sm font-weight-normal mb-0 ">
                                                                            United States</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="text-center">
                                                                    <p class="text-xs font-weight-bold mb-0 ">Sales:</p>
                                                                    <h6 class="text-sm font-weight-normal mb-0 ">2500
                                                                    </h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="text-center">
                                                                    <p class="text-xs font-weight-bold mb-0 ">Value:</p>
                                                                    <h6 class="text-sm font-weight-normal mb-0 ">
                                                                        $230,900</h6>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle text-sm">
                                                                <div class="col text-center">
                                                                    <p class="text-xs font-weight-bold mb-0 ">Bounce:
                                                                    </p>
                                                                    <h6 class="text-sm font-weight-normal mb-0 ">29.9%
                                                                    </h6>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="w-30">
                                                                <div class="d-flex px-2 py-1 align-items-center">
                                                                    <div>
                                                                        <img src="./assets/img/icons/flags/DE.png"
                                                                            alt="Country flag">
                                                                    </div>
                                                                    <div class="ms-4">
                                                                        <p class="text-xs font-weight-bold mb-0 ">
                                                                            Country:</p>
                                                                        <h6 class="text-sm font-weight-normal mb-0 ">
                                                                            Germany</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="text-center">
                                                                    <p class="text-xs font-weight-bold mb-0 ">Sales:</p>
                                                                    <h6 class="text-sm font-weight-normal mb-0 ">3.900
                                                                    </h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="text-center">
                                                                    <p class="text-xs font-weight-bold mb-0 ">Value:</p>
                                                                    <h6 class="text-sm font-weight-normal mb-0 ">
                                                                        $440,000</h6>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle text-sm">
                                                                <div class="col text-center">
                                                                    <p class="text-xs font-weight-bold mb-0 ">Bounce:
                                                                    </p>
                                                                    <h6 class="text-sm font-weight-normal mb-0 ">40.22%
                                                                    </h6>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="w-30">
                                                                <div class="d-flex px-2 py-1 align-items-center">
                                                                    <div>
                                                                        <img src="./assets/img/icons/flags/GB.png"
                                                                            alt="Country flag">
                                                                    </div>
                                                                    <div class="ms-4">
                                                                        <p class="text-xs font-weight-bold mb-0 ">
                                                                            Country:</p>
                                                                        <h6 class="text-sm font-weight-normal mb-0 ">
                                                                            Great Britain</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="text-center">
                                                                    <p class="text-xs font-weight-bold mb-0 ">Sales:</p>
                                                                    <h6 class="text-sm font-weight-normal mb-0 ">1.400
                                                                    </h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="text-center">
                                                                    <p class="text-xs font-weight-bold mb-0 ">Value:</p>
                                                                    <h6 class="text-sm font-weight-normal mb-0 ">
                                                                        $190,700</h6>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle text-sm">
                                                                <div class="col text-center">
                                                                    <p class="text-xs font-weight-bold mb-0 ">Bounce:
                                                                    </p>
                                                                    <h6 class="text-sm font-weight-normal mb-0 ">23.44%
                                                                    </h6>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="w-30">
                                                                <div class="d-flex px-2 py-1 align-items-center">
                                                                    <div>
                                                                        <img src="./assets/img/icons/flags/BR.png"
                                                                            alt="Country flag">
                                                                    </div>
                                                                    <div class="ms-4">
                                                                        <p class="text-xs font-weight-bold mb-0 ">
                                                                            Country:</p>
                                                                        <h6 class="text-sm font-weight-normal mb-0 ">
                                                                            Brasil</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="text-center">
                                                                    <p class="text-xs font-weight-bold mb-0 ">Sales:</p>
                                                                    <h6 class="text-sm font-weight-normal mb-0 ">562
                                                                    </h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="text-center">
                                                                    <p class="text-xs font-weight-bold mb-0 ">Value:</p>
                                                                    <h6 class="text-sm font-weight-normal mb-0 ">
                                                                        $143,960</h6>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle text-sm">
                                                                <div class="col text-center">
                                                                    <p class="text-xs font-weight-bold mb-0 ">Bounce:
                                                                    </p>
                                                                    <h6 class="text-sm font-weight-normal mb-0 ">32.14%
                                                                    </h6>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-5">
                                            <div id="map" class="mt-0 mt-lg-n4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-5 mb-lg-0 mb-4">
                    <div class="card z-index-2 mt-4">
                        <div class="card-body mt-n5 px-3">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1 mb-3">
                                <div class="chart">
                                    <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                                </div>
                            </div>
                            <h6 class="ms-2 mt-4 mb-0"> Active Users </h6>
                            <p class="text-sm ms-2"> (<span class="font-weight-bolder">+11%</span>) than last week </p>
                            <div class="container border-radius-lg">
                                <div class="row">
                                    <div class="col-3 py-3 ps-0">
                                        <div class="d-flex mb-2">
                                            <div
                                                class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-primary text-center me-2 d-flex align-items-center justify-content-center">
                                                <i class="material-icons opacity-10">groups</i>
                                            </div>
                                            <p class="text-xs my-auto font-weight-bold">Users</p>
                                        </div>
                                        <h4 class="font-weight-bolder">42K</h4>
                                        <div class="progress w-75">
                                            <div class="progress-bar bg-dark w-60" role="progressbar" aria-valuenow="60"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 py-3 ps-0">
                                        <div class="d-flex mb-2">
                                            <div
                                                class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                                                <i class="material-icons opacity-10">ads_click</i>
                                            </div>
                                            <p class="text-xs mt-1 mb-0 font-weight-bold">Clicks</p>
                                        </div>
                                        <h4 class="font-weight-bolder">1.7m</h4>
                                        <div class="progress w-75">
                                            <div class="progress-bar bg-dark w-90" role="progressbar" aria-valuenow="90"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 py-3 ps-0">
                                        <div class="d-flex mb-2">
                                            <div
                                                class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-warning text-center me-2 d-flex align-items-center justify-content-center">
                                                <i class="material-icons opacity-10">receipt</i>
                                            </div>
                                            <p class="text-xs mt-1 mb-0 font-weight-bold">Sales</p>
                                        </div>
                                        <h4 class="font-weight-bolder">399$</h4>
                                        <div class="progress w-75">
                                            <div class="progress-bar bg-dark w-30" role="progressbar" aria-valuenow="30"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 py-3 ps-0">
                                        <div class="d-flex mb-2">
                                            <div
                                                class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-danger text-center me-2 d-flex align-items-center justify-content-center">
                                                <i class="material-icons opacity-10">category</i>
                                            </div>
                                            <p class="text-xs mt-1 mb-0 font-weight-bold">Items</p>
                                        </div>
                                        <h4 class="font-weight-bolder">74</h4>
                                        <div class="progress w-75">
                                            <div class="progress-bar bg-dark w-50" role="progressbar" aria-valuenow="50"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card z-index-2">
                        <div class="card-header pb-0">
                            <h6>Sales overview</h6>
                            <p class="text-sm">
                                <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold">4% more</span> in 2021
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
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
            <footer class="footer py-4  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                    Tim</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                        target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                        target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                        target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                        target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="./assets/js/material-dashboard.min.js?v=3.1.0"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script>
        function loadAll() {
            loadUsers();
        }
        function loadUsers() {
            $.ajax({
                url: 'assets/php/load_total_users.php',
                success: function (data) {
                    document.getElementById("totalUsers").textContent = data;
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
    </script>
</body>

</html>