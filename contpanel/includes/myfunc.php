<?php

if(isset($_POST['domain'])){
 $d=$_POST['domain'];
 if (preg_match('/^([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $d)){
 system('sudo iptables -I FORWARD -p tcp --dport 443 -m string --string '. $d . ' --algo bm --to 65535 -j DROP');
 system('sudo iptables -I FORWARD -p tcp --dport 80 -m string --string '. $d . ' --algo bm --to 65535 -j DROP');
 $r="sudo iptables -I FORWARD -p tcp --dport 80 443 -m string --string ". $d ." --algo bm --to 65535 -j DROP";
 $statement = $conn->prepare("INSERT INTO domain_rule(block, rule)
     VALUES(?, ?)");
 $statement->execute(array($d,$r));}
 else{ echo "<script>alert('Hata Domain')</script>";}
}









if(isset($_POST['ip'])){
 $i=$_POST['ip'];
 $valid_i = filter_var($i, FILTER_VALIDATE_IP);
 if($valid_i == true){system('sudo iptables -A INPUT -s '.$i.' -j DROP');}
}

if(isset($_POST['mac'])){
 $m=$_POST['mac'];
 $valid_m = filter_var($m, FILTER_VALIDATE_MAC);
 if($valid_m == true){system('sudo iptables -A INPUT -s '.$m.' -j DROP');}
}


?>
