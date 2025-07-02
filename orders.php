<?php
include 'components/connect.php';
session_start();

$user_id = $_SESSION['user_id'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="orders">
   <h1 class="heading">Placed Orders</h1>
   <div class="box-container">

   <?php
   if ($user_id == '') {
      echo '<p class="empty"><a href="login.php">Please login to see your orders</a></p>';
   } else {
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY id DESC");
      $select_orders->execute([$user_id]);

      if ($select_orders->rowCount() > 0) {
         while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
   ?>
   <div class="box">
      <p>Order ID : <span>#<?= $fetch_orders['id']; ?></span></p>
      <p>Placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>Name : <span><?= htmlspecialchars($fetch_orders['name']); ?></span></p>
      <p>Email : <span><?= htmlspecialchars($fetch_orders['email']); ?></span></p>
      <p>Number : <span><?= htmlspecialchars($fetch_orders['number']); ?></span></p>
      <p>Address : <span><?= htmlspecialchars($fetch_orders['address']); ?></span></p>
      <p>Payment Method : <span><?= htmlspecialchars($fetch_orders['method']); ?></span></p>
      <p>Your Orders : <span><?= htmlspecialchars($fetch_orders['total_products']); ?></span></p>

      <?php if (!empty($fetch_orders['variant'])): ?>
         <p>Variants : <span><?= htmlspecialchars($fetch_orders['variant']); ?></span></p>
      <?php endif; ?>

      <p>Total Price : <span>₹<?= number_format($fetch_orders['total_price']); ?>/-</span></p>
      
      <p>Delivery Status :
         <span style="color:
            <?php
               if ($fetch_orders['delivery_status'] == 'pending') echo 'red';
               elseif ($fetch_orders['delivery_status'] == 'Order Cancelled') echo 'red';
               elseif ($fetch_orders['delivery_status'] == 'shipped') echo 'blue';
               else echo 'green';
            ?>">
            <?= $fetch_orders['delivery_status']; ?>
         </span>
      </p>

      <?php if ($fetch_orders['delivery_status'] == 'pending' || $fetch_orders['delivery_status'] == 'shipped'): ?>
         <a href="cancel_order.php?id=<?= $fetch_orders['id']; ?>">
            <button class="btn" onclick="return confirm('Cancel this order?');">Cancel Order</button>
         </a>
      <?php else: ?>
         <button class="btn" disabled>Cancellation Closed</button>
      <?php endif; ?>
   </div>
   <?php
         }
      } else {
         echo '<p class="empty">No orders placed yet!</p>';
      }
   }
   ?>
   </div>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
