<?php

@include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['add_to_wishlist'])){
   if($user_id == ''){
      header('location:login.php');
   }else{
		

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'already added to wishlist!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'added to wishlist!';
   }

}
}

if(isset($_POST['add_to_cart'])){
	if ($user_id==''){
		header('location:login.php');
	}else{

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'added to cart!';
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
   <title>APERÇU RAPIDE</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/css1.css">
   <link rel="stylesheet" href="css/a/style.css">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="quick-view">

   <h1 class="title">APERÇU RAPIDE</h1>

   <?php
      $pid = $_GET['pid'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$pid]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">TND : <span><?= $fetch_products['price']; ?></span></div>
       	    <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
            </div>
            <div class="sub-image">
               <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
               <img src="uploaded_img/<?= $fetch_products['image_02']; ?>" alt="">
			   <img src="uploaded_img/<?= $fetch_products['image_03']; ?>" alt="">

            </div>
         </div>
      <div class="name"><?= $fetch_products['name'].':'; ?></div><br>
      <div class="details"><?= $fetch_products['details']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <input type="hidden" name="p_image_02" value="<?= $fetch_products['image_02']; ?>">
	  <input type="hidden" name="p_image_03" value="<?= $fetch_products['image_03']; ?>">
	  

	  
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="❤️ ajouter à la liste de souhaits" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="🛒 Ajouter au panier" class="btn" name="add_to_cart">
	  
	  
	  
	  
	  
	  
	  
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>




   

</section>

<div class="home-category">
<section class="products">

    <h1 class="title">Produits apparentés</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
       <div class="box-container">
	   <div class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_product['image']; ?>">
	  <input type="hidden" name="p_stock" value="<?= $fetch_product['stock']; ?>">

      <a href="view_page.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
	  <div class="stock">
	  <p> état du stock : <span style="color:<?php if($fetch_product['stock'] == 'En stock'){ echo 'green'; }elseif($fetch_product['stock'] == 'proche'){ echo 'orange'; }  else{ echo 'red'; }; ?>"><?= $fetch_product['stock']; ?></span> </p>
	  
	  </div>
      <div class="flex">
         <div class="price"><span></span><?= $fetch_product['price']; ?><span> :DT</span></div>
         <input type="number" name="p_qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
	        <input type="submit" value=" ❤️ ajouter à la liste de souhaits "  class="option-btn" name="add_to_wishlist"> 
      <input type="submit" value=" 🛒 Ajouter au panier" class="btn" name="add_to_cart">
	  </div>
	  </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">aucun produit ajouté pour le moment !</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div><br><br>

   </div>

</section>
</div>





<?php include 'footer.php'; ?>

<script src="js/a/script.js"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>
</body>
</html>