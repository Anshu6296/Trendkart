<?php
include 'components/connect.php';
session_start();

$user_id = $_SESSION['user_id'] ?? '';
include 'components/wishlist_cart.php';

$pid = isset($_GET['pid']) ? (int)$_GET['pid'] : 0;
if ($pid <= 0) {
    echo '<p class="empty">Invalid product ID!</p>';
    exit;
}

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$pid]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) {
    echo '<p class="empty">Product not found!</p>';
    exit;
}

$ramList  = array_filter(array_map('trim', explode(',', $product['ram'] ?? '')));
$romList  = array_filter(array_map('trim', explode(',', $product['internal_storage'] ?? '')));
$sizeList = array_filter(array_map('trim', explode(',', $product['size'] ?? '')));

if (isset($_POST['add_to_cart'])) {
    $qty = $_POST['qty'];
    $variant = '';

    if ($product['categories'] === 'Mobile') {
        $sel_ram = $_POST['sel_ram'] ?? '';
        $sel_rom = $_POST['sel_rom'] ?? '';
        $variant = trim($sel_ram . ' + ' . $sel_rom);
    } elseif (in_array($product['categories'], ['Men Fashion', 'Women Fashion', 'Kids Fashion'])) {
        $variant = $_POST['sel_size'] ?? '';
    }

    $insert = $conn->prepare("INSERT INTO cart (user_id, pid, name, price, quantity, image, variant) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insert->execute([
        $user_id,
        $product['id'],
        $product['name'],
        $product['price'],
        $qty,
        $product['image_01'],
        $variant
    ]);

    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quick View</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="quick-view">
  <h1 class="heading">Quick View</h1>

  <form action="" method="post" class="box">
    <input type="hidden" name="pid" value="<?= $product['id'] ?>">
    <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']) ?>">
    <input type="hidden" name="price" value="<?= $product['price'] ?>">
    <input type="hidden" name="image" value="<?= htmlspecialchars($product['image_01']) ?>">

    <div class="row">
      <div class="image-container">
        <div class="main-image">
          <img src="uploaded_img/<?= htmlspecialchars($product['image_01']) ?>" alt="">
        </div>
        <div class="sub-image">
          <img src="uploaded_img/<?= htmlspecialchars($product['image_01']) ?>" alt="">
          <?php if (!empty($product['image_02'])): ?>
            <img src="uploaded_img/<?= htmlspecialchars($product['image_02']) ?>" alt="">
          <?php endif; ?>
          <?php if (!empty($product['image_03'])): ?>
            <img src="uploaded_img/<?= htmlspecialchars($product['image_03']) ?>" alt="">
          <?php endif; ?>
        </div>
      </div>

      <div class="content">
    <h1 style="font-size: 36px;"><?= htmlspecialchars($product['name']) ?></h1>


        <div class="flex">
          <div class="price">₹<?= number_format($product['price']) ?>/-</div>
          <input type="number" name="qty" class="qty" min="1" max="99" value="1" required>
        </div>

        <!-- Variant Selector -->
        <?php if ($product['categories'] === 'Mobile'): ?>
          <p><strong><h2>Select RAM:</strong>
            <select name="sel_ram" required>
              <option value="">-- RAM --</option>
              <?php foreach ($ramList as $ram): ?>
                <option value="<?= $ram ?>GB"><?= $ram ?> GB</option>
              <?php endforeach; ?>
            </select>
          </p>
          <p><strong>Select ROM:</strong>
            <select name="sel_rom" required>
              <option value="">-- ROM --</option>
              <?php foreach ($romList as $rom): ?>
                <option value="<?= $rom ?>GB"><?= $rom ?> GB </h2></option>
              <?php endforeach; ?>
            </select>
          </p>
        <?php elseif (in_array($product['categories'], ['Men Fashion', 'Women Fashion', 'Kids Fashion']) && $sizeList): ?>
          <p><strong>Select Size:</strong><br>
            <?php foreach ($sizeList as $sz): ?>
              <label>
                <input type="radio" name="sel_size" value="<?= $sz ?>" required> <?= $sz ?>
              </label>
            <?php endforeach; ?>
          </p>
        <?php endif; ?>
<br>

        <h2><u>Product Details</u></h2>
        <ul style="font-size: 14px;">
    <?php foreach (explode("\n", $product['details']) as $line): ?>
        <?php if (trim($line)) echo "<li>" . htmlspecialchars($line) . "</li>"; ?>
    <?php endforeach; ?>
</ul>


        <div class="flex-btn">
          <input type="submit" name="add_to_cart" value="Add to Cart" class="btn">
          <input type="submit" name="add_to_wishlist" value="Add to Wishlist" class="option-btn">
        </div>
      </div>
    </div>
  </form>
</section>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
