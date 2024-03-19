<?php
include ("assets/php/config.php");
session_start();
if (isset ($_SESSION['Username'])) {
    $user = $_SESSION['Username'];
    $sql = "SELECT * FROM tbl_users WHERE Username='$user'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['Type'] == 1) {
            header("Location: poultry_chicken/poultry_dashboard.php");
        } else if ($row['Type'] == 2) {
            header("Location: poultry_egg/poultry_dashboard.php");
        } else {
            header("Location: poultry_both/poultry_dashboard.php");
        }
    }
}
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
        <?php if (isset ($_SESSION["status"]) && $_SESSION['status'] == 'success'): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    text: '<?php echo $_SESSION['message'] ?>',
                })
            </script>
        <?php elseif (isset ($_SESSION["status"]) && $_SESSION['status'] == 'error'): ?>
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
                <section class="vh-100">
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col col-xl-10">
                                <div class="card" style="border-radius: 1rem;">
                                    <div class="row g-0">
                                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                                            <img src="assets/images/index_sidebar.png" alt="login form"
                                                class="img-fluid" style="height:100% ;border-radius: 1rem 0 0 1rem;" />
                                        </div>
                                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                            <div class="card-body p-4 p-lg-5 text-black">
                                                <form>
                                                    <div class="d-flex align-items-center mb-3 pb-1">
                                                        <img src="assets/images/index_label.jpg" style="width:100%">
                                                    </div>
                                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign
                                                        into your account</h5>
                                                    <div class="form-group">
                                                        <label class="form-label" for="uname">Username
                                                        </label>
                                                        <input type="email" class="form-control" id="uname">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="pword">Password
                                                        </label>
                                                        <input type="email" class="form-control" id="pword">
                                                    </div>
                                                    <br>
                                                    <div class="pt-1 mb-4">
                                                        <button class="btn btn-dark btn-lg btn-block" type="button"
                                                            id="login">Login</button>
                                                    </div>
                                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an
                                                        account? <a href="index_register.php"
                                                            style="color: #393f81;">Register here</a>
                                                    </p>
                                                </form>
                                            </div>
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
    <!--MDB SCRIPT LATEST CDN-->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
    <!--SWEETALERT2 LATEST CDN-->

    <script>
        $('#login').on('click', function () {
            var uname = $('#uname').val();
            var pword = $('#pword').val();
            if (uname != "" && pword != "") {
                $.ajax({
                    url: "assets/php/ajax_login.php",
                    type: "POST",
                    data: {
                        uname: uname,
                        pword: pword,
                    },
                    cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 201) {
                            Swal.fire({
                                icon: "error",
                                text: "Your Registration is still pending, Please Wait for admin's approval.",
                            });
                        }
                        else if (dataResult.statusCode == 203) {
                            window.location.href = "poultry_chicken/poultry_dashboard.php"
                        }
                        else if (dataResult.statusCode == 204) {
                            window.location.href = "poultry_egg/poultry_dashboard.php"
                        }
                        else if (dataResult.statusCode == 205) {
                            window.location.href = "poultry_both/poultry_dashboard.php"
                        }
                        else if (dataResult.statusCode == 202) {
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