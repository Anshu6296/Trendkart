<!DOCTYPE html>
<html>
<head>
    <title>Payment Successful </title> 
<style>
.reel-container {
  position: relative;
  width: 540px;
  
  background-color: #f0f0f0; /* Background color for the container */
  overflow: hidden;
}

.reel-content {
  width: 100%;
  height: 50%;
  position: relative;
  padding: 20px;
  box-sizing: border-box;
  border: 10px solid transparent;
  border-image: linear-gradient(to top, #ff3366, #66ccff);
  border-image-slice: 1;
  text-align: center; /* Center-align content */
}

.success-image {
  display: block;
  margin: 0 auto; /* Center the image horizontally */
}

.success-text {
  color: green;
}

//* Button container */
.button-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    /* Styled button */
    .styled-button {
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      background-color: #3498db;
      color: white;
    }

    /* Hover effect */
    .styled-button:hover {
      background-color: #ff3366;
    }
</style>
</head>
<body bgcolor="#f0f0f0">
    <center>
<div class="reel-container">
  <div class="reel-content">
    <img src="https://www.kablooe.com/wp-content/uploads/2019/08/check_mark.png" width="100" height="100" alt="Check Mark" class="success-image">
    <h1 class="success-text">Payment Successful</h1>
    <div class="button-container">
      <button class="styled-button" onclick="window.location.href='orders.php'">See Your Orders</button>
      <br><br>
      <button class="styled-button" onclick="window.location.href='home.php'">Go To HomePage</button>

    </div>
  </div>
</div>
</body>
</html>
