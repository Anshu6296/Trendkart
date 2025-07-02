<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Card Payment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <style>
    * {
      font-family: 'Poppins', sans-serif;
      margin: 0; padding: 0;
      box-sizing: border-box;
      text-decoration: none;
      text-transform: uppercase;
    }

    body {
      background: #f5f5dc;
    }

    .container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding-bottom: 60px;
    }

    form {
      background: #fff;
      border-radius: 5px;
      box-shadow: 0 10px 15px rgba(0,0,0,.1);
      padding: 20px;
      width: 600px;
      padding-top: 160px;
    }

    .inputBox {
      margin-top: 20px;
    }

    .inputBox span {
      display: block;
      color: #999;
      padding-bottom: 5px;
    }

    .inputBox input,
    .inputBox select {
      width: 100%;
      padding: 10px;
      border-radius: 10px;
      border: 1px solid rgba(0,0,0,.3);
      color: #444;
    }

    .flexbox {
      display: flex;
      gap: 15px;
    }

    .flexbox .inputBox {
      flex: 1 1 150px;
    }

    .submit-btn {
      width: 100%;
      background: linear-gradient(45deg, #0045c7, #ff2c7d);
      margin-top: 20px;
      padding: 10px;
      font-size: 20px;
      color: #fff;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.2s linear;
    }

    .submit-btn:hover {
      letter-spacing: 2px;
      opacity: 0.8;
    }

    .card-container {
      margin-bottom: -150px;
      position: relative;
      height: 250px;
      width: 400px;
      perspective: 1000px;
    }

    .card-container .front,
    .card-container .back {
      position: absolute;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, #0045c7, #ff2c7d);
      border-radius: 10px;
      box-shadow: 0 15px 25px rgba(0,0,0,.2);
      backface-visibility: hidden;
      padding: 20px;
      transition: transform .4s ease-out;
    }

    .front {
      z-index: 1;
    }

    .back {
      transform: rotateY(180deg);
    }

    .map-img {
      width: 100%;
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0.5;
      z-index: -1;
    }

    .image {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .image img {
      height: 50px;
    }

    .card-number-box {
      padding: 30px 0;
      font-size: 25px;
      color: #fff;
    }

    .front .flexbox {
      display: flex;
    }

    .front .flexbox .box {
      font-size: 15px;
      color: #fff;
    }

    .front .flexbox .box:nth-child(1) {
      margin-right: auto;
    }

    .back .stripe {
      background: #000;
      height: 50px;
      width: 100%;
      margin: 10px 0;
    }

    .back .box {
      padding: 0 20px;
    }

    .back .box span {
      color: #fff;
      font-size: 15px;
    }

    .cvv-box {
      height: 50px;
      padding: 10px;
      margin-top: 5px;
      color: #333;
      background: #fff;
      border-radius: 5px;
      width: 100%;
    }

    .back .box img {
      margin-top: 30px;
      height: 30px;
    }
  </style>
</head>
<body>

<div class="container">

  <!-- Card Visual -->
  <div class="card-container">
    <div class="front">
     
      <div class="image">
        <img src="images/chip.png" alt="chip">
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="visa">
      </div>
      <div class="card-number-box">################</div>
      <div class="flexbox">
        <div class="box">
          <span>card holder</span>
          <div class="card-holder-name">full name</div>
        </div>
        <div class="box">
          <span>expires</span>
          <div class="expiration">
            <span class="exp-month">mm</span> /
            <span class="exp-year">yy</span>
          </div>
        </div>
      </div>
    </div>

    <div class="back">
      
      <div class="stripe"></div>
      <div class="box">
        <span>cvv</span>
        <div class="cvv-box"></div>
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="visa">
      </div>
    </div>
  </div>

  <!-- Payment Form -->
  <form action="bank2.php" method="get" enctype="multipart/form-data">

    <?php
      echo "<input type='hidden' name='total_price' value='" . $_GET['grand_total'] . "'>";
      echo "<input type='hidden' name='total_products' value='" . $_GET['total_products'] . "'>";
      echo "<input type='hidden' name='card' value='CARD'>";
    ?>

    <div class="inputBox">
      <span>card number</span>
      <input type="number" name="card_number" maxlength="16" class="card-number-input" required placeholder="Enter your card number" autocomplete="off">
    </div>

    <div class="inputBox">
      <span>card holder</span>
      <input type="text" name="banking_name" class="card-holder-input" required placeholder="Enter card holder name" autocomplete="off">
    </div>

    <div class="flexbox">
      <div class="inputBox">
        <span>expiration mm</span>
        <select name="expmonth" class="month-input" required>
          <option value="" disabled selected>Month</option>
          <?php for ($i = 1; $i <= 12; $i++): ?>
            <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
          <?php endfor; ?>
        </select>
      </div>

      <div class="inputBox">
        <span>expiration yy</span>
        <select name="expyear" class="year-input" required>
          <option value="" disabled selected>Year</option>
          <?php
            $year = date("Y");
            for ($i = 0; $i < 15; $i++):
              $y = $year + $i;
              echo "<option value='$y'>$y</option>";
            endfor;
          ?>
        </select>
      </div>

      <div class="inputBox">
        <span>cvv</span>
        <input type="number" name="cvv" maxlength="4" class="cvv-input" required placeholder="CVV" autocomplete="off">
      </div>
    </div>

    <input type="submit" value="MAKE PAYMENT" class="submit-btn">
  </form>
</div>

<!-- JS -->
<script>
document.querySelector('.card-number-input').oninput = () => {
  document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
}
document.querySelector('.card-holder-input').oninput = () => {
  document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
}
document.querySelector('.month-input').oninput = () => {
  document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
}
document.querySelector('.year-input').oninput = () => {
  document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
}
document.querySelector('.cvv-input').onmouseenter = () => {
  document.querySelector('.front').style.transform = 'rotateY(-180deg)';
  document.querySelector('.back').style.transform = 'rotateY(0deg)';
}
document.querySelector('.cvv-input').onmouseleave = () => {
  document.querySelector('.front').style.transform = 'rotateY(0deg)';
  document.querySelector('.back').style.transform = 'rotateY(180deg)';
}
document.querySelector('.cvv-input').oninput = () => {
  document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
}
</script>

</body>
</html>
