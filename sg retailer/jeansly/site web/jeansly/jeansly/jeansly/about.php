<?php

@include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>À propos de</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <h3>Pourquoi nous choisir?</h3>
         <p>Nous expédions avec des transporteurs rapides réputés./nous assurons le suivi de toutes les commandes.</p>
         <a href="contact.php" class="btn">contact nous</a>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <h3>ce que nous fournissons?</h3>
         <p>de beaux bijoux... .</p>
         <a href="shop.php" class="btn">nos boutique</a>
      </div>

   </div>

</section>











<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>