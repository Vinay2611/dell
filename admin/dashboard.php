<?php include('header2.php');
include('classes/class.common.php');
$oCommon = new Common();
$cliamPending = $oCommon->showClaimStatus('Pending');
$cliamDone = $oCommon->showClaimStatus('Claimed');
$cliamRedeem = $oCommon->showClaimStatus('Redeemed');


$userPending = $oCommon->userStatus('Pending');
$userActive = $oCommon->userStatus('Active');
$userReject = $oCommon->userStatus('Reject');

$orderPending = $oCommon->orderStatus('Pending');
$orderInprogress = $oCommon->orderStatus('In-progress');
$orderCompleted = $oCommon->orderStatus('Completed');
$orderRejected = $oCommon->orderStatus('Rejected');

//$orderReturn = $oCommon->orderStatus('Return Request');
$orderReplace = $oCommon->orderStatus('Replacement Request');
?>
<div class="rewards-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <!--col-md-offset-3-->
                     <?php include('menu.php'); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                    	<div class="breadcrums-block">
                    	 <ul class="breadcrumb">
                          <li><a href="#">Home</a></li>
                          <li class="is-active">Dashboard</li>
                        </ul> 
                    </div>
						    <!--<h1>New Register</h1>-->
                    </div>
                    <div class="col-md-3">
                        <div class="contest-block curve">
                            <div style="margin-top:0px;" class="table-responsive">
                                <div class="list-group">
                               <div><a style="cursor:default; font-weight:bold; font-size:15px;" class="list-group-item active">User Status</a> </div>
                                <a style="cursor:default;" class="list-group-item" href="">
                                <span class="glyphicon glyphicon-hand-up"></span> Pending <span class="badge"><?php echo $userPending;?></span>
                                </a>
                                   <a style="cursor:default;" class="list-group-item" href="">
                                <span class="glyphicon glyphicon-hand-right"></span> Approved <span class="badge"><?php echo $userActive?></span>
                                </a>
                                <a style="cursor:default;" class="list-group-item" href="">
                                <span class="glyphicon glyphicon-hand-right"></span> Rejected  <span class="badge"><?php echo $userReject;?></span>
                                </a>
                                    <a style="cursor:pointer;" class="list-group-item text-right" style="color:#6484D0;" href="users">
                                        Go to Users </a>
                                </div>
                            </div>
        
                        
                    </div>
                
                
                
            </div>
                    
                    <!--<div class="col-md-3">
                        <div class="contest-block curve">
                            <div style="margin-top:0px;" class="table-responsive">
                                <div class="list-group">
                               <div><a style="cursor:default; font-weight:bold; font-size:15px;" class="list-group-item active">Claim Status</a> </div>
                                <a style="cursor:default;" class="list-group-item" href="">
                                <span class="glyphicon glyphicon-hand-up"></span> Pending <span class="badge"><?php //echo  $cliamPending ;?></span>
                                </a>
                                   <a style="cursor:default;" class="list-group-item" href="">
                                <span class="glyphicon glyphicon-hand-right"></span> Partially claimed  <span class="badge"><?php //echo  $cliamDone;?></span>
                                </a>
                                <a style="cursor:default;" class="list-group-item" href="">
                                <span class="glyphicon glyphicon-hand-right"></span> Redeemed <span class="badge"><?php //echo  $cliamRedeem ;?></span>
                                </a>
                                
                                </div>
                            </div>
                    </div>
                  </div>-->
                  
                  <div class="col-md-3">
                        <div class="contest-block curve">
                            <div style="margin-top:0px;" class="table-responsive">
                                <div class="list-group">
                               <div><a style="cursor:default; font-weight:bold; font-size:15px;" class="list-group-item active">Order Status</a> </div>
                                <a style="cursor:default;" class="list-group-item" href="">
                                <span class="glyphicon glyphicon-hand-up"></span> Pending <span class="badge"><?php echo $orderPending;?></span>
                                </a>
                                   <a style="cursor:default;" class="list-group-item" href="">
                                <span class="glyphicon glyphicon-hand-right"></span> In-progress <span class="badge">
								<?php echo  $orderInprogress;?></span>
                                </a>
                                <a style="cursor:default;" class="list-group-item" href="">
                                <span class="glyphicon glyphicon-hand-right"></span> Completed <span class="badge"><?php echo  $orderCompleted;?></span>
                                </a>
                          <a style="cursor:default;" class="list-group-item" href="">
                          <span class="glyphicon glyphicon-hand-right"></span> Rejected <span class="badge"><?php echo $orderRejected;?></span>
                          </a> 
                          <a style="cursor:default;" class="list-group-item" href="">
                          <span class="glyphicon glyphicon-hand-right"></span> Replace <span class="badge"><?php echo $orderReplace;?></span>
                          </a>
                           </div>
                            </div>
                    </div>
                
                  </div>
            		
            
                   
            
            
                </div>
                <div class="footer">
                <p>If you are facing issues, please send an email to <a href="mailto:  <?php echo SUPPORT;?>" style="color:#F1ECEC;">
			  <?php echo SUPPORT;?></a></p>
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>
