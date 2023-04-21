<?php

include 'config.php';

$char="AZERTYUIOPMLKJHGFDSQWXCVBN123456789";
$genn= substr(str_shuffle($char),0,1);
$genn1= substr(str_shuffle($char),0,1);
$genn2= substr(str_shuffle($char),0,1);
$genn3= substr(str_shuffle($char),0,1);
$random=$genn.$genn1.$genn2.$genn3;

if(isset($_POST['submit'])){
   $secret="6LcsumQhAAAAAAyqpFNi_alBjndyOIcg-cHYIO-D";
   $response=$_POST['g-recaptcha-response'];
   $remoteip = $_SERVER['REMOTE_ADDR'];
   $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
   $data = file_get_contents($url);
   $row = json_decode($data, true);
   if ($row['success'] == "true") {
	   $name = $_POST['name'];
	   $name = filter_var($name, FILTER_SANITIZE_STRING);
	   $email = $_POST['email'];
	   $email = filter_var($email, FILTER_SANITIZE_STRING);
	   $pass = md5($_POST['pass']);
	   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
	   $cpass = md5($_POST['cpass']);
	   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
	   $image = $_FILES['image']['name'];
	   $image = filter_var($image, FILTER_SANITIZE_STRING);
	   $image_size = $_FILES['image']['size'];
	   $image_tmp_name = $_FILES['image']['tmp_name'];
	   $image_folder = 'uploaded_img/'.$image;
	   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
	   $select->execute([$email]);
	   if($select->rowCount() > 0){
		   $message[] = 'l adresse email de l utilisateur existe déjà';
		   }else{
			   if($pass != $cpass){
				   $message[] = 'confirmer que le mot de passe ne correspond pas!';
				   }else{
					   $insert = $conn->prepare("INSERT INTO `users`(name, email, password, image) VALUES(?,?,?,?)");
					   $insert->execute([$name, $email, $pass, $image]);
					   if($insert){
						   if($image_size > 2000000){
							   $message[] = 'la taille de l image est trop grande!';
							   }else{
								   move_uploaded_file($image_tmp_name, $image_folder);
								   $message[] = 'enregistré avec succès!';
								   header('location:login.php');
							   }
					   }
				   }
		   }
   }else{
	   echo '<script>alert("vérifier le captcha !"); </script>';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>S'inscrire</title>

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

   <form action="" enctype="multipart/form-data" method="POST">
      <h3>S'inscrire maintenant</h3>
      <input type="text" name="name" class="box" placeholder="saisissez votre nom" required>
      <input type="email" name="email" class="box" placeholder="entrez votre email" required>
      <input type="password" name="pass" class="box" placeholder="tapez votre mot de passe" required>
      <input type="password" name="cpass" class="box" placeholder="confirmer votre mot de passe" required>
      <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
      <div class="g-recaptcha" data-sitekey="6LcsumQhAAAAAEDUfXH0DhPicGh6geT95z2akTOS"></div>
      <input type="submit" value="S'inscrire" class="btn" name="submit">
      <p>Vous avez déjà un compte? <a href="login.php">se connecter maintenant</a></p>
   </form>

</section>


</body>
</html>
<style>
    .captcha_style
    {
        background-color:red;
        color:black;
        padding: 6 7 6 7;
        font-family: 'arial'
    }
</style>