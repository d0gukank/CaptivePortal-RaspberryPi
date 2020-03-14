<?php
$arp = "/usr/sbin/arp"; // Attempt to get the client's mac address
$mac = shell_exec("$arp -a ".$_SERVER['REMOTE_ADDR']);
preg_match('/..:..:..:..:..:../',$mac , $matches);
$macx = $matches[0];

// Reconnect the device to the firewall
exec("sudo rmtrack " . $_SERVER['REMOTE_ADDR']);
$i = "sudo iptables -t mangle -A wlan0_Outgoing  -m mac --mac-source ".$macx." -j MARK --set-mark 2";
exec($i);

sleep(1);
?>
