<?php
ob_start();
session_start();

include 'helpers.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <?php include'head.php' ?>
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <style>
        .otpbtn {
            width: 105px;
            padding: 25px 0px;
            margin-top: 0px;
            border-radius: 0px;
        }

        <style>
         .btn { background-image: linear-gradient(
                #29B6F6,
                #29B6F6);
             border-radius: 5px 5px 5px 5px;
             border: 0.5px solid white;
             color: white;
             transition: 0.5s;

         }
    </style>
</head>

<body>

<div id="spinner-div" class="pt-5">
    <div class="spinner-border text-primary" role="status">
    </div>
</div>

<div id="responseHandler" class="pt-5">
    <span id="responseMessage" class="badge responseBadge badge-danger"> </span>
</div>


<!-- App Header -->
<div class="appHeader1" style="background-color:lightslategray !important">
    <div class="left">
        <a href="#" onClick="goBack();" class="icon goBack">
            <i class="icon ion-md-arrow-back"></i>
        </a>
        <div class="pageTitle">Register</div>
    </div>
</div>
<!-- * App Header -->
<!-- App Capsule -->
<div id="appCapsule">
    <div class="appContent1 mb-2">

        <form action="#" method="post" id="Register" class="card-body" autocomplete="off">
            <div class="row ">
                <div class="col-8">
                    <div class="inner-addon left-addon">
                        <i class="icon ion-md-phone-portrait"></i>
                        <input type="tel" name="mobile" id="mobile" onKeyPress="return isNumber(event)" class="form-control" placeholder="Mobile Number" value="" maxlength="10">
                    </div>
                </div>
                <div class="col-4 pl-0"><a href="javascript:void(0);" class="btn ml-1 btn-block btn-primary otpbtn" id="reg_otp" onClick="mobileveryfication();">Send OTP</a></div>
            </div>
            <div class="inner-addon left-addon">
                <i class="icon ion-ios-mail"></i>
                <input class="form-control" type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="inner-addon left-addon">
                <i class="icon ion-md-key"></i>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            </div>
            <div class="inner-addon left-addon">
                <i class="icon ion-ios-gift"></i>
                <input type="text" name="rcode" id="rcode" class="form-control" placeholder="Code" value="<?php echo @$_GET['r'] ?? getUserUniqueId(1);?>" <?php echo !empty(@$_GET['r'])  ? @$_GET['r'] : 'disabled'?>>
            </div>
            <input type="hidden" name="action" value="register">
            <div class="form-group row mt-3 mb-3">
                <div class="col-12">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" checked class="custom-control-input" id="remember" name="remember">
                        <label class="custom-control-label text-muted" for="remember">I agree <a data-toggle="modal" href="#privacy" data-backdrop="static" data-keyboard="false">PRIVACY POLICY</a></label>
                    </div>
                </div>

            </div>
            <div>
                <div class="text-center mt-3">
                    <button id="registerButton" type="submit" class="btn ml-1 btn-block btn-primary otpbtn" style="width:264px;" disabled> Register </button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- appCapsule -->

<?php include("footer.php");?>
<div id="registerthanksPopup" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="text-center">
                    <h5>Thank you !</h5>
                    <h6>Your account has been created successfully....</h6>
                    <div class="text-center">
                        <button type="button" class="btn btn-sm btn-primary" onClick="window.location='';">OK</button></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="registertoast" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <div class="text-center" id="regtoast">
                </div>
            </div>
        </div>
    </div>
</div>
<div id="privacy" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight:normal;">Privacy Policy</h5>
            </div>
            <div class="modal-body responsive">
<!--                --><?php //echo content($con,"privacy");?>

            </div>
            <div class="modal-footer">
                <a class="pull-left" data-dismiss="modal"><strong>CLOSE</strong></a>
            </div>
        </div>
    </div>
</div>
<div id="otpform" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <button type="button" id="otpclose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <p><strong>Plese Enter OTP</strong></p>
                <div class="pt-2">
                    <form action="#" method="post" id="otpsubmitForm">
                        <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP" onKeyPress="return isNumber(event)">
                        <input type="hidden" name="type" id="type" value="otpval">

                        <h5 class="text-danger text-bold" id="failedOTPMessage"></h5>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary" style="width:264px;"> Submit OTP </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/lib/jquery-3.4.1.min.js"></script>
<!-- Bootstrap-->
<script src="assets/js/lib/popper.min.js"></script>
<script src="assets/js/lib/bootstrap.min.js"></script>
<!-- Owl Carousel -->
<script src="assets/js/plugins/owl.carousel.min.js"></script>
<!-- Main Js File -->
<script src="assets/js/app.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/account.js"></script>
</body>
</html>