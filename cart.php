<?php
include 'components/connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['delete'])) {
    $conn->prepare("DELETE FROM cart WHERE id = ?")->execute([$_POST['cart_id']]);
}

if (isset($_GET['delete_all'])) {
    $conn->prepare("DELETE FROM cart WHERE user_id = ?")->execute([$user_id]);
    header('location:cart.php');
    exit;
}

if (isset($_POST['update_qty'])) {
    $qty = filter_var($_POST['qty'], FILTER_SANITIZE_NUMBER_INT);
    $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?")->execute([$qty, $_POST['cart_id']]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shopping Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .variant {
        font-size: 0.9rem;
        color: #444;
        margin-top: 5px;
    }
  </style>
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="products shopping-cart">
  <h3 class="heading">Shopping Cart</h3>
  <div class="box-container">
    <?php
    $grand_total = 0;
    $rows = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
    $rows->execute([$user_id]);

    if ($rows->rowCount()):
        while ($r = $rows->fetch(PDO::FETCH_ASSOC)):
            $sub_total  = $r['price'] * $r['quantity'];
            $grand_total += $sub_total;
    ?>
    <form action="" method="post" class="box">
      <input type="hidden" name="cart_id" value="<?= $r['id'] ?>">
      <a href="quick_view.php?pid=<?= $r['pid'] ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= htmlspecialchars($r['image']) ?>" alt="">

      <div class="name">
        <?= htmlspecialchars($r['name']) ?>
        <?php if (!empty($r['variant'])): ?>
          <span class="variant">(<?= htmlspecialchars($r['variant']) ?>)</span>
        <?php endif; ?>
      </div>

      <div class="flex">
        <div class="price">₹<?= number_format($r['price']) ?>/-</div>
        <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $r['quantity'] ?>">
        <button type="submit" class="fas fa-edit" name="update_qty" title="Update quantity"></button>
      </div>

      <div class="sub-total">Sub Total: ₹<?= number_format($sub_total) ?>/-</div>
      <input type="submit" name="delete" value="Delete item" onclick="return confirm('Delete this item?');" class="delete-btn">
    </form>
    <?php endwhile; else: ?>
        <p class="empty">Your cart is empty</p>
    <?php endif; ?>
  </div>

  <div class="cart-total">
    <p>Grand Total : <span>₹<?= number_format($grand_total) ?>/-</span></p>
    <a href="shop.php" class="option-btn">Continue Shopping</a>
    <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 0 ? '' : 'disabled') ?>" onclick="return confirm('Delete all items?')">Delete All Items</a>
    <a href="checkout.php" class="btn <?= ($grand_total > 0 ? '' : 'disabled') ?>">Proceed to Checkout</a>
  </div>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
