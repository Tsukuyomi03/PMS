<?php
include ("assets/php/config.php");
session_start();
if (isset ($_SESSION["User"])) {
    header("Location: customer/customer_dashboard.php");
    exit();
} else {
    $email = $_GET['email'];
    $sql = "SELECT * FROM tbl_customer WHERE Email='$email'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["Account_Status"] == "Verified") {
            header("Location: customer_login.php");
            exit();
        } else {

        }
    } else {
        header("Location: customer_login.php");
        exit();
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
<style>
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-xl-6 col-md-6 mb-4" style="margin-top: 5%">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div>
                            <img src="assets/images/Communication-email-green-icon.png" style="width: 30%; height: 30%;"
                                class="center">
                        </div>
                        <div class="login-content" style="padding-top: 5%;">
                            <h2 class="title" style="text-align:center;">EMAIL VERIFICATION</h2>
                            <br>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="container">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping"><i
                                                class="fa-solid fa-key"></i></span>
                                        <input type="text" class="form-control" placeholder="One Time Pin Code"
                                            id="otp">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="customer_login.php"><button class="btn btn-success form-control"><i
                                            class="fa-solid fa-hand-point-left"></i>
                                        BACK</button></a>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success form-control" id="resend"><i class="fas fa-envelope"></i>
                                    RESEND EMAIL</button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success form-control" id="confirm" type="submit"><i
                                        class="fas fa-check"></i>
                                    SUBMIT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
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
        $('#confirm').on('click', function () {
            var otp = $('#otp').val();
            var email = "<?php echo $email ?>";
            if (otp != "") {
                $.ajax({
                    url: "assets/php/customer_otp.php",
                    type: "POST",
                    data: {
                        otp: otp,
                        email: email,
                    },
                    cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {
                            Swal.fire({
                                icon: "success",
                                title: "Congratulations!m Your Account has been verified, you can now proceed to login.",
                                confirmButtonText: "OK",
                                allowOutsideClick: false
                            }).then((result) => {
                                window.location.href = 'customer_login.php';
                            });
                        }
                        else if (dataResult.statusCode == 201) {
                            Swal.fire({
                                icon: "error",
                                text: "Error 409 : Invalid OTP, Please Try Again!",
                            });
                        }
                        else {
                            Swal.fire({
                                icon: "error",
                                text: "Error 409 : Something Went Wrong!",
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
        $('#resend').on('click', function () {
            var email = "<?php echo $email ?>";
            $.ajax({
                url: "assets/php/customer_resend.php",
                type: "POST",
                data: {
                    email: email,
                },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        Swal.fire({
                            icon: "success",
                            title: "Email sent! If you cant find email on your inbox, please kindly check spam folder.",
                            confirmButtonText: "OK",
                            allowOutsideClick: false
                        })
                    }
                    else if (dataResult.statusCode == 201) {
                        Swal.fire({
                            icon: "error",
                            text: "Error 409 : Soemthing Went Wrong!",
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>