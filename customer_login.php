<?php
include ("assets/php/config.php");
session_start();
if (isset ($_SESSION["User"])) {
    header("Location: customer/customer_dashboard.php");
    exit();
} else {
    if (isset ($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM `tbl_customer` WHERE Username = '$username' AND `Password` = '$password'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['Username'];
            if ($row['Account_Status'] == 'Unverified') {
                $_SESSION['email'] = $row['Email'];
                $_SESSION['status'] = "error";
                $_SESSION['message'] = "It appears that your account is not verified yet, please check your email and enter the OTP below to activate your account!";
                header("Location: https://eplanmo.herokuapp.com/epm_otp.php?email=$email");
                exit();
            } else {
                $_SESSION['User'] = $row['Username'];
                $_SESSION['status'] = "success";
                $_SESSION['message'] = "Login Sucessful";
                header("Location: https://eplanmo.herokuapp.com/epm_admin.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['message'] = "Your Login Name or Password is invalid";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>PMS</title>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="wrapper d-flex">
        <div class="container-fluid" style="margin-top: 2%;">
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-xl-4 col-md-8 mb-4">
                    <div class="card">
                        <div class="card-header"
                            style="background: green; height: 120px; color: #fff; text-align:center;">
                            <i class="fa-solid fa-egg"
                                style="margin-top:80px; font-size: 40px; background: green; height: 50px; width: 50px;border-radius: 60px; padding-top:10px"></i>
                        </div>
                        <div class="card-body">
                            <h2 class="title" style="color: green; text-align: center; padding: 20px 0 30px 0">
                                SIGN IN</h2>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping"><i
                                        class="fa-solid fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                    aria-describedby="addon-wrapping" id="uname">
                            </div>
                            <br>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping"><i
                                        class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Password" id="pword">
                                <button class="input-group-text" id="addon-wrapping"><i
                                        class="fa-solid fa-eye"></i></button>
                            </div>

                            <div class="row">
                                <div class="col-md-12" style="padding: 20px;">
                                    <a href="" data-toggle="modal" data-target="#modalforgotpass">Forgot
                                        Password</a>
                                    <span style="float: right"><a href="epm_register.php">Create an
                                            account?</a></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="container">
                                    <button class="btn btn-success form-control" id="login">LOGIN</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
    </div>

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
        $('#login').on('click', function () {
            var uname = $('#uname').val();
            var pword = $('#pword').val();
            if (uname != "" && pword != "") {
                $.ajax({
                    url: "assets/php/customer_login.php",
                    type: "POST",
                    data: {
                        uname: uname,
                        pword: pword,
                    },
                    cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {
                            Swal.fire({
                                icon: "error",
                                title: "It appears that your account has not been verified yet, please check your email and enter the OTP.",
                                confirmButtonText: "OK",
                                allowOutsideClick: false
                            }).then((result) => {
                                window.location.href = 'customer_otp.php?email=' + dataResult.Email;
                            });
                        }
                        else if (dataResult.statusCode == 201) {
                            Swal.fire({
                                icon: "error",
                                text: "Error 409 : Invalid Username / Password !",
                            });
                        }
                        else {
                            window.location.href = 'customer/customer_dashboard.php';
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