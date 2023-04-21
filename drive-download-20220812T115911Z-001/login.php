<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){
    $secret="6LcsumQhAAAAAAyqpFNi_alBjndyOIcg-cHYIO-D";
    $response= $_POST["g-recaptcha-response"];
    $remoteip=$_SERVER['REMOTE_ADDR'];
    $url="https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    $data= file_get_contents($url);
    $row=json_decode($data, true);

    if($row['success']=='true'){
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = md5($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email, $pass]);
        $rowCount = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rowCount > 0){
            if($row['user_type'] == 'admin'){
                $_SESSION['admin_id'] = $row['id'];
                header('location:admin_page.php');
            }elseif($row['user_type'] == 'user'){
                $_SESSION['user_id'] = $row['id'];
                header('location:index.php');
            }else{
                $message[] = 'aucun utilisateur trouvé !';
            }
        }else{
            $message[] = 'email ou mot de passe incorrect!';
        }



    }else{
        echo "<script>alert('vérifier le captcha !');</script>";
    }


   
 

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>connexion</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/components.css">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>
   
<section class="form-container">

   <form action="" method="POST">
      <h3>se connecter maintenant</h3>
      <input type="email" name="email" class="box" placeholder="entrer votre Email" required>
      <input type="password" name="pass" class="box" placeholder="saisissez votre mot de passe" required>
      <div class="g-recaptcha" data-sitekey="6LcsumQhAAAAAEDUfXH0DhPicGh6geT95z2akTOS"></div>
      <input type="submit" value="se connecter" class="btn" name="submit">
      <p>je n'ai pas de compte? <a href="register.php">S'inscrire maintenant</a></p>
   </form>

</section>


</body>
</html>