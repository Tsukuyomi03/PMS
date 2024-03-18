<?php
include("assets/php/config.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>POULTRY SYSTEM</title>
    <!--FONT AWESOME LATEST CDN-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!--GOOGLE FONTS CONVERTER-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!--MDB CSS LATEST CDN-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <section class="vh-100 gradient-custom">
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                    <div class="card-body p-5">

                                        <h2 class="fw-bold mb-2 text-uppercase text-center">Admin Login</h2>
                                        <div class="form-group">
                                            <label class="form-label" for="uname" style="color:white;">Username
                                            </label>
                                            <input type="email" class="form-control" id="uname">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="pword" style="color:white;">Password
                                            </label>
                                            <input type="password" class="form-control" id="pword">
                                        </div>
                                        <br>
                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-light btn-lg btn-block" type="button"
                                                id="login">Login</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!--JQUERY LATEST CDN-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <!--MDB SCRIPT LATEST CDN-->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
    <!--SWEETALERT2 LATEST CDN-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#login').on('click', function () {
            var uname = $('#uname').val();
            var pword = $('#pword').val();
            if (uname != "" && pword != "") {
                $.ajax({
                    url: "assets/php/ajax_login_admin.php",
                    type: "POST",
                    data: {
                        uname: uname,
                        pword: pword,
                    },
                    cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {
                            window.location.href = "admin/admin_dashboard.php"
                        }
                        else if (dataResult.statusCode == 201) {
                            Swal.fire({
                                icon: "error",
                                text: "Invalid Username / Password.",
                            });
                        }
                    }
                });
            }
            else {
                Swal.fire({
                    icon: "error",
                    text: "Error 409 : Please fill all the field !",
                });
            }
        });
    </script>
</body>

</html>