<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_product'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $stock = $_POST['stock'];
   $stock = filter_var($stock, FILTER_SANITIZE_STRING);
   $hf = $_POST['hf'];
   $hf = filter_var($hf, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   $old_image = $_POST['old_image'];

   $update_product = $conn->prepare("UPDATE `products` SET name = ?,hf = ?, category = ?, stock = ?, details = ?, price = ? WHERE id = ?");
   $update_product->execute([$name,$hf, $category, $stock, $details, $price, $pid]);

   $message[] = 'product updated successfully!';

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{

         $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $pid]);

         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('uploaded_img/'.$old_image);
            $message[] = 'image updated successfully!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="update-product">

   <h1 class="title">update product </h1>   

   <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <input type="text" name="name" placeholder="enter product name" required class="box" value="<?= $fetch_products['name']; ?>">
      <input type="number" name="price" min="0" placeholder="enter product price" required class="box" value="<?= $fetch_products['price']; ?>" step="0.01">
      <select name="category" class="box" required>
         <option selected><?= $fetch_products['category']; ?> </option>
               <option value="T_shirts">T_shirts</option>
               <option value="Chemise">Chemise</option>
               <option value="Blouson">Blouson</option>
               <option value="Pantalon">Pantalon</option>
			   <option value="Jeans">Jeans</option>
			   <option value="Pull">Pull</option>
			   <option value="Chaussures">Chaussures</option>
			   <option value="Boxer_de_bain">Boxer_de_bain</option>
			   <option value="robe">robe</option>
      </select>
	  
	           <select name="stock" class="box" required>
            <option value="" selected disabled>select disponbité</option>
               <option value="En stock">En stock</option>
               <option value="proche">proche</option>
               <option value="rupture stock">rupture stock</option>

         </select>
		 
		 		<select name="hf" class="box" required>
					<option value="" selected disabled>select H/F</option>
					<option value="homme">homme</option>
					<option value="femme">femme</option>
				</select>
      <textarea name="details" required placeholder="enter product details" class="box" cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
	
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
	  <!--  <input type="file" name="image_02" class="box" accept="image/jpg, image/jpeg, image/png">  
	  <input type="file" name="image_03" class="box" accept="image/jpg, image/jpeg, image/png">
-->
      <div class="flex-btn">
         <input type="submit" class="btn" value="update product" name="update_product">
         <a href="admin_products.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products found!</p>';
      }
   ?>

</section>
























<section class="update-product">

   <h1 class="title">update product category for HOMME ! </h1>   

   <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <select name="category" class="box" required>
            <option value="" selected disabled>select category H</option>
               <option value="PULLS1">PULLS & PULL-OVER</option>
               <option value="M&V1">MANTEAUX & VESTES</option>
               <option value="GILETS1">GILETS</option>
               <option value="POLOS1">POLOS</option>
			   <option value="CHEMISES1">CHEMISES</option>
			   <option value="TD1">T-SHIRTS & DéBARDEURS</option>
			   <option value="SHORT1">SHORTS & BERMUDAS</option>
			   <option value="MAILLOT1">MAILLOT DE BAIN</option>
			   <option value="SWEAT1">SWEAT & SWEAT-SHIRTS</option>
			   <option value=">PYJAMAS1">PYJAMAS</option>
			   <option value="PANTALONS1">PANTALONS</option>
			   <option value="JEANS1">JEANS</option>
         </select>
	  

	
      <div class="flex-btn">
         <input type="submit" class="btn" value="update product" name="update_product">
         <a href="admin_products.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products found!</p>';
      }
   ?>

</section>

















<section class="update-product">

   <h1 class="title">update product category for FEMME ! </h1>   

   <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <select name="category" class="box" required>
            <option value="" selected disabled>select category f</option>
               <option value="CHEMISES">CHEMISES & CHEMISIERS</option>
               <option value="TOPS">TOPS & T-SHIRTS</option>
               <option value="GILETS">GILETS</option>
               <option value="BLOUSES">BLOUSES</option>
			   <option value="M&V">MANTEAUX & VESTES</option>
			   <option value="COMBINAISONS">COMBINAISONS</option>
			   <option value="MAILLOT">MAILLOT DE BAIN</option>
			   <option value="SHORTS">SHORTS</option>
			   <option value="PPO">PULLS & PULL-OVERS</option>
			   <option value=">SCS">SWEATS a CAPUCHE & SWEATSHIRTS</option>
			   
			   <option value="JEANS">JEANS</option>
			   <option value="PANTALONS">PANTALONS</option>
			   <option value="ROBES">ROBES</option>
			   <option value="JUPES">JUPES</option>
			   <option value="PYJAMAS">PYJAMAS</option>
         </select>

	  

	
      <div class="flex-btn">
         <input type="submit" class="btn" value="update product" name="update_product">
         <a href="admin_products.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products found!</p>';
      }
   ?>

</section>









<script src="js/script.js"></script>

</body>
</html>