<?php
include 'components/connect.php';
session_start();

$user_id = $_SESSION['user_id'] ?? '';
include 'components/wishlist_cart.php';

$uploaded_image = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
   $image_name = $_FILES['image']['name'];
   $image_tmp = $_FILES['image']['tmp_name'];
   $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
   $new_name = uniqid('match_', true) . '.' . $image_ext;
   $destination = 'uploaded_img/' . $new_name;

   if (move_uploaded_file($image_tmp, $destination)) {
      $uploaded_image = $new_name;
   }
}

// --- Dummy logic for matching ---
// You can replace this with actual AI visual matching later
// For now, it displays all products from the "Mobile" category as "matching"

$matching_category = 'Mobile'; // Or determine dynamically from AI model

$select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
$select_products->execute([$matching_category]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Matching Products</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="quick-view">
   <h1 class="heading">Matching Products</h1>

   <?php if ($uploaded_image): ?>
   <div class="box">
      <h3>Uploaded Image</h3>
      <img src="uploaded_img/<?= $uploaded_image ?>" alt="Uploaded" style="width: 200px; border-radius: 10px; border: 2px solid #333;">
   </div>
   <?php endif; ?>

   <div class="products-container" style="margin-top: 30px;">
      <?php
      if ($select_products->rowCount() > 0) {
         while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">

         <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
         <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
         <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
         <div class="name"><?= $fetch_product['name']; ?></div>
         <div class="flex">
            <div class="price">₹<?= $fetch_product['price']; ?>/-</div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1"
                   onkeypress="if(this.value.length === 2) return false;">
         </div>
         <input type="submit" value="add to cart" class="btn" name="add_to_cart">
      </form>
      <?php
         }
      } else {
         echo '<p class="empty">No matching products found!</p>';
      }
      ?>
   </div>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
