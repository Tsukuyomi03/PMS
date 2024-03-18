<?php
include("assets/php/config.php");
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
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <section class="vh-100">
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col col-xl-10">
                                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">
                                    Create Account</h5>
                                <div class="card" style="border-radius: 1rem;">
                                    <div class="row g-0">
                                        <div class="col-md-6 col-lg-7 align-items-center">
                                            <div class="card-body p-4 p-lg-3 text-black">
                                                <form>
                                                    <h6>Personal Information</h6>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label class="form-label" for="name">
                                                                    Name</label>
                                                                <input type="text" id="name" class="form-control"
                                                                    required />
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label class="form-label" for="lname">
                                                                    Last Name</label>
                                                                <input type="text" id="lname" class="form-control"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="address">Complete
                                                            Address</label>
                                                        <input type="text" id="address" class="form-control" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="contact">
                                                            Contact Number</label>
                                                        <input type="tel" id="contact" class="form-control" required />
                                                    </div>
                                                    <br>
                                                    <h6>Account Information</h6>
                                                    <div class="form-group">
                                                        <label class="form-label" for="uname">
                                                            Account Type</label>
                                                        <select required class="form-control" id="type">
                                                            <option hidden>-- Select Type --</option>
                                                            <option value="1">Chicken</option>
                                                            <option value="2">Eggs</option>
                                                            <option value="3">Chicken and Eggs</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="uname">
                                                            Username</label>
                                                        <input type="text" id="uname" class="form-control" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="pword">
                                                            Password</label>
                                                        <input type="password" id="pword" class="form-control"
                                                            required />
                                                    </div>
                                                    <br>
                                                    <div class="pt-1 mb-4">
                                                        <button class="btn btn-dark btn-block" type="button"
                                                            id="register">Register</button>
                                                    </div>
                                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have and
                                                        account?<a href="index.php" style="color: #393f81;"> Login
                                                            here</a>
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-5">
                                            <img src="assets/images/register_logo.avif" alt="login form"
                                                class="img-fluid" style="height:100% ;border-radius: 0 1rem 1rem  0;" />
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#register').on('click', function () {
            var name = $('#name').val();
            var lname = $('#lname').val();
            var address = $('#address').val();
            var contact = $('#contact').val();
            var uname = $('#uname').val();
            var pword = $('#pword').val();
            var type = $('#type').val();
            if (name != "" && lname != "" && address != "" && contact != "" && uname != "" && pword != "" && contact != "" && type != "") {
                if (!$("#contact").val().match(/^(09|\+639)\d{9}$/)) {
                    Swal.fire({
                        icon: "error",
                        text: "Error 409 : Invalid Contact Format!",
                    });
                } else {
                    $.ajax({
                        url: "assets/php/ajax_register.php",
                        type: "POST",
                        data: {
                            name: name,
                            lname: lname,
                            address: address,
                            contact: contact,
                            uname: uname,
                            pword: pword,
                            type: type,
                        },
                        cache: false,
                        success: function (dataResult) {
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Registered Successfully! Please wait for admin confirmation.",
                                    confirmButtonText: "OK",
                                    allowOutsideClick: false
                                }).then((result) => {
                                    window.location.href = 'index.php';
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
                                    text: "Error 500 : Soemthing Went Wrong",
                                });
                            }
                        }
                    });
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