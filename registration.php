<?php


if(!isset($_SESSION))
{
    session_start();
}

//Include database
include 'config/db.php';


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dellemc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAADQoDoAwahSAOr4/wDr+/8A49KPAOO9UQCvehIA5rtUAP7/3gD0//kA4bpsAPP+/wD4+P8A+//wAP31/wD/9vkA//X/AP3/+QDbqkYA//j/AP/6/AD9/v8A//v/ANGmZwD//v8ArIsqAP/yuADgwYoA4MeBAMq5agD/4tkA//HHAP/5xAD12bYA//fiAMStYgD//uUAsH0cAOzOnwDUkBUA///xAP/99ADmuXwA/+y5AM2vaACedBQA+v+zAPjq1wDlxXwA5sV8ANzFlwDkxY4A4//7AP/00QD/9tcA//vUAK55EQDuxY4ArXsXAMukWgC1fAgAz6pIAP/hqwD//+AA/c5zAPv/8gD99P4A+P/7AP//8gD7//sA26pIAP//+wDcpVQAybhpAMOYSQDhwYwA/+/MAMGpTwDPnEwApn4YAJ6CJACshAYA9fnzAP7y8AD2/fYA9vr/APT//AD3+v8A+Pr/APb9/wD1q10A///qAPr++QD4//wA+/r/APr9/wD/+/kA//f/AMrNlgD/+v8A6N2hAP/jxACvmAwA//3/AMC1fADGoS8A2MqWAK2SMADRlUEA6KdSAKR5HAD//8cAyqNZAOzPigDwzY0A7M+cANSYbgD///QA8uCHAN6tQQCsjCgA/+7LAOfQhQD0+u8A//jgAP/65gD5/fgA+P/+AP/89QD///UA//77AP///gDHoTEAxJ9PAOj2/wDw9fMA1MBpAOz8/wDQnkwAuZk1APb5/wC5mDsA///kAPP//wD4+f8A9v//AP32/wD/9v8A//7zAP7/9gC6gA8A//n/AP/8/wDmuH4A5L5+AP///wDkv4EA3r2WAM2eMgChfw0A3I8yAP/31gD/7eUA1ppBAN22ZwDRrDgA7//3AP/83AD2/PcA4LV2AP//5QCrgh8Aro4NAP3/9wD+//cA///3ANymUwDBhwoA//HOAOPQfwCShSkA6cSIAMOAKwDu9/sA7//4APr/+AD6/fsA/9+9AP3/+ADfqjwAza5jAP//+AC9hQ4A6t+jAMiyeADIozEA2MmYALiFKQDjxYwA4rZFAO7u/ACteAMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADnWufiS1O4WFcJxbUpUokq+oY0tuHWRMecFJLTMWVIERlwHDNRMTgoKTk7KlTWOtuRuEFAO4kVVVkaaJYGnGezerNoa6KLwVFbwoXAKhTx+IwhQ0EQybjw+iXlgLyKRooC9yMbtCcQS/nRx2MDkao1GqvSOsd8A9ADwsB8WaCLE6KW0+nsladMeWHkBsdaolJyCLnwpvjXoutCuzSr+ntr4yFodTE0e3YZiMWXV1YgVlUJcJDZuDg4ODGEFWl2shGE4XQ4+DGBgYGBiPXamKg399ZioQGF9XV18YEJlmfX8YkHxIGcQ/jo4/aniwIgyYRBhFgCZGOAYGOBJzlEVngQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=" rel="icon" type="image/x-icon" />-->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/dellemc.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css?v=0">
    <link href="assets/css/nav-sections.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/js/datepicker/jquery-ui.css">


    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="assets/js/jquery-2.2.3.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/jquery.mycart.js"></script>
    <script src="assets/js/serverjs.js"></script>
    <script src="assets/js/cycle/jquery.cycle2.min.js"></script>
    <script src="assets/js/datepicker/jquery-ui.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
</head>

<body>


<div class="page-wrapper">
    <div class="header-min">
        <div class="container">
            <div class="row">
                <div class="logo col-md-4 col-sm-4 col-4 text-left text-center-xs"><a href="index.php"><img src="assets/images/DellEMC.png" class="img-fluid"></a></div>
                <!--    <div class="logo col-md-4 col-sm-4 col-4 text-center text-center-xs"><a href="javascript:void(0);"><img src="images/intel.png" class="img-fluid"></a></div>-->
                <!--   <div class="logo col-md-4 col-sm-4 col-4 text-right text-center-xs"><a href="javascript:void(0);"><img src="images/micro-soft.png" class="img-fluid"></a></div>-->

            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="new-registration-wrapper">

        <h1>New Register</h1>

        <form id="registration" class="no-opacity">
            <div class="form-group row">
                <label for="first_name" class="col-sm-3 col-form-label">First Name * </label>
                <div class="col-sm-9">
                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name">
                    <span class="validate_msg1">Please provide your inputs</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-9">
                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name">
                    <!--<span class="validate_msg">All Input field is required</span>-->
                </div>
            </div>

            <!-- <div class="form-group row">
              <label for="inputdob3" class="col-sm-3 col-form-label">Date of Birth</label>
             <div class="col-sm-9">
                <input type="text" class="form-control" id="inputdob3" placeholder="Date of Birth">
              </div>
            </div>-->
            <div class="form-group row">
                <label for="team_id" class="col-sm-3 col-form-label">Team Name * </label>
                <div class="col-sm-9">
                    <select class="form-control" name="team_id" id="team_id">
                        <option value="">Please select team</option>
                        <?php
                        $sql = "SELECT * FROM `team` WHERE `status`='Active'";
                        $que = $db->query( $sql );
                        while ($row = $que->fetch_assoc()){
                            ?>
                            <option value="<?php echo $row['team_id']; ?>"><?php echo $row['team_name']?></option>
                            <?php
                        }
                        ?>
                        <!--<option value="Commercial">Commercial</option>
                        <option value="Channel">Channel</option>
                        <option value="DCSE">DCSE</option>
                        <option value="GCCS">GCCS</option>-->
                    </select>
                    <span class="validate_msg2">Please provide your inputs</span>
                </div>
            </div>


            <div class="form-group row">
               <label for="reporting_manager" class="col-sm-3 col-form-label">Report Manager *</label>
               <div class="col-sm-9">
                <select class="form-control" name="reporting_manager" id="reporting_manager">
                   <option value="">--Select Reporting Manager--</option>
                 </select>
                 <span class="validate_msg3">Please provide your inputs</span>
               </div>
           </div>

            <div class="form-group row">
                <label for="employee_id" class="col-sm-3 col-form-label">Employee Id *</label>
                <div class="col-sm-9">
                    <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="Employee Id">
                    <span class="validate_msg4">Please provide your inputs</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">User Type</label>
                <div class="col-sm-9">
                    <label class="custom-radio">ISR
                        <input type="radio" checked="checked" name="user_type" value="ISR">
                        <span class="checkmark"></span>
                    </label>
                    <label class="custom-radio">TSR
                        <input type="radio"  name="user_type" value="TSR">
                        <span class="checkmark"></span>
                    </label>
                    <label class="custom-radio">AISR
                        <input type="radio" name="user_type" value="AISR">
                        <span class="checkmark"></span>
                    </label>
                    <label class="custom-radio">IDCSE
                        <input type="radio"  name="user_type" value="IDCSE">
                        <span class="checkmark"></span>
                    </label>
                    <label class="custom-radio">AE
                        <input type="radio" name="user_type" value="AE">
                        <span class="checkmark"></span>
                    </label>
                    <label class="custom-radio">SE
                        <input type="radio"  name="user_type" value="SE">
                        <span class="checkmark"></span>
                    </label>
                    <label class="custom-radio">ISM
                        <input type="radio" name="user_type" value="ISM">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <label for="email"  class="col-sm-3 col-form-label">Email * </label>
                <div class="col-sm-9">
                    <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                    <span class="validate_msg5">Please provide your inputs, </span>
                    <span class="validate_email">Enter your valid email address.</span>
                    <span class="validate_email_reg">Only official email id is allowed</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password *</label>
                <div class="col-sm-9">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    <span class="validate_msg6">Please provide your inputs</span>
                    <span class="validate_pass">Your Password must be at least 6 character long.</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <input type="hidden" name="type" value="Registration">
                    <button type="submit" class="btn btn-primary">Sign up</button>
                    <br><span class="response_msg"></span>
                </div>
            </div>
        </form>

    </div>
    <div class="footer-line text-center">
        <p>If you are facing issues, please send an email too <a href="mailto:<?php echo email; ?>"><?php echo email; ?></a></p>
    </div>
</div>


</body>
</html>
