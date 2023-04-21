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

<header class="header">

   <div class="flex">
   <div class="icons">
   <div id="menu-btn" class="fas fa-bars"></div>
   </div>
   <div class="flex">

      <img src="images/loga.png" alt="Girl in a jacket" width="125" height="50">
	  </div>
	  


      <nav class="navbar">
         <a href="index.php">ACCEUIL</a>
         <a href="homme.php?hf=homme">HOMME</a>
		 <a href="femme.php?hf=femme">FEMME</a>
         <a href="ENFANT.php?hf=ENFANT">ENFANTS</a>
      </nav>
		<section class="search-form">

	<form action="search_page.php" method="POST" class="example">
      <input type="text" class="box" name="search_box" placeholder="Recherche de produits...">
	  <button type="submit" name="search_btn" ><i class="fa fa-search"></i></button>
               <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
         ?>

         <a href="wishlist.php"><i class="fa-solid fa-heart"></i><span>(<?= $count_wishlist_items->rowCount(); ?>)</span></a>
         <a href="cart.php"><i class="fa-solid fa-bag-shopping"></i><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
  


   </form>

</section>
      <div class="icons">
	  
         
         <div id="user-btn" class="fa-solid fa-address-card"></div>

         		

		 



 

         
      </div>
	  

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>

         

		<?php 
         session_start();
         if(empty($_SESSION['user_id'])){
        ?>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">connexion</a>
            <a href="register.php" class="option-btn">S'inscrire</a>
         </div>
         <?php }
          else { ?>
          <a href="user_profile_update.php" class="btn">⚙️ Parametre</a>
          <a href="orders.php" class="btn">📦Mes commandes</a>
          <a href="logout.php" class="delete-btn">🚪 Se déconnecter</a>
          
          <?php } ?>
      </div>
      

   </div>

</header>