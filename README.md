TrendKart is a fully functional eCommerce web application built with PHP, MySQL, HTML/CSS, and JavaScript. It features product listings, categories, cart and checkout system, admin panel, and user authentication—making it suitable for online shopping platforms.

📁 Project Structure

pgsql
Copy
Edit
TrendKart/
├── admin/                # Admin dashboard (add/update/delete products)
├── components/           # Reusable PHP components (db connection, header, footer, etc.)
├── uploaded_img/         # Stores uploaded product images
├── css/                  # Stylesheets
├── js/                   # JavaScript files (e.g., swiper.js)
├── hm.php                # Homepage with category slider
├── quick_view.php        # Product details and variant selection
├── category.php          # Products filtered by category
├── cart.php              # User shopping cart
├── checkout.php          # Checkout page
├── orders.php            # Order summary/history
├── update_product.php    # Admin product update page
├── match_result.php      # Product image recognition results
├── products.php          # Admin add product form
├── login.php             # User login
├── register.php          # User registration
├── logout.php            # Log out functionality
├── contact.php           # Contact form with chatbot
└── database.sql          # SQL file to create tables
⚙️ Features
User Authentication (Login/Register)

Dynamic Category System (Mobile, Fashion, etc.)

Subcategory filtering (e.g., Men/Women/Kids for Fashion)

Image Upload and Product Matching (with camera upload feature)

Product Variants (RAM+ROM, Size)

Shopping Cart and Checkout Flow

Admin Panel to Manage Products

Responsive Design with Swiper Slider

Chatbot FAQs in Contact Page

🏗️ Technologies Used
Frontend: HTML5, CSS3, JavaScript, Swiper.js

Backend: PHP (Compatible with PHP 5.6+)

Database: MySQL

Server: XAMPP or similar local server environment

🛠️ Setup Instructions
Clone the Repository

bash
Copy
Edit
git clone https://github.com/Anshu6296/trendkart.git
Move to XAMPP htdocs
Place the project folder inside your xampp/htdocs directory.

Import the Database

Open phpMyAdmin.

Create a database named trendkart.

Import the provided database.sql file.

Configure Database Connection
Edit components/connect.php:

php
Copy
Edit
$conn = mysqli_connect('localhost', 'root', '', 'trendkart') or die('connection failed');
Start XAMPP and Run the Site

Start Apache and MySQL.

Visit: http://localhost/trendkart/home.php

🔑 Admin Login
You can access the admin panel by logging into /admin/ with admin credentials (set manually in DB or via a login system if implemented).

📷 Image Matching Feature
Upload a product image using the camera or file upload in hm.php.

match_result.php will display visually similar products based on pre-trained image similarity.

📌 Notes
All product subcategories are stored directly in the categories column (e.g., "Men Fashion", "Women Fashion").

Variants (RAM/ROM/Size) are stored in the variant column in the cart table.

Make sure file upload and read/write permissions are enabled for uploaded_img/.
