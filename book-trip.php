<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="index.css">
    <style>
        .book-container {
            display: flex;
            justify-content: space-between;
        }

        .book-container .left-container {
            height: max-content;
            width: 60%;
            border: 1px solid black;
        }

        .book-container .right-container {
            height: max-content;
            width: 40%;
            border: 1px solid black;
        }

        .left-container .date {
            height: max-content;
            width: 100%;
            border: 1px solid black;
        }

        .counter {
            font-size: 1.5rem;
            margin: 20px;
        }

        .counter button {
            font-size: 1.5rem;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            background-color: none;
        }

        .plus {

            color: black;
        }

        .minus {

            color: black;
        }

        input[type="date"] {
            font-size: 16px;
            padding: 10px;
            border: 2px solid #4CAF50;
            border-radius: 5px;
            outline: none;
            cursor: pointer;
        }

        .form-check input {
            margin-left: 30px;
        }

        .package {

            display: flex;
            flex-direction: column;
            row-gap: 5px;
            padding: 20px;
        }

        .package-he {
            padding: 10px;
            display: flex;
            justify-content: space-between;
        }

        .package-head {
            padding: 10px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;

        }

        .package-select-div {
            transition: box-shadow 0.5s ease-in-out;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 3px 2px rgba(126, 123, 123, 0.3);
        }


        .quantity-calculator {
            width: max-content;
            display: flex;
            align-items: center;
            column-gap: 15px;
            justify-content: space-between;

        }

        .quantity-calculator button {
            font-size: 24px;
            width: 30px;
            background-color: inherit;
            border: none;
        }

        .quantity-calculator button:hover {
            background-color: white;
        }
    </style>
</head>

<body>
    <?php
    include("frontend/header.php");
    ?>
    <div class="features">
        <div class="container py-5">
            <h1>Trave to Mustang 7 Days.</h1>
            <h4>Book Now</h4>
            <form action="">
                <div class="book-container">
                    <div class="left-container">
                        <div class="package">
                            <div class="package-select-div">
                                <h2>Pick Up Date</h2>
                                <div class="form-check">
                                    <input type="radio" name="date" id=""><label for="date">March 2024</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="date" id=""><label for="date">March 2024</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="date" id=""><label for="date">March 2024</label>
                                </div>
                                <div class="form-check">
                                    <input type="date" name="custome-date" id="">
                                </div>
                            </div>
                        </div>
                        <div class="package">
                            <div class="package-he">
                                <div><span>TRAVELLERS</span></div>
                                <div><span>QUANTITY</span></div>
                            </div>
                            <div class="package-select-div">
                                <div class="package-head">
                                    <div>
                                        <h5>Adult</h5>
                                    </div>
                                    <div>
                                        <h5>$ 400 / Person</h5>
                                    </div>
                                    <div class="quantity-calculator">
                                        <button type="button" class="minus" onclick="changeCount(this, -1)">-</button>
                                        <span class="scounter">0</span>
                                        <button type="button" class="plus" onclick="changeCount(this, 1)">+</button>
                                        <input type="hidden" name="product1_quantity" value="1"> <!-- Hidden input -->
                                    </div>
                                </div>
                                <div class="package-head">
                                    <div>
                                        <h5>Child</h5>
                                    </div>
                                    <div>
                                        <h5>$ 400 / Child</h5>
                                    </div>
                                    <div class="quantity-calculator">
                                        <button type="button" class="minus" onclick="changeCount(this, -1)">-</button>
                                        <span class="scounter">0</span>
                                        <button type="button" class="plus" onclick="changeCount(this, 1)">+</button>
                                        <input type="hidden" name="product2_quantity" value="1"> <!-- Hidden input -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="package">
                            <div class="package-he">
                                <h5>Select Extra Services: </h5>
                            </div>
                            <div class="package-select-div">
                                <div class="package-head">
                                    <div>
                                        <h5>Double Room</h5>
                                    </div>
                                    <div>
                                        <h5>$ 400 / Unit</h5>
                                    </div>
                                    <div class="quantity-calculator">
                                        <button type="button" class="minus" onclick="changeCount(this, -1)">-</button>
                                        <span class="scounter">0</span>
                                        <button type="button" class="plus" onclick="changeCount(this, 1)">+</button>
                                        <input type="hidden" name="product3_quantity" value="1">
                                        <!-- Hidden input -->
                                    </div>
                                </div>
                                <div class="package-head">
                                    <div>
                                        <h5>Delux Room</h5>
                                    </div>
                                    <div>
                                        <h5>$ 400 / Unit</h5>
                                    </div>
                                    <div class="quantity-calculator">
                                        <button type="button" class="minus" onclick="changeCount(this, -1)">-</button>
                                        <span class="scounter">0</span>
                                        <button type="button" class="plus" onclick="changeCount(this, 1)">+</button>
                                        <input type="hidden" name="product4_quantity" value="1">
                                        <!-- Hidden input -->
                                    </div>
                                </div>
                                <div class="package-head">
                                    <div>
                                        <h5>Twin Room</h5>
                                    </div>
                                    <div>
                                        <h5>$ 400 / Unit</h5>
                                    </div>
                                    <div class="quantity-calculator">
                                        <button type="button" class="minus" onclick="changeCount(this, -1)">-</button>
                                        <span class="scounter">0</span>
                                        <button type="button" class="plus" onclick="changeCount(this, 1)">+</button>
                                        <input type="hidden" name="product5_quantity" value="1">
                                        <!-- Hidden input -->
                                    </div>
                                </div>
                                <div class="package-head">
                                    <div>
                                        <h5>Airport Pickup</h5>
                                    </div>
                                    <div>
                                        <h5>$ 400 / Unit</h5>
                                    </div>
                                    <div class="quantity-calculator">
                                        <button type="button" class="minus" onclick="changeCount(this, -1)">-</button>
                                        <span class="scounter">0</span>
                                        <button type="button" class="plus" onclick="changeCount(this, 1)">+</button>
                                        <input type="hidden" name="product6_quantity" value="1">
                                        <!-- Hidden input -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="package">
                            <div class="package-select-div">


                            </div>
                        </div>
                    </div>
                    <div class="payment">
                        <div class="heading-trip">
                            <span>7 Days tour to Explore the Beauty of Mustang</span>
                        </div>
                        <div class="heading-trip">
                            <span><strong>Starting Date : </strong>Feb 28, 2025</span>
                        </div>
                        <div class="package-type">
                            <span>Package: Budget Friendly</span>
                        </div>
                        <div class="traveller">

                        </div>
                        <div class="extra-services">

                        </div>
                        <hr>
                        <div class="total-price" style="display: flex; justify-content: space-between;">
                            <div><span>Total</span></div>
                            <div><span><Strong>$ 1,900</Strong></span></div>
                        </div>
                        <div class="payment-method">
                            <div class="stripe">
                                <input type="radio" name="" id=""> Stripe
                            </div>
                            <div class="paypal"> <input type="radio" name="" id="">Paypal</div>

                            <div class="Himalayan"><input type="radio" name="" id="">Himalayan</div>
                        </div>
                        <div class="checkout">
                            <a href="">Pay Now</a>
                        </div>
                    </div>

                </div>
                <div class="right-container"> NExt Nepal</div>
        </div>
        </form>
        <div class="payment"></div>

    </div>
    </div>
    <?php
    include("frontend/footer.php");
    ?>
    <div class="scroll-up" id="scrollUpButton" onclick="scrollToTop()">
        <i class="fas fa-chevron-up"></i>
    </div>
    <script>
        function changeCount(button, value) {
            let container = button.parentElement; // Get the parent div
            let counterElement = container.querySelector(".scounter"); // Find the counter span
            let inputElement = container.querySelector("input[type='hidden']"); // Find the hidden input

            let count = parseInt(counterElement.innerText);
            count += value;
            if (count < 1) count = 0; // Prevent going below 1

            counterElement.innerText = count;  // Update UI
            inputElement.value = count;  // Update hidden input value
        }
    </script>
    <script>
        window.onscroll = function () {
            var scrollUpButton = document.getElementById("scrollUpButton");
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                scrollUpButton.style.display = "flex";
            } else {
                scrollUpButton.style.display = "none";
            }
        };

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>