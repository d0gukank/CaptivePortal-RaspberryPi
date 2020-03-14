<?php include_once ("config/config.php"); ?>
  
 <?php
if (isset($_POST["email"]) && isset($_POST["password"]))
{
    $errMsg = '';
    // Get data from FORM
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($username == '') $errMsg = 'Enter username';
    if ($password == '') $errMsg = 'Enter password';
    $sql = "SELECT * FROM users_cap WHERE email = :email";
    $stmt = $conn->prepare($sql);
    //Bind value.
    $stmt->bindValue(':email', $email);
    //Execute.
    $stmt->execute();
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $user['id'];
    //If $row is FALSE.
    if ($user === false)
    {
        echo "<script>alert('Incorrect username / password combination!')</script>";
    }
    else
    {
        $validPassword = password_verify($password, $user['password']);
        if ($validPassword)
        {
            // valid login
            if ($user['user_online'] == 0)
            {
                echo "<script>alert('loginnnnnn sucses')</script>";
                //update ip and mac addres
                $arp = "/usr/sbin/arp"; // Attempt to get the client's mac address
                $mac = shell_exec("$arp -a " . $_SERVER['REMOTE_ADDR']);
                preg_match('/..:..:..:..:..:../', $mac, $matches);
                $macx = $matches[0];
                $date = date('Y-m-d H:i:s');
                $sql1 = "UPDATE `users_cap`   
   			SET `ipaddress` = :ipaddress,
       		        `macaddress` = :macaddress,
       			`lastlogin` = :lastlogin,
			`user_online` = :user_online
 			 WHERE `id` = :id";

                $statement = $conn->prepare($sql1);
                $statement->bindValue(":ipaddress", $_SERVER['REMOTE_ADDR']);
                $statement->bindValue(":macaddress", $macx);
                $statement->bindValue(":lastlogin", $date);
                $statement->bindValue(":user_online", '1');
                $statement->bindValue(":id", $id);
                $count = $statement->execute();
                // Reconnect the device to the firewall
                //exec("sudo rmtrack " . $_SERVER['REMOTE_ADDR']);
                //$i = "sudo iptables -t mangle -A wlan0_Outgoing  -m mac --mac-source ".$macx." -j MARK --set-mark 2";
                //exec($i);
                //sleep(1);
                
            }
            else
            {
                echo "<script>alert('sadece bir cihazla wifi baglanabilrisiniz')</script>";
            }

        }
        else
        {
            // invalid password
            echo "<script>alert('Incorrect username / password combination!')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V16</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" action="" method="post">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="email" placeholder="User name">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>

