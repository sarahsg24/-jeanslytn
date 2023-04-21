<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_order'])){

   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
   $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_orders->execute([$update_payment, $order_id]);
   $message[] = 'payment has been updated!';

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_orders->execute([$delete_id]);
   header('location:admin_orders.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
      ?>
	     <?php
   $liv=$fetch_orders['total_price'];
   $liv+=8;
   ?>
      <div class="box">
         <p> user id : <span><?= $fetch_orders['user_id']; ?></span> </p>
         <p> placé : <span><?= $fetch_orders['placed_on']; ?></span> </p>
         <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
         <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
         <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
         <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
         <p> commonde : <span><?= $fetch_orders['total_products']; ?></span> </p>
         <p> prix  <span>: <?= $fetch_orders['total_price']; ?> TND</span> + 8dt livraison </p>
		 <p> prix totale <span> : <?= $liv;  ?> dt</span></p>
         <p> statut de paiement : <span><?= $fetch_orders['method']; ?></span> </p>
         <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
            <select name="update_payment" class="drop-down">
               <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
               <option value="en attendant">en attendant</option>
               <option value="confirmé">confirmé</option>
			   <option value="branch Mestir">branch Mestir</option>
			   <option value="sur le chemin de votre branch">sur le chemin de votre branch</option>
			   <option value="branch TUNIS">branch TUNIS</option>
			   <option value="branch Bizarte">branch Bizarte</option>
			   <option value="branch Mestir">branch BEJA</option>
			   <option value="branch BEN AROUS">branch BEN AROUS</option>
			   <option value="branch ARIANA">branch ARIANA</option>
			   <option value="branch NABEUL">branch NABEUL</option>
			   <option value="branch MESTIR">branch MESTIR</option>
			   <option value="branch SOUSE">branch SOUSE</option>
			   <option value="branch SFAX">branch SFAX</option>
			   <option value="branch GABES">branch GABES </option>
			   <option value="branch SIDI BOUZID">branch SIDI BOUZID </option>
			   <option value="branch GAFSA">branch GAFSA</option>
			   <option value="branch TOUZER ">branch TOUZER </option>
			   <option value="branch TATWIN ">branch TATWIN </option>
			   <option value="branch DJERBA">branch DJERBA </option>
			   <option value="branch MEDNIN">branch MEDNIN </option>
			   <option value="branch JANDOUBA">branch JANDOUBA</option>
			   <option value="branch ZAGHWAN">branch ZAGHWAN </option>
			   <option value="branch SILYANA">branch SILYANA</option>
			   <option value="branch GBELI">branch GBELI</option>
			   <option value="branch GASRIN">branch GASRIN</option>
			   <option value="branch KAIRAWAN">branch KAIRAWAN</option>
			   <option value="branch MAHDIYA">branch MAHDIYA</option>
			   <option value="branch MANOUBA">branch MANOUBA</option>
			   <option value="A_été_reçu">A été reçu</option>
            </select>
            <div class="flex-btn">
               <input type="submit" name="update_order" class="option-btn" value="udate">
               <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
            </div>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>

   </div>

</section>












<script src="js/script.js"></script>

</body>
</html>