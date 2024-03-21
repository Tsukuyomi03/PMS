<?php
include ("assets/php/config.php");
session_start();
if (isset ($_SESSION["User"])) {
    header("Location: customer/customer_dashboard.php");
    exit();
} else {

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
        <div class="container-fluid" style="margin-top: 5px; padding: 20px;">
            <div class="row">
                <div class="col-md-1">

                </div>
                <div class="col-md-10" style="background-color: transparent;">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card">
                                <div class="card-header"
                                    style="background: green; height: 120px; color: #fff; text-align:center">
                                    <i class="fa-solid fa-egg"
                                        style="margin-top:80px; font-size: 40px; background: green; height: 50px; width: 50px;border-radius: 60px; padding-top:10px; text-align:center"></i>

                                </div>
                                <div class="card-body">
                                    <h2 class="title" style="color: green; text-align: center; padding: 20px 0 30px 0">
                                        Create an Account</h2>
                                    <div class="row">
                                        <div class="col-xl-4 col-md-4 mb-4">
                                            <h5>Personal Information</h5>
                                            <div class="input-group flex-nowrap mb-2">
                                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                                <input type="text" class="form-control" placeholder="Name" id="cname">
                                            </div>
                                            <div class="input-group flex-nowrap mb-2">
                                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                                <input type="text" class="form-control" placeholder="Surname"
                                                    id="csname">
                                            </div>
                                            <div class="input-group flex-nowrap mb-2">
                                                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                                <input type="text" class="form-control" placeholder="Contact"
                                                    id="ccontact">
                                            </div>
                                            <div class="input-group flex-nowrap mb-2">
                                                <span class="input-group-text"><i
                                                        class="fa-solid fa-envelope"></i></span>
                                                <input type="text" class="form-control" placeholder="Email" id="cemail">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4 mb-4">
                                            <h5>Address</h5>
                                            <div class="input-group mb-2">
                                                <select name="region" class="form-control form-control-md" id="region">

                                                </select>
                                                <input type="hidden" class="form-control form-control-md"
                                                    name="region_text" id="region-text" required>
                                            </div>
                                            <div class="input-group mb-2">
                                                <select name="province" class="form-control form-control-md"
                                                    id="province">

                                                </select>
                                                <input type="hidden" class="form-control form-control-md"
                                                    name="province_text" id="province-text" required>
                                            </div>
                                            <div class="input-group mb-2">
                                                <select name="city" class="form-control form-control-md" id="city">

                                                </select>
                                                <input type="hidden" class="form-control form-control-md"
                                                    name="city_text" id="city-text" required>
                                            </div>
                                            <div class="input-group mb-2">
                                                <select name="barangay" class="form-control form-control-md"
                                                    id="barangay">

                                                </select>
                                                <input type="hidden" class="form-control form-control-md"
                                                    name="brgy_text" id="barangay-text" required>
                                            </div>
                                            <div class="input-group mb-2">

                                                <input type="text" class="form-control form-control-md"
                                                    name="street_text" id="street-text" placeholder="Street (Optional)">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4 mb-4">
                                            <h5>Account Information</h5>
                                            <div class="input-group flex-nowrap mb-2">
                                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                                <input type="text" class="form-control" placeholder="Username"
                                                    id="cuname">
                                            </div>
                                            <div class="input-group flex-nowrap mb-2">
                                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                                <input type="password" class="form-control" placeholder="Password"
                                                    id="cpword1">
                                                <button class="input-group-text" id="addon-wrapping"
                                                    onclick="showPassword();"><i class="fa-solid fa-eye"></i></button>
                                            </div>
                                            <div class="input-group flex-nowrap mb-2">
                                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                                <input type="password" class="form-control"
                                                    placeholder="Re-Enter Password" id="cpword2">
                                                <button class="input-group-text" id="addon-wrapping"
                                                    onclick="showPassword2();"><i class="fa-solid fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success" name="register"
                                                style="float:right" id="register">SIGN UP</button>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px; text-align:center;">
                                            Already have an account? <a href="customer_login.php"> Login here</a>
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
    <script src="assets/js/ph-address-selector.js"></script>
    <script>
        function showPassword() {
            $('#toggle-password').toggleClass("fa-eye fa-eye-slash");
            var x = document.getElementById("cpword1");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        function showPassword2() {
            $('#toggle-password').toggleClass("fa-eye fa-eye-slash");
            var x = document.getElementById("cpword2");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        $('#register').on('click', function () {

            var cname = $('#cname').val();
            var csname = $('#csname').val();
            var ccontact = $('#ccontact').val();
            var cemail = $('#cemail').val();

            var region = $('#region-text').val();
            var province = $('#province-text').val();
            var city = $('#city-text').val();
            var brgy = $('#barangay-text').val();
            var street = $('#street-text').val();

            var cuname = $('#cuname').val();
            var cpword1 = $('#cpword1').val();
            var cpword2 = $('#cpword2').val();

            if (cname != "" && csname != "" && ccontact != "" && cemail != "" && region != "" && province != "" && city != "" && brgy != "" && street != "" && cuname != "" && cpword1 != "" && cpword2 != "") {
                if (!$("#ccontact").val().match(/^(09|\+639)\d{9}$/)) {
                    Swal.fire({
                        icon: "error",
                        text: "Error 409 : Invalid Contact Format!",
                    });
                }
                if (!$('#cemail').val().match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)) {
                    Swal.fire({
                        icon: "error",
                        text: "Error 409 : Invalid Email Format!",
                    });
                }
                if (!$("#cpword1").val().match(/.{8,}/)) {
                    Swal.fire({
                        icon: "error",
                        text: "Error 409 : Password must be atleast 8 characters!",
                    });
                }
                else {
                    if ($("#cpword1").val() != $("#cpword2").val()) {
                        Swal.fire({
                            icon: "error",
                            text: "Error 409 : Password do not match!",
                        });
                    }
                    else {
                        $.ajax({
                            url: "assets/php/customer_registration.php",
                            type: "POST",
                            data: {
                                cname: cname,
                                csname: csname,
                                ccontact: ccontact,
                                cemail: cemail,
                                region: region,
                                province: province,
                                city: city,
                                brgy: brgy,
                                street: street,
                                cuname: cuname,
                                cpword1: cpword1,
                            },
                            cache: false,
                            success: function (dataResult) {
                                var dataResult = JSON.parse(dataResult);
                                if (dataResult.statusCode == 200) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Congratulations on successfuly creating your account. Please check your email for the One Time Pin Code to activate your account.",
                                        confirmButtonText: "OK",
                                        allowOutsideClick: false
                                    }).then((result) => {
                                        window.location.href = 'customer_otp.php?email=' + dataResult.Email;
                                    });
                                }
                                else if (dataResult.statusCode == 201) {
                                    Swal.fire({
                                        icon: "error",
                                        text: "Error 409 : Username Already Exist!",
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        text: dataResult.EmailError,
                                    });
                                }
                            }
                        });
                    }
                }
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