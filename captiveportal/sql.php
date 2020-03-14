
<?php include_once("config/config.php");
  
$email='seli@gmail.com';



    $sql = "SELECT * FROM users_cap WHERE email = :email";
    $stmt = $conn->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':email', $email);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
    if($user === false){
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        die('Incorrect username / password combination!');
    } else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.
        
	echo  $user['password'].'<br>'. $user['phone'];}
?>
