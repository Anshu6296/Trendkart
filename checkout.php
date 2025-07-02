<?php
include 'components/connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:hm.php');
    exit;
}
$user_id = $_SESSION['user_id'];

// Fetch user profile
$profile_stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$profile_stmt->execute([$user_id]);
$fetch_profile = $profile_stmt->fetch(PDO::FETCH_ASSOC);

// Place order
if (isset($_POST['submit'])) {
    $name    = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $number  = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $email   = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $method  = filter_var($_POST['method'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_price    = (int)$_POST['total_price'];
    $variant        = $_POST['variant'];

    $check_cart = $conn->prepare("SELECT id FROM cart WHERE user_id = ?");
    $check_cart->execute([$user_id]);

    if ($check_cart->rowCount() > 0) {
        if ($address === '') {
            $message[] = 'please add your address!';
        } else {
            $insert = $conn->prepare("INSERT INTO orders (user_id, name, number, email, method, address, total_products, total_price, variant) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price, $variant]);

            $conn->prepare("DELETE FROM cart WHERE user_id = ?")->execute([$user_id]);
            $message[] = 'order placed successfully!';
            header("Refresh:2; URL=success.php");
        }
    } else {
        $message[] = 'your cart is empty';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>checkout</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="css/stylee.css">
  <style>.variant{font-size:.9rem;color:#555;margin:2px 0 6px 0}</style>
</head>
<body>

<?php include 'components/user_header.php'; ?>

<div class="heading">
  <h3>checkout</h3>
  <p><a href="hm.php">home</a> / checkout</p>
</div>

<section class="checkout">
<h1 class="title">order summary</h1>

<form method="post">
  <div class="cart-items">
    <h3>cart items</h3>
<?php
$grand_total = 0;
$cart_items = [];
$variant_list = [];

$select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
$select_cart->execute([$user_id]);

if ($select_cart->rowCount()):
    while ($c = $select_cart->fetch(PDO::FETCH_ASSOC)):
        $sub_total = $c['price'] * $c['quantity'];
        $grand_total += $sub_total;

        $label = $c['name'];
        if (!empty($c['variant'])) {
            $label .= ' [' . $c['variant'] . ']';
            $variant_list[] = $c['variant'];
        }
        $cart_items[] = $label . ' (' . $c['price'] . ' x ' . $c['quantity'] . ')';
?>
    <p>
      <span class="name"><?= htmlspecialchars($c['name']) ?></span>
      <?php if (!empty($c['variant'])): ?>
         <br><span class="variant"><?= htmlspecialchars($c['variant']) ?></span>
      <?php endif; ?>
      <span class="price">₹<?= number_format($c['price']) ?> x <?= $c['quantity'] ?></span>
    </p>
<?php
    endwhile;
else:
    echo '<p class="empty">your cart is empty!</p>';
endif;

$total_products = implode(' - ', $cart_items);
$variant_combined = implode(', ', $variant_list);
?>
    <p class="grand-total"><span class="name">grand total :</span> <span class="price">₹<?= number_format($grand_total) ?></span></p>
    <a href="cart.php" class="btn">view cart</a>
  </div>

  <!-- hidden fields -->
  <input type="hidden" name="total_products" value="<?= htmlspecialchars($total_products) ?>">
  <input type="hidden" name="total_price"    value="<?= $grand_total ?>">
  <input type="hidden" name="variant"        value="<?= htmlspecialchars($variant_combined) ?>">
  <input type="hidden" name="name"    value="<?= htmlspecialchars($fetch_profile['name']) ?>">
  <input type="hidden" name="number"  value="<?= htmlspecialchars($fetch_profile['number']) ?>">
  <input type="hidden" name="email"   value="<?= htmlspecialchars($fetch_profile['email']) ?>">
  <input type="hidden" name="address" value="<?= htmlspecialchars($fetch_profile['address']) ?>">

  <div class="user-info">
    <h3>your info</h3>
    <p><i class="fas fa-user"></i> <?= htmlspecialchars($fetch_profile['name']) ?></p>
    <p><i class="fas fa-phone"></i> <?= htmlspecialchars($fetch_profile['number']) ?></p>
    <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($fetch_profile['email']) ?></p>
    <a href="update_profile.php" class="btn">update info</a>

    <h3>delivery address</h3>
    <p><i class="fas fa-map-marker-alt"></i> <?= $fetch_profile['address'] ?: 'please enter your address' ?></p>
    <a href="update_address.php" class="btn">update address</a>

    <h3>payment method</h3>
    <select name="method" class="box" hidden>
      <option value="CASH" selected>CASH</option>
    </select>

    <input type="submit" name="submit" value="Pay With Cash"
           class="btn <?= $fetch_profile['address']==''?'disabled':'' ?>"
           style="width:100%;background:var(--red);color:#fff;">

    <a href="card.php?grand_total=<?= $grand_total ?>&total_products=<?= urlencode($total_products) ?>"
       class="btn <?= $fetch_profile['address']==''?'disabled':'' ?>"
       style="display:inline-block;margin-top:10px;width:100%;background:var(--red);color:#fff;text-align:center;">
       Pay With Card
    </a>
  </div>
</form>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
