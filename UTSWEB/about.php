<?php

include 'components/connect.php';

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
   <title>About</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>About Us</h3>
   <p><a href="home.php">Home</a> <span> / About</span></p>
</div>

<!-- about section starts  -->

<section class="about">

<div data-aos="fade-up" data-aos-duration="3000">

   <div class="row">

      <div class="image" data-aos="fade-right" data-aos-duration="1500">
         <img src="images/foto umn.png" alt="">
      </div>

      <div class="content">
         <h3>Resto IF-330</h3>
         <p>Website ini dibuat untuk membantu resto IF-330 yang terletak persis di dalam Universitas Multimedia Nusantara, Restoran IF-330 menyediakan berbagai macam menu dari dalam maupun luar negeri. Click menu untuk melihat semua menu yang ada.</p>
         <a href="menu.html" class="btn">our menu</a>
      </div>

   </div>
</div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<!-- <section class="steps">

   <h1 class="title">simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>choose order</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, dolorem.</p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>fast delivery</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, dolorem.</p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>enjoy food</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, dolorem.</p>
      </div>

   </div>

</section> -->

<!-- steps section ends -->

<!-- reviews section starts  -->

<section class="reviews">

   <div data-aos="fade-right"
   data-aos-duration="2000">
      <h1 class="title">Our Team</h1>
   </div>

   <div data-aos="zoom-in"
   data-aos-duration="1500">

      <div class="swiper reviews-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
               <img src="uploaded_img/deponcans.jpg" alt="">
               <p>P infokan.</p>
               <h3>Devon Aurelius</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="uploaded_img/epan.jpg" alt="">
               <p>P infokan.</p>

               <h3>Evan Yo</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="uploaded_img/marpel.jpg" alt="">
               <p>P infokan.</p>
               <h3>Marvell Christofer</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="uploaded_img/acip.png" alt="">
               <p>P infokan.</p>
               <h3>Moses Alexander</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="uploaded_img/wepe.jpg" alt="">
               <p>P infokan.</p>
               <h3>William Purba</h3>
            </div>

         </div>

         <div class="swiper-pagination"></div>

      </div>
   </div>

</section>

<!-- reviews section ends -->



















<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

<script>
  AOS.init();
</script>
</body>
</html>