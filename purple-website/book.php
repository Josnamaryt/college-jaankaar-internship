<!DOCTYPE html>
<html lang="en">
<head>
    <title>Booking</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="book">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="styles/contact_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
    <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
    <style>
        /* Cart Styles */
        .cart-items-container {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .cart-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item-content {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 4px;
        }

        .cart-item-details {
            flex: 1;
        }

        .product-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .product-description {
            color: #666;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .product-price {
            font-size: 16px;
            font-weight: 600;
            color: #fe4c50;
        }

        .remove-item {
            padding: 8px 15px;
            margin-left: 15px;
        }

        /* Order Summary Styles */
        .order-summary {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 20px;
        }

        .order-summary h4 {
            color: #333;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: 600;
        }

        .total-price {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 20px 0;
        }

        /* Checkout Form Styles */
        #booking1 {
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 40px;
            margin-bottom: 40px;
        }

        #booking1 h2 {
            color: #333;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 12px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #fe4c50;
            box-shadow: 0 0 0 0.2rem rgba(254,76,80,0.25);
        }

        /* Button Styles */
        .btn-primary {
            background-color: #fe4c50;
            border-color: #fe4c50;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #e44447;
            border-color: #e44447;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: 500;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-danger {
            padding: 8px 15px;
            font-size: 14px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-item-content {
                margin-bottom: 15px;
            }

            .remove-item {
                margin-left: 0;
                margin-top: 10px;
            }

            .order-summary {
                margin-top: 20px;
            }
        }

        /* Breadcrumb Styles */
        .breadcrumbs {
            padding: 20px 0;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
        }

        .breadcrumbs ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .breadcrumbs li {
            font-size: 14px;
            color: #666;
        }

        .breadcrumbs li a {
            color: #333;
            text-decoration: none;
        }

        .breadcrumbs li.active a {
            color: #fe4c50;
        }

        .breadcrumbs li i {
            margin: 0 10px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="super_container">
        <!-- Header -->
        <?php include 'include/header.php'; ?>

        <div class="container" style="margin-top: 120px;">
            <!-- Breadcrumbs -->
            <div class="breadcrumbs">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li class="active"><a href="#">Shopping Cart</a></li>
                </ul>
            </div>

            <!-- Cart Section -->
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mb-4">Your Cart</h2>
                    <div id="cart-items-container" class="cart-items-container">
                        <!-- Cart items will be loaded here -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="order-summary">
                        <h4>Order Summary</h4>
                        <p class="total-price">Total: $0.00</p>
                        <button id="checkoutButton" class="btn btn-primary btn-block">Proceed to Checkout</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkout Section -->
        <div id="booking1" style="display: none;" class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2>Checkout Details</h2>
                    <form id="checkoutForm">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" required>
                        </div>
                        <button type="button" id="proceedToPayButton" class="btn btn-success btn-block">Proceed to Pay</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include 'include/footer.php'; ?>
    </div>

    <!-- Scripts -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="styles/bootstrap4/popper.js"></script>
    <script src="styles/bootstrap4/bootstrap.min.js"></script>
    <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="plugins/easing/easing.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
    function loadCartItems() {
        const savedCartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
        const cartItemsContainer = document.getElementById("cart-items-container");
        const checkoutItemsSpan = document.getElementById("checkout_items");
        
        cartItemsContainer.innerHTML = '';
        let totalPrice = 0;
        
        if (savedCartItems.length === 0) {
            cartItemsContainer.innerHTML = '<div class="text-center py-4"><h4>Your cart is empty</h4><p>Browse our products and add items to your cart.</p><a href="categories.php" class="btn btn-primary">Continue Shopping</a></div>';
            checkoutItemsSpan.textContent = "0";
        } else {
            checkoutItemsSpan.textContent = savedCartItems.length.toString();
            
            savedCartItems.forEach((item, index) => {
                totalPrice += item.price;
                
                const cartItem = document.createElement("div");
                cartItem.classList.add("cart-item");
                cartItem.innerHTML = `
                    <div class="cart-item-content">
                        <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                        <div class="cart-item-details">
                            <p class="product-name">${item.name}</p>
                            <p class="product-description">${item.description}</p>
                            <p class="product-price">$${item.price.toFixed(2)}</p>
                        </div>
                    </div>
                    <button class="btn btn-danger remove-item" onclick="removeItem(${index})">Remove</button>
                `;
                cartItemsContainer.appendChild(cartItem);
            });
        }

        document.querySelector(".total-price").textContent = `Total: $${totalPrice.toFixed(2)}`;
        return totalPrice;
    }

    function removeItem(index) {
        const savedCartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
        savedCartItems.splice(index, 1);
        localStorage.setItem("cartItems", JSON.stringify(savedCartItems));
        loadCartItems();
    }

    document.getElementById('checkoutButton').addEventListener('click', function() {
        const cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
        if (cartItems.length === 0) {
            alert('Your cart is empty. Please add items before proceeding to checkout.');
            return;
        }
        document.querySelector('.container').style.display = 'none';
        document.getElementById('booking1').style.display = 'block';
    });

    document.getElementById('proceedToPayButton').addEventListener('click', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        
        if (!name || !email || !phone) {
            alert('Please fill in all required fields');
            return;
        }
        
        const amount = loadCartItems() * 100; // Convert to smallest currency unit (paise)

        const options = {
            key: 'rzp_test_p9ccnzVHbdWZkL',
            amount: amount,
            currency: 'INR',
            name: 'Purple Website',
            description: 'Purchase Payment',
            handler: function(response) {
                console.log('Payment response:', response);  // Debug log
                
                // Check if all required parameters are present
                if (!response.razorpay_payment_id || !response.razorpay_order_id || !response.razorpay_signature) {
                    console.error('Missing payment parameters:', response);
                    alert('Payment verification failed: Missing parameters');
                    return;
                }
                
                fetch('payment_handler.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Server response:', data);  // Debug log
                    if (data.status === 'success') {
                        alert('Payment successful! Thank you for your purchase.');
                        localStorage.removeItem('cartItems');
                        window.location.href = 'index.php';
                    } else {
                        alert('Payment verification failed: ' + (data.message || 'Please contact support.'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred during payment verification. Please try again.');
                });
            },
            prefill: {
                name: name,
                email: email,
                contact: phone
            },
            theme: {
                color: '#fe4c50'
            }
        };

        const rzp = new Razorpay(options);
        rzp.open();
    });

    // Load cart items when page loads
    if (window.location.pathname.includes("book.php")) {
        loadCartItems();
    }
    </script>
</body>
</html>
