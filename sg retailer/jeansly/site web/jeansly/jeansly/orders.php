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
   <title>COMMANDES</title>
   <link rel="icon" type="image/x-icon" href="images/jeansv.jpeg">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">COMMANDES PASSÉES</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <?php
   $liv=$fetch_orders['total_price'];
   $liv+=8;
   ?>
   <div class="box">
      <p> placé : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> methode de payment : <span><?= $fetch_orders['method']; ?></span> </p>
      <p> vos commandes : <span><?= $fetch_orders['total_products']; ?></span> </p>

      <p> prix  <span> : <?= $fetch_orders['total_price'];  ?> dt</span> + 8 dt livraison</p>
      <p> prix totale <span> : <?= $liv;  ?> dt</span></p>
      <p> état du commonde : <span style="color:<?php if($fetch_orders['payment_status'] == 'en attendant'){ echo 'red'; }elseif($fetch_orders['payment_status'] == 'confirmé'){ echo 'orange'; } elseif($fetch_orders['payment_status'] == 'branch Mestir'){ echo 'blue'; }elseif($fetch_orders['payment_status'] == 'A_été_reçu'){ echo 'green'; } else{ echo 'brown'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no orders placed yet!</p>';
   }
   ?>

   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>