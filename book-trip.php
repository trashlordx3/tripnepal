<?php

if (isset($_GET['tripname'])) {
    $tripname = $_GET['tripname'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="index.css">

    <style>
        .py-5 {
            display: flex;
            gap: 2rem;
            justify-content: space-between;
        }

        .book-container {
            width: 70%;
            padding: 5px;
            border-radius: 5px;

        }

        .right-container {
            width: max-content;
        }

        .book-title {
            background-color: #008080 !important;
        }

        .error {
            color: red;
        }

        .hero {
            background: url('assets/img/pk.jpg') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 90px 20px;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.5rem;
        }

        .booking-right {
            width: 30%;
        }

        .right-trips-link {
            width: 100%;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php
    include("frontend/header.php");
    ?>
    <header class="hero">
        <h1>Booking Form</h1>
        <p>Your trusted partner for unforgettable journeys around the globe.</p>
    </header>
    <div class="features">
        <div class="container py-5 ">
            <div class="book-container">
                <div class="container bg-white">
                    <h1 class="mb-4">
                        TRIP BOOKING FORM
                    </h1>
                    <form id="inquiryForm" novalidate="">
                        <!-- Trip Details -->
                        <div class="mb-4">
                            <div class="bg-success text-white p-2 mb-2 book-title">
                                Trip Details :
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>
                                        Trip Id : 2323
                                    </label>
                                    <label>
                                        Trip Name : <h1>Helloasjdfjasdfjas alsdjflkasj dflalskjd flkajs fl jasl dfj</h1>
                                    </label>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>
                                        No. of person :
                                    </label>
                                    <select class="form-control" id="adults" required="">
                                        <option value="">
                                            Select Adults (12+)
                                        </option>
                                        <option value="1">
                                            1
                                        </option>
                                        <option value="2">
                                            2
                                        </option>
                                    </select>
                                    <div class="error" id="adultsError">
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>
                                        Children (&gt;12) :
                                    </label>
                                    <select class="form-control" id="children" required="">
                                        <option value="">
                                            Select Children (&gt;12)
                                        </option>
                                        <option value="0">
                                            0
                                        </option>
                                        <option value="1">
                                            1
                                        </option>
                                    </select>
                                    <div class="error" id="childrenError">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Personal Details -->
                        <div class="mb-4">
                            <div class="bg-success text-white p-2 mb-2 book-title">
                                Personal Details :
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>
                                        Full Name :
                                    </label>
                                    <input class="form-control" id="fullName" required="" type="text" />
                                    <div class="error" id="fullNameError">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>
                                        Email :
                                    </label>
                                    <input class="form-control" id="email" required="" type="email" />
                                    <div class="error" id="emailError">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>
                                        Address :
                                    </label>
                                    <input class="form-control" id="address" required="" type="text" />
                                    <div class="error" id="addressError">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>
                                        Tel / Mobile :
                                    </label>
                                    <input class="form-control" id="tel" required="" type="tel" />
                                    <div class="error" id="telError">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>
                                        City :
                                    </label>
                                    <input class="form-control" id="city" required="" type="text" />
                                    <div class="error" id="cityError">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>
                                        Country :
                                    </label>
                                    <input class="form-control" id="city" required="" type="text" />
                                    <div class="error" id="countryError">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Arrival Details -->
                        <div class="mb-4">
                            <div class="bg-success text-white p-2 mb-2 book-title book-title">
                                Arrival Details :
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>
                                        Arrival Date :
                                    </label>
                                    <input class="form-control" id="arrivalDate" required="" type="date" />
                                    <div class="error" id="arrivalDateError">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>
                                        Departure Date :
                                    </label>
                                    <input class="form-control" id="departureDate" required="" type="date" />
                                    <div class="error" id="departureDateError">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>
                                        Airlines :
                                    </label>
                                    <input class="form-control" id="airlines" required="" type="text" />
                                    <div class="error" id="airlinesError">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>
                                        Flight No :
                                    </label>
                                    <input class="form-control" id="flightNo" required="" type="text" />
                                    <div class="error" id="flightNoError">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>
                                        Arrival Time :
                                    </label>
                                    <input class="form-control" id="arrivalTime" required="" type="time" />
                                    <div class="error" id="arrivalTimeError">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>
                                        Airport Pickup :
                                    </label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-radio-input" id="pickupYes" name="pickup" required=""
                                            type="radio" value="yes" />
                                        <label class="form-check-label" for="pickupYes">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-radio-input" id="pickupNo" name="pickup" required=""
                                            type="radio" value="no" />
                                        <label class="form-check-label" for="pickupNo">
                                            No
                                        </label>
                                    </div>
                                    <div class="error" id="pickupError">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>
                                        Message :
                                    </label>
                                    <textarea class="form-control" id="message"
                                        placeholder="Any message you want to leave?" required="" rows="4"></textarea>
                                    <div class="error" id="messageError">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Payment Method -->
                        <div class="mb-4">
                            <div class="bg-success text-white p-2 mb-2 book-title">
                                Payment Method :
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>
                                        Mode of Payment:
                                    </label>
                                    <select class="form-control" id="paymentMode" required="">
                                        <option value="">
                                            Select Payment Mode
                                        </option>
                                        <option value="Paypal">
                                            Paypal
                                        </option>
                                    </select>
                                    <div class="error" id="paymentModeError">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <input class="mr-2" id="notRobot" required="" type="checkbox" />
                                    <label class="mr-2">
                                        I'm not a robot
                                    </label>
                                    <img alt="reCAPTCHA verification" class="img-fluid" height="50"
                                        src="https://storage.googleapis.com/a1aa/image/gXTOh7QaVJ0xctIwQI9PNHXYjL0ypahPF8sCScd6J-U.jpg"
                                        width="100" />
                                    <div class="error" id="notRobotError">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="text-center">
                            <button class="btn btn-warning text-white px-5" type="submit">
                                Book Now
                            </button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="booking-right">
                <div class="container bg-white">
                    <h1 class="mb-4" style="color: white;"> I</h1>
                    <div class="mb-4">
                        <div class="mb-4">
                            <div class="bg-success text-white p-2 mb-2 book-title">
                                Best Deals
                            </div>
                            <div class="right-trips-link">
                                <div class="md-6
                                ">
                                    <i class="fas fa-hand-point-right" style="color:green; margin-right:10px;"></i><a
                                        href="">Trip to Kathmandu
                                        Valley</a>
                                </div>
                                <div class="md-6
                                ">
                                    <i class="fas fa-hand-point-right" style="color:green; margin-right:10px;"></i><a
                                        href="">Trip to Kathmandu
                                        Valley</a>
                                </div>
                                <div class="md-6
                                ">
                                    <i class="fas fa-hand-point-right" style="color:green; margin-right:10px;"></i><a
                                        href="">Trip to Kathmandu
                                        Valley</a>
                                </div>
                                <div class="md-6
                                ">
                                    <i class="fas fa-hand-point-right" style="color:green; margin-right:10px;"></i><a
                                        href="">Trip to Kathmandu
                                        Valley</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="mb-4">
                            <div class="bg-success text-white p-2 mb-2 book-title">
                                Best Deals
                            </div>
                            <div class="right-trips-link">
                                <div class="md-6">
                                    <i class="fas fa-hand-point-right" style="color:green; margin-right:10px;"></i><a
                                        href="">Trip to Kathmandu
                                        Valley</a>
                                </div>
                                <div class="md-6">
                                    <i class="fas fa-hand-point-right" style="color:green; margin-right:10px;"></i><a
                                        href="">Trip to Kathmandu
                                        Valley</a>
                                </div>
                                <div class="md-6">
                                    <i class="fas fa-hand-point-right" style="color:green; margin-right:10px;"></i><a
                                        href="">Trip to Kathmandu
                                        Valley</a>
                                </div>
                                <div class="md-6">
                                    <i class="fas fa-hand-point-right" style="color:green; margin-right:10px;"></i><a
                                        href="">Trip to Kathmandu
                                        Valley</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
    </script>
    <script>
        document.getElementById('inquiryForm').addEventListener('submit', function (event) {
            event.preventDefault();
            let isValid = true;

            // Validate Adults
            const adults = document.getElementById('adults');
            const adultsError = document.getElementById('adultsError');
            if (adults.value === '') {
                adultsError.textContent = 'Please select the number of adults.';
                isValid = false;
            } else {
                adultsError.textContent = '';
            }

            // Validate Children
            const children = document.getElementById('children');
            const childrenError = document.getElementById('childrenError');
            if (children.value === '') {
                childrenError.textContent = 'Please select the number of children.';
                isValid = false;
            } else {
                childrenError.textContent = '';
            }

            // Validate Full Name
            const fullName = document.getElementById('fullName');
            const fullNameError = document.getElementById('fullNameError');
            if (fullName.value.trim() === '') {
                fullNameError.textContent = 'Please enter your full name.';
                isValid = false;
            } else {
                fullNameError.textContent = '';
            }

            // Validate Email
            const email = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email.value)) {
                emailError.textContent = 'Please enter a valid email address.';
                isValid = false;
            } else {
                emailError.textContent = '';
            }

            // Validate Address
            const address = document.getElementById('address');
            const addressError = document.getElementById('addressError');
            if (address.value.trim() === '') {
                addressError.textContent = 'Please enter your address.';
                isValid = false;
            } else {
                addressError.textContent = '';
            }

            // Validate Tel / Mobile
            const tel = document.getElementById('tel');
            const telError = document.getElementById('telError');
            const telPattern = /^[0-9]{10}$/;
            if (!telPattern.test(tel.value)) {
                telError.textContent = 'Please enter a valid 10-digit phone number.';
                isValid = false;
            } else {
                telError.textContent = '';
            }
            // validate city
            const cityName = document.getElementById('city`');
            const cityError = document.getElementById('cityError');
            if (fullName.value.trim() === '') {
                cityError.textContent = 'Please enter your city name.';
                isValid = false;
            } else {
                cityError.textContent = '';
            }
            // Validate Country
            const country = document.getElementById('country');
            const countryError = document.getElementById('countryError');
            if (country.value === '') {
                countryError.textContent = 'Please select your country.';
                isValid = false;
            } else {
                countryError.textContent = '';
            }

            // Validate Arrival Date
            const arrivalDate = document.getElementById('arrivalDate');
            const arrivalDateError = document.getElementById('arrivalDateError');
            if (arrivalDate.value === '') {
                arrivalDateError.textContent = 'Please select your arrival date.';
                isValid = false;
            } else {
                arrivalDateError.textContent = '';
            }

            // Validate Departure Date
            const departureDate = document.getElementById('departureDate');
            const departureDateError = document.getElementById('departureDateError');
            if (departureDate.value === '') {
                departureDateError.textContent = 'Please select your departure date.';
                isValid = false;
            } else {
                departureDateError.textContent = '';
            }

            // Validate Airlines
            const airlines = document.getElementById('airlines');
            const airlinesError = document.getElementById('airlinesError');
            if (airlines.value.trim() === '') {
                airlinesError.textContent = 'Please enter your airlines.';
                isValid = false;
            } else {
                airlinesError.textContent = '';
            }

            // Validate Flight No
            const flightNo = document.getElementById('flightNo');
            const flightNoError = document.getElementById('flightNoError');
            if (flightNo.value.trim() === '') {
                flightNoError.textContent = 'Please enter your flight number.';
                isValid = false;
            } else {
                flightNoError.textContent = '';
            }

            // Validate Arrival Time
            const arrivalTime = document.getElementById('arrivalTime');
            const arrivalTimeError = document.getElementById('arrivalTimeError');
            if (arrivalTime.value === '') {
                arrivalTimeError.textContent = 'Please select your arrival time.';
                isValid = false;
            } else {
                arrivalTimeError.textContent = '';
            }

            // Validate Airport Pickup
            const pickupYes = document.getElementById('pickupYes');
            const pickupNo = document.getElementById('pickupNo');
            const pickupError = document.getElementById('pickupError');
            if (!pickupYes.checked && !pickupNo.checked) {
                pickupError.textContent = 'Please select if you need airport pickup.';
                isValid = false;
            } else {
                pickupError.textContent = '';
            }

            // Validate Message
            const message = document.getElementById('message');
            const messageError = document.getElementById('messageError');
            if (message.value.trim() === '') {
                messageError.textContent = 'Please enter a message.';
                isValid = false;
            } else {
                messageError.textContent = '';
            }

            // Validate Payment Mode
            const paymentMode = document.getElementById('paymentMode');
            const paymentModeError = document.getElementById('paymentModeError');
            if (paymentMode.value === '') {
                paymentModeError.textContent = 'Please select a payment mode.';
                isValid = false;
            } else {
                paymentModeError.textContent = '';
            }

            // Validate Not a Robot
            const notRobot = document.getElementById('notRobot');
            const notRobotError = document.getElementById('notRobotError');
            if (!notRobot.checked) {
                notRobotError.textContent = 'Please confirm you are not a robot.';
                isValid = false;
            } else {
                notRobotError.textContent = '';
            }

            if (isValid) {
                alert('Form submitted successfully!');
                // You can add form submission logic here
            }
        });
    </script>
    </div>
    </div>
</body>

</html>

</div>
</div>
<?php
include("frontend/footer.php");
?>
<div class="scroll-up" id="scrollUpButton" onclick="scrollToTop()">
    <i class="fas fa-chevron-up"></i>
</div>
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