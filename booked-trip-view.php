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

    </script>
    <style>
        .top-container {
            width: 80%;
            margin: 0 auto;
            height: max-content;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout-btn {
            border: 1px solid gray;
            text-decoration: none;
            font-size: 1rem;
            padding: 5px 10px 5px 10px;
            border-radius: 10px;
            color: gray;
            min-width: 100px;
            transition: color 0.3s, border-bottom 0.3s;

        }

        .logout-btn:hover {
            box-shadow: 0px 1px 0px gray;
        }

        .navigation-menu {
            display: flex;
            width: 80%;
            margin: 0 auto;
            padding: 20px 0px 40px 0px;

        }

        .nav-btn {
            text-decoration: none;
            /* Remove underline */
            color: blue;
            /* Default text color */
            padding: 10px;
            transition: color 0.3s, border-bottom 0.3s;
            /* Smooth transition */
        }

        .nav-btn:hover {
            color: darkblue;
            /* Change color on hover */
        }

        .nav-btn.active {
            color: #008080;
            /* Change color when active */
            border-bottom: 2px solid #008080;
            /* Underline effect */

        }

        .user-contents {
            max-width: 80%;
            margin: 0 auto;

            justify-content: space-between;
            display: flex;
        }

        .user-contents img {
            border-radius: 10px;
        }

        .paynow {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .paynow-btn {
            font-weight: bolder;
            font-size: 20px;
            border-radius: 5px;
            text-decoration: none;
            padding: 20px;
            border: 1px solid gray;
            color: #008080;
        }

        .paynow-btn:first-of-type {
            color: white;
            background-color: #008080;
        }

        .booking-image {
            display: flex;
            flex-direction: column;
        }

        .booking-image a {
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            font-weight: 300;
        }

        .trip-information .trip-time {}

        @media (max-width: 768px) {
            .profile-top {
                display: flex;
                flex-direction: column;
            }

            .user-contents {
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: 20px;
            }



        }
    </style>
</head>

<body>
    <?php
    include("frontend/header.php");
    ?>
    <div class="features">
        <div class="container py-5 ">
            <div class="top-container">
                <div class="profile-top" style="display: flex; gap: 20px; align-items: center;">
                    <img id="profilePic" alt="User profile picture" height="80"
                        src="https://storage.googleapis.com/a1aa/image/lYqBODwnaMU-b05_oodpY-_9bnJPEcMy7zRIn0c6F8k.jpg"
                        width="80" style="border-radius: 20%; cursor: pointer;" />


                    <h1 class="">
                        Welcome suresh!
                    </h1>
                </div>
                <a class="logout-btn" href="login" onclick="return confirm('Are you sure want to logout?');">
                    <i class="fas fa-sign-out-alt mr-2">
                    </i>
                    Log Out
                </a>

            </div>
            <div class="navigation-menu">
                <a href="my-account" class="nav-btn"><i class="fas fa-arrow-left"></i>
                    Go Back</a>
            </div>
            <div class="user-contents">
                <h1>Your Bookings Details</h1>
            </div>
            <div class="user-contents">
                <div class="booking-image">
                    <img src="assets/img/lumbini.jpg" alt="" height="200" width="200">
                    <a href="view-trip" class="paynow-btn">View Trip</a>
                </div>
                <div class="billing-details">
                    <h2>Trip Information</h2>
                    <div class=" trip-information">
                        <h3>7 Days Mustang trek</h3>
                        <span>Trip Code : </span> <span>WTF-234</span>
                        <div class="trip-time">
                            <span>Trip Start Date: </span>
                            <span>Feb 1, 2026</span><br>
                            <span>Trip End Date: </span>
                            <span>Feb 1, 2026</span><br>
                            <span>Duration: </span>
                            <span>7 Days</span>
                        </div>
                    </div>
                </div>
                <div class="booking-details">
                    <h2>Billing Information</h2>
                    <table>
                        <tr>
                            <td>Name : </td>
                            <td> Suresh</td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td>sureshjimba@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Address: </td>
                            <td>New York</td>
                        </tr>
                        <tr>
                            <td>Country: </td>
                            <td>US</td>
                        </tr>
                        <tr>
                            <td>Contact : </td>
                            <td>+977 234234234</td>
                        </tr>
                    </table>
                    <h5>Travellers</h5>
                    <div>
                        <span>No. of person: 2</span>
                    </div>
                    <h5>Extra Services</h5>
                    <div>
                        <span>Pickup from Kathmandu Airport: 1</span>
                    </div>

                </div>
                <div class="payment-details">
                    <h5>Payment Details</h5>
                    <div><span>Total: </span> <span>$ 400</span> </div>
                    <div><span>Status: </span> <span>Pending</span></div>
                    <div>
                        <div class="mb-4">
                            <div class="bg-success text-white p-2 mb-2 book-title">
                                Payment Method :
                            </div>
                            <label style="margin-left:20px;">
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
                            <div
                                style="display: flex; justify-content:space-between; align-items:center; padding: 20px 0px 20px 0px;">
                                <input class="mr-2" id="notRobot" required="" type="checkbox" />
                                <label class="mr-2">
                                    I'm not a robot
                                </label>
                                <img alt="reCAPTCHA verification" class="img-fluid" height="50"
                                    src="https://storage.googleapis.com/a1aa/image/gXTOh7QaVJ0xctIwQI9PNHXYjL0ypahPF8sCScd6J-U.jpg"
                                    width="50" />
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button class="btn btn-warning text-white px-5" type="submit">
                            Pay Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-success text-white p-2 mb-2 book-title"></div>

    <?php
    include("frontend/footer.php");
    ?>
    <div class=" scroll-up" id="scrollUpButton" onclick="scrollToTop()">
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