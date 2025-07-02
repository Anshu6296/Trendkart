<?php
include 'components/connect.php';
session_start();

$user_id = $_SESSION['user_id'] ?? '';

if (isset($_POST['send'])) {
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
   $msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING);

   $check = $conn->prepare("SELECT * FROM messages WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $check->execute([$name, $email, $number, $msg]);

   if ($check->rowCount()) {
      $message[] = 'Already sent message!';
   } else {
      $insert = $conn->prepare("INSERT INTO messages(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert->execute([$user_id, $name, $email, $number, $msg]);
      $message[] = 'Sent message successfully!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Contact</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>
      body { font-family: Arial, sans-serif; }

      .chatbot-section {
         max-width: 500px;
         margin: 80px auto;
         background: #fff;
         border: 1px solid #ccc;
         border-radius: 10px;
         box-shadow: 0 0 12px rgba(0,0,0,0.2);
         overflow: hidden;
      }

      #chatHeader {
         background: #4CAF50;
         color: white;
         padding: 15px;
         font-size: 18px;
         display: flex;
         justify-content: space-between;
         align-items: center;
      }

      #chatlog {
         max-height: 300px;
         overflow-y: auto;
         padding: 15px;
         background: #f9f9f9;
         font-size: 14px;
      }

      .chat-msg {
         margin: 8px 0;
         padding: 10px;
         border-radius: 10px;
         max-width: 85%;
         clear: both;
      }

      .user { background: #d1f0ff; float: right; text-align: right; }
      .bot { background: #e2ffe2; float: left; display: flex; align-items: center; }

      #chatInput {
         width: calc(100% - 30px);
         margin: 10px 15px;
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
      }

      .btn-complaint {
         margin: 10px 15px;
         padding: 10px;
         background: #f44336;
         color: white;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         display: none;
      }

      .popup {
         display: none;
         position: fixed;
         top: 0;
         left: 0;
         right: 0;
         bottom: 0;
         background: rgba(0,0,0,0.6);
         z-index: 9999;
         justify-content: center;
         align-items: center;
      }

      .popup-content {
         background: white;
         padding: 30px;
         border-radius: 10px;
         width: 90%;
         max-width: 500px;
         position: relative;
      }

      .popup-content form .box {
         width: 100%;
         margin: 10px 0;
         padding: 10px;
         border: 1px solid #ccc;
         border-radius: 5px;
      }

      .popup-content .btn {
         background: #4CAF50;
         color: white;
         border: none;
         padding: 10px 20px;
         cursor: pointer;
         border-radius: 5px;
      }

      .popup-content .close-btn {
         position: absolute;
         top: 10px;
         right: 15px;
         font-size: 20px;
         cursor: pointer;
         color: #999;
      }

      .bot img {
         width: 20px;
         height: 20px;
         margin-right: 8px;
      }
   </style>
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="chatbot-section">
   <div id="chatHeader">
      <div><i class="fas fa-robot"></i> Chat With Us </div>
   </div>
   <div id="chatlog"></div>
   <input type="text" id="chatInput" placeholder="Ask something..." onkeypress="if(event.key==='Enter') handleChat();">
   <button class="btn-complaint" id="complaintBtn" onclick="openPopup()">Raise A Complaint</button>
</section>

<!-- Popup Contact Form -->
<div class="popup" id="complaintPopup">
   <div class="popup-content">
      <span class="close-btn" onclick="closePopup()">&times;</span>
      <form action="" method="post">
         <h3>Raise A Complaint</h3>
         <input type="text" name="name" placeholder="Enter your name" required maxlength="20" class="box">
         <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
         <input type="number" name="number" min="0" max="9999999999" placeholder="Enter your number" required onkeypress="if(this.value.length == 10) return false;" class="box">
         <textarea name="msg" class="box" placeholder="Enter your complaint..." cols="30" rows="6" required></textarea>
         <input type="submit" value="Send Message" name="send" class="btn">
      </form>
   </div>
</div>

<script>
const faqQA = {
   "hi": "Hi there! How can I assist you today?",
   "hello": "Hello! How can I help you?",
   "thanks": "You're welcome! Let me know if you need anything else.",
   "thank you": "You're welcome!",
   "bye": "Goodbye! Have a nice day.",
   "cancel": "To cancel your order, go to 'My Orders' and select the order.",
   "update": "You can update your details from the 'Account Settings' section.",
   "delete": "To delete your account, please contact support.",
   "account": "Account: Update profile, mobile number, or address.",
   "profile": "You can edit your profile in Account Settings.",
   "mobile": "Change mobile number under Account > Mobile Settings.",
   "address": "You can update delivery address in Account > Address.",
   "delivery": "Check 'My Orders' for delivery status.",
   "tracking": "Track orders from 'My Orders' page.",
   "status": "Order status is under 'My Orders'.",
   "charges": "Delivery charges depend on location & cart value.",
   "wallet": "We accept Paytm, PhonePe and more wallets.",
   "upi": "Choose UPI at checkout and enter your UPI ID.",
   "card": "Pay via debit, credit or prepaid cards.",
   "offer": "Find offers on product pages and during checkout.",
   "voucher": "Apply vouchers at checkout.",
   "discount": "Eligible discounts are automatically applied.",
   "coupon": "Enter a valid coupon code during checkout.",
   "order": "You can place or manage your order from 'My Orders' section."
};

function handleChat() {
   const inputElem = document.getElementById("chatInput");
   const log = document.getElementById("chatlog");
   const input = inputElem.value.trim().toLowerCase();
   if (!input) return;

   log.innerHTML += `<div class="chat-msg user">You: ${input}</div>`;

   let found = false;
   let response = "Sorry, I couldn't understand that. Need Help? Raise A Complaint...";
   for (let key in faqQA) {
      if (input.includes(key)) {
         response = faqQA[key];
         found = true;
         break;
      }
   }

   setTimeout(() => {
      log.innerHTML += `
         <div class="chat-msg bot">
            <img src="https://cdn-icons-png.flaticon.com/512/4712/4712034.png" alt="Bot">${response}
         </div>`;
      log.scrollTop = log.scrollHeight;

      document.getElementById("complaintBtn").style.display = found ? "none" : "block";
   }, 400);

   inputElem.value = "";
}

function openPopup() {
   document.getElementById("complaintPopup").style.display = "flex";
}
function closePopup() {
   document.getElementById("complaintPopup").style.display = "none";
}
</script>

<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
