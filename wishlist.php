<?php
include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
}

include 'components/wishlist_cart.php';

if(isset($_POST['delete'])){
   $wishlist_id = $_POST['wishlist_id'];
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
   $delete_wishlist_item->execute([$wishlist_id]);
}

if(isset($_GET['delete_all'])){
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist_item->execute([$user_id]);
   header('location:wishlist.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>wishlist</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="products">
   <h3 class="heading">your wishlist</h3>

   <div class="box-container">
   <?php
      $grand_total = 0;
      $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
      $select_wishlist->execute([$user_id]);
      if($select_wishlist->rowCount() > 0){
         while($fetch = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
            $grand_total += $fetch['price'];  
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid"         value="<?= $fetch['pid']; ?>">
      <input type="hidden" name="wishlist_id" value="<?= $fetch['id']; ?>">
      <input type="hidden" name="name"        value="<?= $fetch['name']; ?>">
      <input type="hidden" name="price"       value="<?= $fetch['price']; ?>">
      <input type="hidden" name="image"       value="<?= $fetch['image']; ?>">

      <!-- Include selected variant if available -->
      <?php if (!empty($fetch['variant'])): ?>
         <input type="hidden" name="variant" value="<?= htmlspecialchars($fetch['variant']) ?>">
      <?php endif; ?>

      <a href="quick_view.php?pid=<?= $fetch['pid']; ?>" class="fas fa-eye"></a>
      <a href="quick_view.php?pid=<?= $fetch['pid']; ?>"><img src="uploaded_img/<?= $fetch['image']; ?>" alt=""></a>

      <div class="name"><?= htmlspecialchars($fetch['name']) ?></div>

      <?php if (!empty($fetch['variant'])): ?>
         <div class="variant"><strong>Variant:</strong> <?= htmlspecialchars($fetch['variant']) ?></div>
      <?php endif; ?>

      <div class="flex">
         <div class="price">₹<?= number_format($fetch['price']) ?>/-</div>
         <input type="number" name="qty" class="qty" min="1" max="99" 
                onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>

      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
      <input type="submit" value="delete item" onclick="return confirm('delete this from wishlist?');" class="delete-btn" name="delete">
   </form>
   <?php
      }
   } else {
      echo '<p class="empty">your wishlist is empty</p>';
   }
   ?>
   </div>

   <div class="wishlist-total">
      <p>grand total : <span>₹<?= number_format($grand_total) ?>/-</span></p>
      <a href="shop.php" class="option-btn">continue shopping</a>
      <a href="wishlist.php?delete_all" class="delete-btn <?= ($grand_total > 0)?'':'disabled'; ?>" onclick="return confirm('delete all from wishlist?');">delete all item</a>
   </div>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
