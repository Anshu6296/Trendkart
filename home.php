<?php
include 'components/connect.php';
session_start();
$user_id = $_SESSION['user_id'] ?? '';
include 'components/wishlist_cart.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TrendCart~ Online Easy Shopping</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .fashion-subcategories {
      display: none;
      justify-content: center;
      gap: 20px;
      margin: 20px 0;
      flex-wrap: wrap;
    }

    .fashion-subcategories.active {
      display: flex;
    }

    .fashion-card {
      text-align: center;
      cursor: pointer;
      text-decoration: none;
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 10px;
      transition: 0.3s;
      width: 120px;
    }

    .fashion-card:hover {
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    .fashion-card img {
      width: 100px;
      height: 100px;
      object-fit: contain;
    }

    .fashion-card h4 {
      margin: 10px 0 0;
      font-size: 16px;
      color: #333;
    }

    .category-slider .slide {
      text-align: center;
    }

    .camera-upload {
      display: inline-block;
      margin-left: 10px;
    }
  </style>
</head>
<body>

<?php include 'components/user_header.php'; ?>



<!-- Home Banner -->
<div class="home-bg">
  <section class="home">
    <div class="swiper home-slider">
      <div class="swiper-wrapper">
        <div class="swiper-slide slide">
          <div class="image"><img src="https://www.eiosys.com/wp-content/uploads/2021/11/blog-15-Best-Email-Marketing-tools-in-2021.webp" height="420" width="1080 alt=""></div>
          <div class="content"><span><h4>T Shirts & POLOS</h4></span><h3> Under ₹999 </h3><a href="shop.php" class="btn">shop now</a></div>
        </div>
        <div class="swiper-slide slide">
          <div class="image"><img src="https://media.croma.com/image/upload/v1681111179/Croma%20Assets/Communication/Mobiles/Images/268427_ar8gvu.png" alt=""></div>
          <div class="content"><span>Upto 50% off</span><h3>Latest Oppo Models</h3><a href="shop.php" class="btn">shop now</a></div>
        </div>
        <div class="swiper-slide slide">
          <div class="image"><img src="https://wallpapers.com/images/high/stylish-man-floral-jacket-sunglasses-52qu2g22ucj7ajio.png" alt=""></div>
          <div class="content"><span>Upto 50% off</span><h3>On Men Fashion</h3><a href="shop.php" class="btn">shop now</a></div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </section>
</div>

<!-- Category Section -->
<section class="category">
  <h1 class="heading">shop by Categories</h1>
  <div class="swiper category-slider">
    <div class="swiper-wrapper">
      <a href="category.php?category=Mobile" class="swiper-slide slide">
        <img src="https://rukminim2.flixcart.com/flap/80/80/image/22fddf3c7da4c4f4.png?q=100" alt="">
        <h3>Mobile</h3>
      </a>
      <div class="swiper-slide slide" onclick="toggleFashion()" style="cursor:pointer;">
        <img src="https://static.vecteezy.com/system/resources/thumbnails/050/517/567/small_2x/black-man-and-woman-transparent-background-png.png" alt="">
        <h3>Fashion</h3>
      </div>
      <a href="category.php?category=Electronics" class="swiper-slide slide">
        <img src="https://www.nicepng.com/png/detail/259-2597522_electronics-gadgets-tech-accessories-apple-iphone-x-10.png" alt="">
        <h3>Electronics</h3>
      </a>
      <a href="category.php?category=Grocery" class="swiper-slide slide">
        <img src="https://png.pngtree.com/png-vector/20240314/ourmid/pngtree-grocery-basket-and-a-list-of-products-png-image_11952487.png" alt="">
        <h3>Grocery</h3>
      </a>
      <a href="category.php?category=Toys" class="swiper-slide slide">
        <img src="https://png.pngtree.com/png-vector/20231109/ourmid/pngtree-plush-bunny-toy-png-image_10497097.png" alt="">
        <h3>Toys</h3>
      </a>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  <!-- Fashion Subcategory Horizontal Display -->
  <div id="fashionSubcategories" class="fashion-subcategories">
    <a href="category.php?category=Men Fashion" class="fashion-card">
      <img src="https://m.media-amazon.com/images/G/31/img24/Fashion/AF/BAU/Halos/mens/mens-1._SS300_QL85_FMpng_.png" alt="Men">
      <h4>Men</h4>
    </a>
    <a href="category.php?category=Women Fashion" class="fashion-card">
      <img src="https://m.media-amazon.com/images/G/31/img24/Fashion/AF/BAU/Halos/womens._SS300_QL85_FMpng_.png" alt="Women">
      <h4>Women</h4>
    </a>
    <a href="category.php?category=Kids Fashion" class="fashion-card">
      <img src="https://m.media-amazon.com/images/G/31/img24/Fashion/AF/BAU/Halos/kids._SS300_QL85_FMpng_.png" alt="Kids">
      <h4>Kids</h4>
    </a>
  </div>
</section>

<!-- Latest Products -->
<section class="home-products">
  <h1 class="heading">latest products</h1>
  <div class="swiper products-slider">
    <div class="swiper-wrapper">
      <?php
      $select_products = $conn->prepare("SELECT * FROM products LIMIT 6");
      $select_products->execute();
      if ($select_products->rowCount() > 0) {
          while ($fetch = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <form action="" method="post" class="swiper-slide slide">
        <input type="hidden" name="pid" value="<?= $fetch['id'] ?>">
        <input type="hidden" name="name" value="<?= $fetch['name'] ?>">
        <input type="hidden" name="price" value="<?= $fetch['price'] ?>">
        <input type="hidden" name="image" value="<?= $fetch['image_01'] ?>">
        <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
        <a href="quick_view.php?pid=<?= $fetch['id'] ?>" class="fas fa-eye"></a>
        <a href="quick_view.php?pid=<?= $fetch['id'] ?>">
          <img src="uploaded_img/<?= $fetch['image_01'] ?>" alt="">
        </a>
        <div class="name"><?= $fetch['name'] ?></div>
        <div class="flex">
          <div class="price">₹<?= number_format($fetch['price']) ?>/-</div>
          <input type="number" name="qty" class="qty" min="1" max="99" value="1"
                 onkeypress="if(this.value.length==2) return false;">
        </div>
        <input type="submit" name="add_to_cart" value="Add to Cart" class="btn">
      </form>
      <?php
          }
      } else {
          echo '<p class="empty">No products found!</p>';
      }
      ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
<script>
  function toggleFashion() {
    const fashion = document.getElementById('fashionSubcategories');
    fashion.classList.toggle('active');
  }

  const auto = {
    delay: 3000,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  };

  new Swiper('.home-slider', {
    loop: true,
    spaceBetween: 20,
    autoplay: auto,
    pagination: { el: '.home-slider .swiper-pagination', clickable: true },
  });

  new Swiper('.category-slider', {
    loop: true,
    spaceBetween: 20,
    autoplay: auto,
    pagination: { el: '.category-slider .swiper-pagination', clickable: true },
    breakpoints: {
      0: { slidesPerView: 2 },
      650: { slidesPerView: 3 },
      768: { slidesPerView: 4 },
      1024: { slidesPerView: 5 },
    },
  });

  new Swiper('.products-slider', {
    loop: true,
    spaceBetween: 20,
    autoplay: auto,
    pagination: { el: '.products-slider .swiper-pagination', clickable: true },
    breakpoints: {
      550: { slidesPerView: 2 },
      768: { slidesPerView: 2 },
      1024: { slidesPerView: 3 },
    },
  });
</script>
</body>
</html>
