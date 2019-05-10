<?php include('header.php');
?>
<script src="js/validation/login-validation.js?v=1.1"></script>
<div class="page-wrapper">
	<div class="header-min">
        <div class="container">
            <div class="row">
                <div class="logo col-md-4 col-sm-4 col-4 text-left text-center-xs"><a href="index.php"><img src="images/DellEMC.png" class="img-fluid"></a></div>
<!--                <div class="logo col-md-4 col-sm-4 col-4 text-center text-center-xs"><a href="javascript:void(0);"><img src="images/intel.png" class="img-fluid"></a></div>
                <div class="logo col-md-4 col-sm-4 col-4 text-right text-center-xs"><a href="javascript:void(0);"><img src="images/micro-soft.png" class="img-fluid"></a></div>
-->    
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="user-entry text-center">
                	<!--<div class="text-center usericon">
                            <i class="fa fa-pencil-square-o fa-4x" aria-hidden="true"></i>
                        </div>
                       <h3>Dont have an account?</h3>
                		<div class="regi text-center">
                          <a href="javascript:void(0);"  class="btn btn-default">Sign Up</a>
                        </div>-->
                </div>
            
            </div>
            <div class="col-md-6">
                <div class="user-entry log">
                		<div class="text-center usericon">
                        	<i class="fa fa-user-circle-o fa-4x" aria-hidden="true" ></i>
                        </div>
                	
                      <form id="loginForm" name="loginForm" method="post">
                      <div class="form-group user-form">
                      	<div class="login-block">
                        	<span><i class="fa fa-user fa-2x" aria-hidden="true"></i></span>
                        <label for="email">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email here">
                       	</label>
                        </div>
                      </div>
                      <div class="form-group user-form">
                      	<div class="login-block">
                        	<span><i class="fa fa-lock fa-2x" aria-hidden="true"></i></span>
                        <label for="pwd">
                        <input type="password" class="form-control" name="password" id="pasword" placeholder="Enter your password">
                        </label>
                        </div>
                         <span id="msg" class="error"></span>
                      </div>
                     <!-- <div class="form-group user-form">
                      		<a href="javascript:void(0);">Forgot Password</a>
                      </div>-->
                      <div class="fomr-group text-center">
                      <input type="submit" name="submit" id="submit" value="Login" class="btn btn-default">
                      </div>
                      <!-- <div class="form-group text-center">
                      	<p>Don't have access yet? <a href="javascript:void(0);">Request Access</a></p>
                       </div>-->
                    </form>
                </div>
            </div>
            
            <div class="new-registration-wrapper col-md-12 text-center footer-line">
            	<p>If you are facing issues, please send an email too <a href="mailto:ISIP@shobizexperience.com">ISIP@shobizexperience.com</a></p>
            </div>
        </div>
    </div>
    
</div>
