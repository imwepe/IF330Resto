<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>



<section class="hero">

   <div class="swiper hero-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="content">
               <span>Welcome</span>
               <h3>To Our Restaurant</h3>
               <a href="menu.php" class="btn">See Menu</a>
            </div>
            <div class="image">
               <img src="images/slider-1.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>We Serve</span>
               <h3>Lot of Delicious Foods</h3>
               <a href="menu.php" class="btn">See Menu</a>
            </div>
            <div class="image">
               <img src="images/slider-2.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>Let's</span>
               <h3>Check Our Menu</h3>
               <a href="menu.php" class="btn">See Menu</a>
            </div>
            <div class="image">
               <img src="images/slider-3.png" alt="">
            </div>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>


<section class="category">
   <div data-aos="fade-down">   
      <h1 class="title">food category</h1>
   </div>

   <div class="box-container">
      <div data-aos="fade-up"
      data-aos-duration="1000">
         <a href="category.php?category=Appetizer" class="box">
            <img src="images/appetizer.png" alt="">
            <h3>Appetizer</h3>
         </a>
      </div>
      
      <div data-aos="fade-up"
      data-aos-duration="1500">
         <a href="category.php?category=Seafood" class="box">
            <img src="images/seafood.png" alt="">
            <h3>Seafood</h3>
         </a>
      </div>
      <div data-aos="fade-up" data-aos-duration="2000">
         <a href="category.php?category=Traditional" class="box">
            <img src="images/course.png" alt="">
            <h3>Traditional Food</h3>
         </a>
      </div>
      
      <div data-aos="fade-up"
      data-aos-duration="2500">
         <a href="category.php?category=Drinks" class="box">
            <img src="images/cat-3.png" alt="">
            <h3>drinks</h3>
         </a>
      </div>
      <div data-aos="fade-up"
         data-aos-duration="3000">
         <a href="category.php?category=Desserts" class="box">
            <img src="images/cat-4.png" alt="">
            <h3>desserts</h3>
         </a>
      </div>
   </div>



</section>




<section class="products">

   <h1 class="title" data-aos="fade-down">latest dishes</h1>

   <div class="box-container" data-aos="fade-down-right">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="desc"><?= $fetch_products['description']; ?></div>
         <div class="flex">
            <div class="price"><span>Rp</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="menu.php" class="btn">View All</a>
   </div>

</section>




<?php include 'components/footer.php'; ?>



<!-- custom js file link  -->
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>

// var swiper = new Swiper(".hero-slider", {
//    loop: true, // Note the correction here
//    grabCursor: true,
//    effect: "autopla",
//    pagination: {
//       el: ".swiper-pagination",
//       clickable: true,
//    },
// });

var swiper = new Swiper(".hero-slider", {
   loop: true,
   grabCursor: true,
   effect: "ease-in",
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
   },
   autoplay: {
      delay: 3000, // 5000 milliseconds (5 seconds) between slides
   },
});



</script>
<script>
  AOS.init();
</script>
</body>
</html>