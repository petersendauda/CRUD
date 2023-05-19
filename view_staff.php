<?php
include('include/header.php');

$id = $_SESSION['userid'];
$data = mysqli_query($sql_con, "select * from tfs where id = '$id' ");
$row = mysqli_fetch_array($data);
$tfs_id = $row['id'];

$rbtc = $row['rbtc'];

if (isset($_POST['labtechsubmit'])) {
    $email_address = $_POST['email_address'];
    $data = mysqli_query($sql_con, "select email_address from labtechnician");
    while ($row = mysqli_fetch_array($data)) {
        $emaildb = $row['email_address'];
        if ($emaildb == $email_address) {
            echo "<script>alert('Email Address already exist, Please try again!')</script>";
            echo "<script>window.location='view_staff.php';</script>";
            return;
        }
    }

    $tfs_id = $_POST['tfs_id'];
    $tfs_name = $_POST['tfs_name'];
    $tfs_username = $_POST['tfs_username'];
    $randpassword = $_POST['randpassword'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $contact_code = $_POST['contact_code'];
    $home_address = $_POST['home_address'];
    $contact_number = $_POST['contact_number'];
    if ($_POST['tfs_name'] == "PCMH") {
        $communityname = 'Cottage/PCMH';
    } elseif ($_POST['tfs_name'] == "Connaught") {
        $communityname = 'Connaught';
    } elseif ($_POST['tfs_name'] == "JMURSLAF") {
        $communityname = '34 Military Hospital';
    } elseif ($_POST['tfs_name'] == "Rokupa") {
        $communityname = 'Rokupa';
    }
    $area = $_POST['area'];
    $status = 'Pending';
    $password = "labtech$randpassword";
    $data = mysqli_query($sql_con, "select password from labtechnician");
    while ($row = mysqli_fetch_array($data)) {
        $passworddb = $row['password'];
        if ($passworddb == $password) {
            echo "<script>alert('Error Occured, Please try again!')</script>";
            echo "<script>window.location='view_labtech.php';</script>";
            return;
        }
    }
    $cln = 'labtech';
    $username = "$tfs_username$cln";


    mysqli_query($sql_con, "insert into labtechnician (tfs_id,tfs_name,communityname,first_name,middle_name,last_name,email_address,home_address,contact_code,contact_number,area,username,password,status) values ('$tfs_id','$tfs_name','$communityname','$first_name','$middle_name','$last_name','$email_address','$home_address','$contact_code','$contact_number','$area','$username','$password','$status')");
    $subject = "Welcome To projectMOF";
    $to = $_POST['email'];
    $from = "info@lifebloodsl.com";

    //data
    $msg = "<br><!DOCTYPE html>
<html>
<head>
<meta name=\"viewport\" content=\"width=device-width\" />

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

</head>
<body bgcolor=\"#FFFFFF\" style=\"-webkit-font-smoothing:antialiased; 
	-webkit-text-size-adjust:none; 
	width: 100%!important; 
	height: 100%;\">


<table class=\"head-wrap\" bgcolor=\"#3b5de7\" style=\"width: 100%;\">
	<tr>
		<td></td>
		<td class=\"header container\" >
				
				<div class=\"content\" style=\"	padding:15px;
	max-width:600px;
	margin:0 auto;
	display:block;
	color:white\">
				<h4 style=\"color: white; margin-top:20px; font-family: \'Baumans\', cursive; font-size: 23px;\">AutoHealth<sup>TM</sup></b1> </h4>
				</div>
				
		</td>
		<td></td>
	</tr>
</table>



<table class=\"body-wrap\" style=\" width: 100%\">
	<tr>
		<td></td>
		<td class=\"container\" bgcolor=\"#FFFFFF\" style=\"	display:block!important;
	max-width:600px!important;
	margin:0 auto!important;
	clear:both!important;\">

			<div class=\"content\" style=\"	padding:15px;
	max-width:600px;
	margin:0 auto;
	display:block; \">
			<table>
				<tr>
					<td>
						<h3 style=\"font-weight:500; font-size: 27px;\">Hi, " . $_POST["first_name"] . "</h3>
						<p class=\"lead\" style=\"font-size:17px; \">Welcome to LifeBlood portal. You have been registered as <strong style=\"font-weight:bold; color:#3b5de7\">" . $_POST["area"] . "</strong> Staff and can use your
credentials to log in to the portal. 	
						
						<p class=\"callout\" style=\"padding:15px;
	background-color:#ECF8FF;
	margin-bottom: 15px;\"><strong style=\"font-weight:bold; font-size:20px;\">Your log in credentials are as follows:</strong> <br><strong style=\"font-weight:bold; font-size:15px;\">Your Email:</strong><strong style=\"color:#3b5de7; font-weight:bold; font-size:15px;\"> " . $email . " </strong><br> <strong style=\"font-weight:bold; font-size:15px;\">Your Password:</strong><strong style=\"color:#3b5de7; font-weight:bold; font-size:15px;\">  " . $password . " </strong>
						<br><br>Use this link to login into your Staff Portal. <a href=\"http://labtech.lifebloodsl.com\">Click here! &raquo;</a>
						</p>				
												
						
						<table class=\"social\" width=\"100%\" style=\"padding:15px; */
	background-color: #ebebeb;\">
							<tr>
								<td>
									

								
									<table align=\"left\" class=\"column\" style=\"	width: 300px;
	float:left;\">
										<tr>
											<td>				
																			
												<h5 class=\"\">For more information, please contact our support teams at:</h5>
												<p>Phone: <strong style=\"color:#3b5de7;\">+23288603285</strong><br/>
                Email: <strong style=\"color:#3b5de7;\"><a href=\"emailto:support@lifebloodsl.coml\">support@lifebloodsl.com</a></strong></p> <br>

											</td>
										</tr>
									</table>
									
									<span class=\"clear\" style=\"display: block; clear: both; \"></span>	
									
								</td>
							</tr>
						</table>
						
					</td>
				</tr>
			</table>
			</div>
									
		</td>
		<td></td>
	</tr>
</table>

<table class=\"footer-wrap\" style=\"width: 100%;	clear:both!important;\">
	<tr>
		
		<td class=\"container\" style=\"display:block!important;
	max-width:600px!important;
	margin:0 auto!important;
	clear:both!important;\">
			
			
				<div class=\"content\" style=\"	padding:15px;
	max-width:600px;
	margin:0 auto;
	display:block; \">
				<table>
				<tr>
					<td align=\"center\">
						<p style=\"border-top: 1px solid rgb(215,215,215); padding-top:15px; 	font-size:10px;
	font-weight: bold;\">
							<a href=\"#\">Terms</a> |
							<a href=\"#\">Privacy</a> |
							<a href=\"#\" style=\"text-decoration:none\">Powered by: Niche Technologies</a>
						</p>
					</td>
				</tr>
			</table>
				</div>
				
		</td>
	</tr>
</table>

</body>
</html>\n";

    //Headers
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
    $headers .= "Reply-To: <koromajoseph1000@gmail.com>\r\n";
    $headers .= "Return-Path: <koromajoseph1000@gmail.com>\r\n";
    $headers .= "From: <" . $from . ">";

    mail($to, $subject, $msg, $headers);
    echo "<script>alert('Lab Technician Added Successfully!!')</script>";
    echo "<script>window.location='view_staff.php';</script>";
}

if (isset($_POST['cliniciansubmit'])) {
    $email_address = $_POST['email_address'];
    $data = mysqli_query($sql_con, "select email_address from clinician");
    while ($row = mysqli_fetch_array($data)) {
        $emaildb = $row['email_address'];
        if ($emaildb == $email_address) {
            echo "<script>alert('Email Address already exist, Please try again!')</script>";
            echo "<script>window.location='view_staff.php';</script>";
            return;
        }
    }
    $tfs_id = $_POST['tfs_id'];
    $tfs_name = $_POST['tfs_name'];
    $tfs_username = $_POST['tfs_username'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $contact_code = $_POST['contact_code'];
    $home_address = $_POST['home_address'];
    $contact_number = $_POST['contact_number'];
    $dep = $_POST['dep'];
    $ward = $_POST['ward'];
    $status = 'Pending';
    $password = "cln$contact_number";
    $cln = 'cln';
    $username = "$tfs_username$cln";


    mysqli_query($sql_con, "insert into clinician (tfs_id,tfs_name,first_name,middle_name,last_name,email_address,home_address,contact_code,contact_number,dep,ward,username,password,status) values ('$tfs_id','$tfs_name','$first_name','$middle_name','$last_name','$email_address','$home_address','$contact_code','$contact_number','$dep','$ward','$username','$password','$status')");
    $subject = "Welcome To projectMOF";
    $to = $_POST['email'];
    $from = "koromajoseph1000@gmail.com";

    //data
    $msg = "<br><!DOCTYPE html>
<html>
<head>
<meta name=\"viewport\" content=\"width=device-width\" />

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

</head>
<body bgcolor=\"#FFFFFF\" style=\"-webkit-font-smoothing:antialiased; 
	-webkit-text-size-adjust:none; 
	width: 100%!important; 
	height: 100%;\">


<table class=\"head-wrap\" bgcolor=\"#3b5de7\" style=\"width: 100%;\">
	<tr>
		<td></td>
		<td class=\"header container\" >
				
				<div class=\"content\" style=\"	padding:15px;
	max-width:600px;
	margin:0 auto;
	display:block;
	color:white\">
				<h4 style=\"color: white; margin-top:20px; font-family: \'Baumans\', cursive; font-size: 23px;\">AutoHealth<sup>TM</sup></b1> </h4>
				</div>
				
		</td>
		<td></td>
	</tr>
</table>



<table class=\"body-wrap\" style=\" width: 100%\">
	<tr>
		<td></td>
		<td class=\"container\" bgcolor=\"#FFFFFF\" style=\"	display:block!important;
	max-width:600px!important;
	margin:0 auto!important;
	clear:both!important;\">

			<div class=\"content\" style=\"	padding:15px;
	max-width:600px;
	margin:0 auto;
	display:block; \">
			<table>
				<tr>
					<td>
						<h3 style=\"font-weight:500; font-size: 27px;\">Hi, " . $_POST["first_name"] . "</h3>
						<p class=\"lead\" style=\"font-size:17px; \">Welcome to LifeBlood portal. You have been registered as <strong style=\"font-weight:bold; color:#3b5de7\">" . $_POST["area"] . "</strong> Staff and can use your
credentials to log in to the portal. 	
						
						<p class=\"callout\" style=\"padding:15px;
	background-color:#ECF8FF;
	margin-bottom: 15px;\"><strong style=\"font-weight:bold; font-size:20px;\">Your log in credentials are as follows:</strong> <br><strong style=\"font-weight:bold; font-size:15px;\">Your Email:</strong><strong style=\"color:#3b5de7; font-weight:bold; font-size:15px;\"> " . $email . " </strong><br> <strong style=\"font-weight:bold; font-size:15px;\">Your Password:</strong><strong style=\"color:#3b5de7; font-weight:bold; font-size:15px;\">  " . $password . " </strong>
						<br><br>Use this link to login into your Staff Portal. <a href=\"http://labtech.lifebloodsl.com\">Click here! &raquo;</a>
						</p>				
												
						
						<table class=\"social\" width=\"100%\" style=\"padding:15px; */
	background-color: #ebebeb;\">
							<tr>
								<td>
									

								
									<table align=\"left\" class=\"column\" style=\"	width: 300px;
	float:left;\">
										<tr>
											<td>				
																			
												<h5 class=\"\">For more information, please contact our support teams at:</h5>
												<p>Phone: <strong style=\"color:#3b5de7;\">+23288603285</strong><br/>
                Email: <strong style=\"color:#3b5de7;\"><a href=\"emailto:support@lifebloodsl.coml\">support@lifebloodsl.com</a></strong></p> <br>

											</td>
										</tr>
									</table>
									
									<span class=\"clear\" style=\"display: block; clear: both; \"></span>	
									
								</td>
							</tr>
						</table>
						
					</td>
				</tr>
			</table>
			</div>
									
		</td>
		<td></td>
	</tr>
</table>

<table class=\"footer-wrap\" style=\"width: 100%;	clear:both!important;\">
	<tr>
		
		<td class=\"container\" style=\"display:block!important;
	max-width:600px!important;
	margin:0 auto!important;
	clear:both!important;\">
			
			
				<div class=\"content\" style=\"	padding:15px;
	max-width:600px;
	margin:0 auto;
	display:block; \">
				<table>
				<tr>
					<td align=\"center\">
						<p style=\"border-top: 1px solid rgb(215,215,215); padding-top:15px; 	font-size:10px;
	font-weight: bold;\">
							<a href=\"#\">Terms</a> |
							<a href=\"#\">Privacy</a> |
							<a href=\"#\" style=\"text-decoration:none\">Powered by: Niche Technologies</a>
						</p>
					</td>
				</tr>
			</table>
				</div>
				
		</td>
	</tr>
</table>

</body>
</html>\n";

    //Headers
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
    $headers .= "Reply-To: <koromajoseph1000@gmail.com>\r\n";
    $headers .= "Return-Path: <koromajoseph1000@gmail.com>\r\n";
    $headers .= "From: <" . $from . ">";

    mail($to, $subject, $msg, $headers);
    echo "<script>alert('Clinician Added Successfully!!')</script>";
    echo "<script>window.location='view_staff.php';</script>";
}


?>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <!-- row -->

    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-3 col-xxl-6 col-sm-6">
                <div class="card gradient-bx text-white bg-success rounded">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <p class="mb-1">Total Clinicians</p>
                                <div class="d-flex flex-wrap">
                                    <?php
                                    $data = mysqli_query($sql_con, "SELECT * FROM clinician WHERE tfs_id='$tfs_id' ");
                                    $row = mysqli_num_rows($data);
                                    ?>

                                    <h2 class="fs-40 font-w600 text-white mb-0 mr-3"><?php echo $row ?></h2>
                                    <div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-6 col-sm-6">
                <div class="card gradient-bx text-white bg-info rounded">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <p class="mb-1">Total Laboratory Staff</p>
                                <div class="d-flex flex-wrap">
                                    <?php
                                    $data = mysqli_query($sql_con, "SELECT * FROM labtechnician WHERE tfs_id='$tfs_id'");
                                    $row = mysqli_num_rows($data);
                                    ?>

                                    <h2 class="fs-40 font-w600 text-white mb-0 mr-3"><?php echo $row ?></h2>
                                    <div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Staff</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)"><?php echo $row['name'] ?> Staff</a></li>
            </ol>

        </div>
        <!-- row -->
        <div class="col-xl-12">
            <div class="card" style="box-shadow:none">
                <!--<div class="card-header" style="box-shadow:none">-->
                <!--    <h5 class="card-title">Staff</h5>-->
                <!--</div>-->
                <div class="card-body" style="box-shadow:none">
                    <!-- Nav tabs -->
                    <div class="custom-tab-1">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home1"> Clinician</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile1"> Laboratory Staff</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile2"> M&E</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile3"> Guest User</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home1" role="tabpanel">
                                <div class="pt-0">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="card" style="box-shadow:none">

                                                <div class="card-body" style="box-shadow:none">
                                                    <div class="d-flex justify-content-end">

                                                        <a href="add_clinician.php" class="text-success mr-1">&nbsp;&nbsp;<i class="fa fa-plus"></i> Add Clinician&nbsp;&nbsp;</a>
                                                        <div class="modal fade bd-clinician-modal-lg<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Add Clinician</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-validation">
                                                                            <form class="form-valide" method="POST">
                                                                                <div class="row">
                                                                                    <div class="col-xl-12">
                                                                                        <h6 class="text-muted">Personal Information</h6>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">First Name
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="text" class="form-control" id="val-name" name="first_name" placeholder="Enter First Name.." required>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">Middle Name

                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="text" class="form-control" id="val-name" name="middle_name" placeholder="Enter Middle Name..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group row">
                                                                                            <label class="col-lg-2 col-form-label" for="val-name">Last Name
                                                                                                <span class="text-danger">*</span>
                                                                                            </label>
                                                                                            <div class="col-lg-10">
                                                                                                <input type="text" class="form-control" id="val-name" name="last_name" placeholder="Enter First Name.." required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr>
                                                                                        <h6 class="text-muted">Contact Information</h6>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">Email Address
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="email" class="form-control" id="val-name" name="email_address" placeholder="Enter Email Address..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">Home Address
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="text" class="form-control" id="val-name" name="home_address" placeholder="Enter Home Address..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-lg-2 col-form-label" for="val-code">Contact
                                                                                                <span class="text-danger">*</span>
                                                                                            </label>
                                                                                            <div class="col-lg-4">
                                                                                                <select class="form-control" id="val-code" name="contact_code" required>
                                                                                                    <option value="">Code</option>
                                                                                                    <option value="+23230">+23230</option>
                                                                                                    <option value="+23233">+23233</option>
                                                                                                    <option value="+23280">+23280</option>
                                                                                                    <option value="+23288">+23288</option>
                                                                                                    <option value="+23277">+23277</option>
                                                                                                    <option value="+23299">+23290</option>
                                                                                                    <option value="+23299">+23299</option>
                                                                                                    <option value="+23279">+23279</option>
                                                                                                    <option value="+23278">+23278</option>
                                                                                                    <option value="+23276">+23276</option>
                                                                                                    <option value="+23275">+23275</option>
                                                                                                    <option value="+23231">+23231</option>
                                                                                                    <option value="+23231">+23232</option>
                                                                                                    <option value="+23234">+23234</option>
                                                                                                    <option value="+23225">+23225</option>
                                                                                                    <option value="+23221">+23221</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <input type="text" class="form-control" id="val-contactphone" name="contact_number" placeholder="******" required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr>
                                                                                        <h6 class="text-muted">Site Information</h6>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-district">Dpt
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <select class="form-control" id="val-district" name="dep" required>
                                                                                                            <option value="">Select Department</option>
                                                                                                            <option value="Surgery">Surgery</option>
                                                                                                            <option value="Internal Medicine">Internal Medicine</option>
                                                                                                            <option value="Family Medicine">Family Medicine
                                                                                                            </option>
                                                                                                            <option value="Paediatrics">Paediatrics</option>
                                                                                                            <option value="Obstetrics and Gynaecology">Obstetrics and Gynaecology</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">Ward
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="text" class="form-control" id="val-name" name="ward" placeholder="Enter Ward..">
                                                                                                        <?php
                                                                                                        $id = $_SESSION['userid'];
                                                                                                        $data = mysqli_query($sql_con, "select * from tfs where id = $id");
                                                                                                        $row = mysqli_fetch_array($data);

                                                                                                        $rbtc = $row['rbtc'];
                                                                                                        ?>
                                                                                                        <input type="hidden" class="form-control" id="val-name" value="<?php echo $row['id'] ?>" name="tfs_id" placeholder="Enter Ward..">
                                                                                                        <input type="hidden" value="<?php echo $row['name'] ?>" class="form-control" id="val-name" name="tfs_name" placeholder="Enter Ward..">
                                                                                                        <input type="hidden" value="<?php echo $row['username'] ?>" class="form-control" id="val-name" name="tfs_username" placeholder="Enter Ward..">

                                                                                                    </div>
                                                                                                </div>

                                                                                                <!--  <div class="form-group row">-->
                                                                                                <!--    <div class="col-lg-8 ml-auto">-->
                                                                                                <!--        <button type="submit" name="submit" class="btn btn-primary">Add RBTC</button>-->
                                                                                                <!--    </div>-->
                                                                                                <!--</div>-->
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                                                        <a type="button" name="cliniciansubmit" class="btn btn-primary">Add</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>


                                                    <div class="table-responsive">
                                                        <table id="example" class="display min-w850">
                                                            <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Email</th>
                                                                    <th>Address</th>
                                                                    <th>Contact</th>
                                                                    <th>Ward</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $data = mysqli_query($sql_con, "SELECT * FROM clinician WHERE tfs_id='$tfs_id' ORDER BY clinician.id DESC");
                                                                while ($row = mysqli_fetch_array($data)) {
                                                                ?>
                                                                    <tr>
                                                                        <td nowrap="nowrap"><?php
                                                                                            $space = ' ';
                                                                                            echo $row['first_name'];
                                                                                            echo $space;
                                                                                            echo $row['middle_name'];
                                                                                            echo $space;
                                                                                            echo $row['last_name']; ?></td>
                                                                        <td><?php echo $row['email_address']; ?></td>
                                                                        <td><?php echo $row['home_address']; ?></< /td>
                                                                        <td><?php echo $row['contact_code'];
                                                                            echo $row['contact_number']; ?></< /td>
                                                                       
                                                                        <td><?php echo $row['ward']; ?></< /td>
                                                                        <td nowrap="nowrap">
                                                                            <div class="d-flex">
                                                                                <a data-toggle="modal" data-tooltip="tooltip" title="Delete" data-target="#exampleModaldep<?php echo $row['id']; ?>" class="btn btn-danger  sharp mr-1"><i class="fa fa-trash"></i></a>
                                                                            </div>

                                                                            <!-- MODEL -->
                                                                            <div class="modal fade" id="exampleModaldep<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Clinician</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            Do you really want to delete <?php $space = ' ';
                                                                                                                            echo $row['first_name'];
                                                                                                                            echo $space;
                                                                                                                            echo $row['middle_name'];
                                                                                                                            echo $space;
                                                                                                                            echo $row['last_name']; ?>?
                                                                                            <form class="form-valide" action="" method="post">
                                                                                                <input type="hidden" class="form-control" value="<?php $space = ' ';
                                                                                                                                                    echo $row['firstname'];
                                                                                                                                                    echo $space;
                                                                                                                                                    echo $row['middlename'];
                                                                                                                                                    echo $space;
                                                                                                                                                    echo $row['lastname']; ?>" name="name">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['id'] ?>" name="id">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['date'] ?>" name="date">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['facility'] ?>" name="facility">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['email'] ?>" name="email">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['refcode'] ?>" name="refcode">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['phonenumber'] ?>" name="phonenumber">
                                                                                                <div class="form-group">

                                                                                                </div>
                                                                                                <div class="text-center">
                                                                                                    <button type="submit" name="reject" class="btn btn-danger btn-block" style="font-family: 'Montserrat', sans-serif;">Delete</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile1">
                                <div class="pt-0">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="card" style="box-shadow:none">

                                                <div class="card-body" style="box-shadow:none">
                                                    <div class="d-flex justify-content-end">
                                                        <a href="add_lab.php" class="text-success sharp mr-1">&nbsp;&nbsp;<i class="fa fa-plus"></i> Add Laboratory Staff</a>
                                                        <div class="modal fade bd-example-modal-lg<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Add Laboratory Staff</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-validation">
                                                                            <form class="form-valide" method="post">
                                                                                <div class="row">
                                                                                    <div class="col-xl-12">
                                                                                        <h6 class="text-muted">Personal Information</h6>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">First Name
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="text" class="form-control" id="val-name" name="first_name" placeholder="Enter First Name.." required>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">Middle Name
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="text" class="form-control" id="val-name" name="middle_name" placeholder="Enter Middle Name..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group row">
                                                                                            <label class="col-lg-2 col-form-label" for="val-name">Last Name
                                                                                                <span class="text-danger">*</span>
                                                                                            </label>
                                                                                            <div class="col-lg-10">
                                                                                                <input type="text" class="form-control" id="val-name" name="last_name" placeholder="Enter First Name.." required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr>
                                                                                        <h6 class="text-muted">Contact Information</h6>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">Email Address
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="email" class="form-control" id="val-name" name="email_address" placeholder="Enter Email Address..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">Home Address
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="text" class="form-control" id="val-name" name="home_address" placeholder="Enter Home Address..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-lg-2 col-form-label" for="val-code">Contact
                                                                                                <span class="text-danger">*</span>
                                                                                            </label>
                                                                                            <div class="col-lg-4">
                                                                                                <select class="form-control" id="val-code" name="contact_code" required>
                                                                                                    <option value="">Code</option>
                                                                                                    <option value="+23230">+23230</option>
                                                                                                    <option value="+23233">+23233</option>
                                                                                                    <option value="+23280">+23280</option>
                                                                                                    <option value="+23288">+23288</option>
                                                                                                    <option value="+23277">+23277</option>
                                                                                                    <option value="+23299">+23290</option>
                                                                                                    <option value="+23299">+23299</option>
                                                                                                    <option value="+23279">+23279</option>
                                                                                                    <option value="+23278">+23278</option>
                                                                                                    <option value="+23276">+23276</option>
                                                                                                    <option value="+23275">+23275</option>
                                                                                                    <option value="+23231">+23231</option>
                                                                                                    <option value="+23231">+23232</option>
                                                                                                    <option value="+23234">+23234</option>
                                                                                                    <option value="+23225">+23225</option>
                                                                                                    <option value="+23221">+23221</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <input type="text" class="form-control" id="val-contactphone" name="contact_number" placeholder="******" required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr>
                                                                                        <h6 class="text-muted">Site Information</h6>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-2 col-form-label" for="val-district">Area
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-10">
                                                                                                        <select class="form-control" id="val-district" name="area" required>
                                                                                                            <option value="">Select Area</option>
                                                                                                            <option value="Donor Reception">Donor Reception</option>
                                                                                                            <option value="Laboratory Reception">Laboratory Reception</option>
                                                                                                            <option value="Counselling">Counselling</option>
                                                                                                            <option value="Main Laboratory">Side and Main Lab
                                                                                                            </option>
                                                                                                            <option value="Bleeding Area">Bleeding Area</option>
                                                                                                            <option value="All">All</option>

                                                                                                        </select>
                                                                                                        <?php
                                                                                                        $id = $_SESSION['userid'];
                                                                                                        $data = mysqli_query($sql_con, "select * from tfs where id = $id");
                                                                                                        $row = mysqli_fetch_array($data);

                                                                                                        $rbtc = $row['rbtc'];
                                                                                                        ?>
                                                                                                        <input type="hidden" class="form-control" id="val-name" value="<?php echo $row['id'] ?>" name="tfs_id" placeholder="Enter Ward..">
                                                                                                        <input type="hidden" value="<?php echo $row['name'] ?>" class="form-control" id="val-name" name="tfs_name" placeholder="Enter Ward..">
                                                                                                        <input type="hidden" value="<?php echo (rand(100, 999999)) ?>" class="form-control" id="val-name" name="randpassword" placeholder="Enter Ward..">
                                                                                                        <input type="hidden" value="<?php echo $row['username'] ?>" class="form-control" id="val-name" name="tfs_username" placeholder="Enter Ward..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>

                                                                                </div>



                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="labtechsubmit" class="btn btn-primary">Add</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="table-responsive">
                                                        <table id="example1" class="display min-w850">
                                                            <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Email</th>
                                                                    <th>Address</th>
                                                                    <th>Contact</th>
                                                                    <th>Area</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $data = mysqli_query($sql_con, "SELECT * FROM labtechnician WHERE tfs_id='$tfs_id' ORDER BY labtechnician.id DESC");
                                                                while ($row = mysqli_fetch_array($data)) {
                                                                ?>
                                                                    <tr>
                                                                        <td nowrap="nowrap"><?php
                                                                                            $space = ' ';
                                                                                            echo $row['first_name'];
                                                                                            echo $space;
                                                                                            echo $row['middle_name'];
                                                                                            echo $space;
                                                                                            echo $row['last_name']; ?></td>
                                                                        <td><?php echo $row['email_address']; ?></td>
                                                                        <td><?php echo $row['home_address']; ?></< /td>
                                                                        <td><?php echo $row['contact_code'];
                                                                            echo $row['contact_number']; ?></< /td>
                                                                        <td><?php echo $row['area']; ?></< /td>
                                                                        <td nowrap="nowrap">
                                                                            <div class="d-flex">
                                                                                <a data-toggle="modal" data-tooltip="tooltip" title="Delete" data-target="#exampleModaldep<?php echo $row['id']; ?>" class="btn btn-danger  sharp mr-1"><i class="fa fa-trash"></i> </a>
                                                                            </div>
                                                                            <!-- MODEL -->
                                                                            <div class="modal fade" id="exampleModaldep<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Laboratory Staff</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            Do you really want to delete <?php $space = ' ';
                                                                                                                            echo $row['first_name'];
                                                                                                                            echo $space;
                                                                                                                            echo $row['middle_name'];
                                                                                                                            echo $space;
                                                                                                                            echo $row['last_name']; ?>
                                                                                            <form class="form-valide" action="" method="post">
                                                                                                <input type="hidden" class="form-control" value="<?php $space = ' ';
                                                                                                                                                    echo $row['firstname'];
                                                                                                                                                    echo $space;
                                                                                                                                                    echo $row['middlename'];
                                                                                                                                                    echo $space;
                                                                                                                                                    echo $row['lastname']; ?>" name="name">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['id'] ?>" name="id">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['date'] ?>" name="date">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['facility'] ?>" name="facility">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['email'] ?>" name="email">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['refcode'] ?>" name="refcode">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['phonenumber'] ?>" name="phonenumber">
                                                                                                <div class="form-group">

                                                                                                </div>
                                                                                                <div class="text-center">
                                                                                                    <button type="submit" name="delete" class="btn btn-danger btn-block" style="font-family: 'Montserrat', sans-serif;">Delete</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile2">
                                <div class="pt-0">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="card" style="box-shadow:none">
                                                <div class="card-body" style="box-shadow:none">
                                                    <div class="d-flex justify-content-end">
                                                        <a href="add_lab.php" class="text-success sharp mr-1">&nbsp;&nbsp;<i class="fa fa-plus"></i> Add M&E</a>
                                                        <div class="modal fade bd-example-modal-lg<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Add M&E Staff</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-validation">
                                                                            <form class="form-valide" method="post">
                                                                                <div class="row">
                                                                                    <div class="col-xl-12">
                                                                                        <h6 class="text-muted">Personal Information</h6>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">First Name
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="text" class="form-control" id="val-name" name="first_name" placeholder="Enter First Name.." required>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">Middle Name
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="text" class="form-control" id="val-name" name="middle_name" placeholder="Enter Middle Name..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group row">
                                                                                            <label class="col-lg-2 col-form-label" for="val-name">Last Name
                                                                                                <span class="text-danger">*</span>
                                                                                            </label>
                                                                                            <div class="col-lg-10">
                                                                                                <input type="text" class="form-control" id="val-name" name="last_name" placeholder="Enter First Name.." required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr>
                                                                                        <h6 class="text-muted">Contact Information</h6>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">Email Address
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="email" class="form-control" id="val-name" name="email_address" placeholder="Enter Email Address..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">Home Address
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="text" class="form-control" id="val-name" name="home_address" placeholder="Enter Home Address..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-lg-2 col-form-label" for="val-code">Contact
                                                                                                <span class="text-danger">*</span>
                                                                                            </label>
                                                                                            <div class="col-lg-4">
                                                                                                <select class="form-control" id="val-code" name="contact_code" required>
                                                                                                    <option value="">Code</option>
                                                                                                    <option value="+23230">+23230</option>
                                                                                                    <option value="+23233">+23233</option>
                                                                                                    <option value="+23280">+23280</option>
                                                                                                    <option value="+23288">+23288</option>
                                                                                                    <option value="+23277">+23277</option>
                                                                                                    <option value="+23299">+23290</option>
                                                                                                    <option value="+23299">+23299</option>
                                                                                                    <option value="+23279">+23279</option>
                                                                                                    <option value="+23278">+23278</option>
                                                                                                    <option value="+23276">+23276</option>
                                                                                                    <option value="+23275">+23275</option>
                                                                                                    <option value="+23274">+23274</option>
                                                                                                    <option value="+23231">+23231</option>
                                                                                                    <option value="+23231">+23232</option>
                                                                                                    <option value="+23234">+23234</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <input type="text" class="form-control" id="val-contactphone" name="contact_number" placeholder="******" required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr>
                                                                                        <h6 class="text-muted">Site Information</h6>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-2 col-form-label" for="val-district">Area
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-10">
                                                                                                        <select class="form-control" id="val-district" name="area" required>
                                                                                                            <option value="">Select Area</option>
                                                                                                            <option value="Donor Reception">Donor Reception</option>
                                                                                                            <option value="Laboratory Reception">Laboratory Reception</option>
                                                                                                            <option value="Counselling">Counselling</option>
                                                                                                            <option value="Main Laboratory">Side and Main Lab
                                                                                                            </option>
                                                                                                            <option value="Bleeding Area">Bleeding Area</option>
                                                                                                            <option value="All">All</option>

                                                                                                        </select>
                                                                                                        <?php
                                                                                                        $id = $_SESSION['userid'];
                                                                                                        $data = mysqli_query($sql_con, "select * from tfs where id = $id");
                                                                                                        $row = mysqli_fetch_array($data);

                                                                                                        $rbtc = $row['rbtc'];
                                                                                                        ?>
                                                                                                        <input type="hidden" class="form-control" id="val-name" value="<?php echo $row['id'] ?>" name="tfs_id" placeholder="Enter Ward..">
                                                                                                        <input type="hidden" value="<?php echo $row['name'] ?>" class="form-control" id="val-name" name="tfs_name" placeholder="Enter Ward..">
                                                                                                        <input type="hidden" value="<?php echo (rand(100, 999999)) ?>" class="form-control" id="val-name" name="randpassword" placeholder="Enter Ward..">
                                                                                                        <input type="hidden" value="<?php echo $row['username'] ?>" class="form-control" id="val-name" name="tfs_username" placeholder="Enter Ward..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>

                                                                                </div>



                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="labtechsubmit" class="btn btn-primary">Add</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="table-responsive">
                                                        <table id="example2" class="display min-w850">
                                                            <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Email</th>
                                                                    <th>Address</th>
                                                                    <th>Contact</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $data = mysqli_query($sql_con, "SELECT * FROM mne WHERE tfs_id='$tfs_id' ORDER BY mne.id DESC");
                                                                while ($row = mysqli_fetch_array($data)) {
                                                                ?>
                                                                    <tr>
                                                                        <td nowrap="nowrap"><?php
                                                                                            $space = ' ';
                                                                                            echo $row['first_name'];
                                                                                            echo $space;
                                                                                            echo $row['middle_name'];
                                                                                            echo $space;
                                                                                            echo $row['last_name']; ?></td>
                                                                        <td><?php echo $row['email_address']; ?></td>
                                                                        <td><?php echo $row['home_address']; ?></< /td>
                                                                        <td><?php echo $row['contact_code'];
                                                                            echo $row['contact_number']; ?></< /td>
                                                                        <td nowrap="nowrap">
                                                                            <div class="d-flex">
                                                                                <a data-toggle="modal" data-tooltip="tooltip" title="Delete" data-target="#exampleModaldep<?php echo $row['id']; ?>" class="btn btn-danger  sharp mr-1"><i class="fa fa-trash"></i> </a>
                                                                            </div>
                                                                            <!-- MODEL -->
                                                                            <div class="modal fade" id="exampleModaldep<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete M&E Staff</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            Do you really want to delete <?php $space = ' ';
                                                                                                                            echo $row['first_name'];
                                                                                                                            echo $space;
                                                                                                                            echo $row['middle_name'];
                                                                                                                            echo $space;
                                                                                                                            echo $row['last_name']; ?>
                                                                                            <form class="form-valide" action="" method="post">
                                                                                                <input type="hidden" class="form-control" value="<?php $space = ' ';
                                                                                                                                                    echo $row['firstname'];
                                                                                                                                                    echo $space;
                                                                                                                                                    echo $row['middlename'];
                                                                                                                                                    echo $space;
                                                                                                                                                    echo $row['lastname']; ?>" name="name">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['id'] ?>" name="id">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['date'] ?>" name="date">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['facility'] ?>" name="facility">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['email'] ?>" name="email">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['refcode'] ?>" name="refcode">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['phonenumber'] ?>" name="phonenumber">
                                                                                                <div class="form-group">

                                                                                                </div>
                                                                                                <div class="text-center">
                                                                                                    <button type="submit" name="delete" class="btn btn-danger btn-block" style="font-family: 'Montserrat', sans-serif;">Delete</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile3">
                                <div class="pt-0">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="card" style="box-shadow:none">

                                                <div class="card-body" style="box-shadow:none">
                                                    <div class="d-flex justify-content-end">
                                                        <a href="add_guestuser.php" class="text-success sharp mr-1">&nbsp;&nbsp;<i class="fa fa-plus"></i> Add Guest User</a>
                                                        <div class="modal fade bd-example-modal-lg<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Add Guest User</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-validation">
                                                                            <form class="form-valide" method="post">
                                                                                <div class="row">
                                                                                    <div class="col-xl-12">
                                                                                        <h6 class="text-muted">Personal Information</h6>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">First Name
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="text" class="form-control" id="val-name" name="first_name" placeholder="Enter First Name.." required>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">Middle Name
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="text" class="form-control" id="val-name" name="middle_name" placeholder="Enter Middle Name..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group row">
                                                                                            <label class="col-lg-2 col-form-label" for="val-name">Last Name
                                                                                                <span class="text-danger">*</span>
                                                                                            </label>
                                                                                            <div class="col-lg-10">
                                                                                                <input type="text" class="form-control" id="val-name" name="last_name" placeholder="Enter First Name.." required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr>
                                                                                        <h6 class="text-muted">Contact Information</h6>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">Email Address
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="email" class="form-control" id="val-name" name="email_address" placeholder="Enter Email Address..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-4 col-form-label" for="val-name">Home Address
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-8">
                                                                                                        <input type="text" class="form-control" id="val-name" name="home_address" placeholder="Enter Home Address..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-lg-2 col-form-label" for="val-code">Contact
                                                                                                <span class="text-danger">*</span>
                                                                                            </label>
                                                                                            <div class="col-lg-4">
                                                                                                <select class="form-control" id="val-code" name="contact_code" required>
                                                                                                    <option value="">Code</option>
                                                                                                    <option value="+23230">+23230</option>
                                                                                                    <option value="+23233">+23233</option>
                                                                                                    <option value="+23280">+23280</option>
                                                                                                    <option value="+23288">+23288</option>
                                                                                                    <option value="+23277">+23277</option>
                                                                                                    <option value="+23299">+23290</option>
                                                                                                    <option value="+23299">+23299</option>
                                                                                                    <option value="+23279">+23279</option>
                                                                                                    <option value="+23278">+23278</option>
                                                                                                    <option value="+23276">+23276</option>
                                                                                                    <option value="+23275">+23275</option>
                                                                                                    <option value="+23274">+23274</option>
                                                                                                    <option value="+23231">+23231</option>
                                                                                                    <option value="+23231">+23232</option>
                                                                                                    <option value="+23234">+23234</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <input type="text" class="form-control" id="val-contactphone" name="contact_number" placeholder="******" required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr>
                                                                                        <!-- <h6 class="text-muted">Site Information</h6>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col-lg-2 col-form-label" for="val-district">Grant Acces TO
                                                                                                        <span class="text-danger">*</span>
                                                                                                    </label>
                                                                                                    <div class="col-lg-10">
                                                                                                        <select class="form-control" id="val-district" name="area" required>
                                                                                                            <option value="">Select Area</option>
                                                                                                            <option value="Donor Reception">Donor Reception</option>
                                                                                                            <option value="Laboratory Reception">Laboratory Reception</option>
                                                                                                            <option value="Counselling">Counselling</option>
                                                                                                            <option value="Main Laboratory">Side and Main Lab
                                                                                                            </option>
                                                                                                            <option value="Bleeding Area">Bleeding Area</option>
                                                                                                            <option value="All">All Funtionality</option>

                                                                                                        </select>
                                                                                                        <?php
                                                                                                        $id = $_SESSION['userid'];
                                                                                                        $data = mysqli_query($sql_con, "select * from tfs where id = $id");
                                                                                                        $row = mysqli_fetch_array($data);

                                                                                                        $rbtc = $row['rbtc'];
                                                                                                        ?>
                                                                                                        <input type="hidden" class="form-control" id="val-name" value="<?php echo $row['id'] ?>" name="tfs_id" placeholder="Enter Ward..">
                                                                                                        <input type="hidden" value="<?php echo $row['name'] ?>" class="form-control" id="val-name" name="tfs_name" placeholder="Enter Ward..">
                                                                                                        <input type="hidden" value="<?php echo (rand(100, 999999)) ?>" class="form-control" id="val-name" name="randpassword" placeholder="Enter Ward..">
                                                                                                        <input type="hidden" value="<?php echo $row['username'] ?>" class="form-control" id="val-name" name="tfs_username" placeholder="Enter Ward..">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> -->

                                                                                    </div>

                                                                                </div>



                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="labtechsubmit" class="btn btn-primary">Add</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="table-responsive">
                                                        <table id="example3" class="display min-w850">
                                                            <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Email</th>
                                                                    <th>Address</th>
                                                                    <th>Contact</th>
                                                                    <!-- <th>Area</th> -->
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $data = mysqli_query($sql_con, "SELECT * FROM guestuser WHERE tfs_id='$tfs_id' ORDER BY labtechnician.id DESC");
                                                                while ($row = mysqli_fetch_array($data)) {
                                                                ?>
                                                                    <tr>
                                                                        <td nowrap="nowrap"><?php
                                                                                            $space = ' ';
                                                                                            echo $row['first_name'];
                                                                                            echo $space;
                                                                                            echo $row['middle_name'];
                                                                                            echo $space;
                                                                                            echo $row['last_name']; ?></td>
                                                                        <td><?php echo $row['email_address']; ?></td>
                                                                        <td><?php echo $row['home_address']; ?></td>
                                                                        <td><?php echo $row['contact_code'];
                                                                            echo $row['contact_number']; ?></td>
                                                                        <!-- <td><?php echo $row['area']; ?></td> -->
                                                                        <td nowrap="nowrap">
                                                                            <div class="d-flex">
                                                                                <a data-toggle="modal" data-tooltip="tooltip" title="Delete" data-target="#exampleModaldep<?php echo $row['id']; ?>" class="btn btn-danger  sharp mr-1"><i class="fa fa-trash"></i> </a>
                                                                            </div>
                                                                            <!-- MODEL -->
                                                                            <div class="modal fade" id="exampleModaldep<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Laboratory Staff</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            Do you really want to delete <?php $space = ' ';
                                                                                                                            echo $row['first_name'];
                                                                                                                            echo $space;
                                                                                                                            echo $row['middle_name'];
                                                                                                                            echo $space;
                                                                                                                            echo $row['last_name']; ?>
                                                                                            <form class="form-valide" action="" method="post">
                                                                                                <input type="hidden" class="form-control" value="<?php $space = ' ';
                                                                                                                                                    echo $row['firstname'];
                                                                                                                                                    echo $space;
                                                                                                                                                    echo $row['middlename'];
                                                                                                                                                    echo $space;
                                                                                                                                                    echo $row['lastname']; ?>" name="name">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['id'] ?>" name="id">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['date'] ?>" name="date">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['facility'] ?>" name="facility">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['email'] ?>" name="email">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['refcode'] ?>" name="refcode">
                                                                                                <input type="hidden" class="form-control" value="<?php echo $row['phonenumber'] ?>" name="phonenumber">
                                                                                                <div class="form-group">

                                                                                                </div>
                                                                                                <div class="text-center">
                                                                                                    <button type="submit" name="delete" class="btn btn-danger btn-block" style="font-family: 'Montserrat', sans-serif;">Delete</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
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
            </div>
        </div>


    </div>

</div>
<!--**********************************
            Content body end
        ***********************************-->


<!--**********************************
            Footer start
        ***********************************-->

<div class="footer">
    <div class="copyright">
        <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">AutoHealth</a> 2022</p>
    </div>
</div>



</div>







<script src="public/vendor/global/global.min.js" type="text/javascript"></script>
<script src="public/vendor/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="public/js/plugins-init/datatables.init.js" type="text/javascript"></script>
<script src="public/vendor/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="public/vendor/datatables/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="public/vendor/datatables/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
<script src="public/vendor/datatables/js/jszip.min.js" type="text/javascript"></script>
<script src="public/vendor/datatables/pdfmake/pdfmake.min.js" type="text/javascript"></script>
<script src="public/vendor/datatables/pdfmake/vfs_fonts.js" type="text/javascript"></script>
<script src="public/vendor/datatables/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="public/vendor/datatables/js/buttons.print.min.js" type="text/javascript"></script>
<script src="public/vendor/datatables/js/buttons.colVis.min.js" type="text/javascript"></script>
<script src="public/js/custom.min.js" type="text/javascript"></script>
<script src="public/js/deznav-init.js" type="text/javascript"></script>
<script>
    $('[data-tooltip="tooltip"]').tooltip();
</script>
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            // lengthChange: false,
            dom: 'Bfrtip',
            destroy: true,
            buttons: ['csv', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#example1').DataTable({
            // lengthChange: false,
            dom: 'Bfrtip',
            buttons: ['csv', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable({
            // lengthChange: false,
            dom: 'Bfrtip',
            buttons: ['csv', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#example3').DataTable({
            // lengthChange: false,
            dom: 'Bfrtip',
            buttons: ['csv', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
</script>

</body>

</html>