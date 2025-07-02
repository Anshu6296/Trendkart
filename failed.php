<!DOCTYPE html>
<html>
<head>
    <title>Payment Failed </title> 
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
  color: red;
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
      background-color: orange;
      color: white;
    }

    /* Hover effect */
    .styled-button:hover {
      background-color: #2980b9;
    }
</style>
</head>
<body bgcolor="#f0f0f0">
    <center>
<div class="reel-container">
  <div class="reel-content">
    <img src="https://cdn.printme.online/wp-content/uploads/2020/04/payment_fail_icon.png" width="100" height="100" alt="Check Mark" class="success-image">
    <h1 class="success-text">Payment Failed</h1>
    
    <p style="font-family: Garamond, sans-serif; font-size: 20px; font-weight: bold; color: #333;">We could not acquire the payment.</p>
    <p style="font-family: Courier, sans-serif; font-size: 12px; font-weight: bold; color: #333;">(Note: Invalid Card Details or Insufficient Funds)<br></p>

    <div class="button-container">
      
      <br>
      <button class="styled-button" onclick="window.location.href='checkout.php'">Try Again</button>

    </div> 
    
  </div>
</div>
</body>
</html>
