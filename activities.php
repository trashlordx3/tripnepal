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
        .trip-container {
            padding: 20px;
            max-width: 1000px;
            height: max-content;
            align-items: center;
            margin: 0 auto;
            transition: box-shadow 0.3s ease;
            border-radius: 5px;
        }

        .trip-container:hover {
            box-shadow: 0 4px 20px rgba(171, 169, 169, 0.5);
        }

        .content-section {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            border-bottom: 1px solid rgb(216, 210, 210);
        }

        .trip-info {
            margin-top: 20px;
        }

        .information {
            align-items: center;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .information .content-left {
            border-right: 1px solid rgb(216, 210, 210);
            width: 500px;
        }

        .information .content-right {
            padding-left: 10px;
        }

        .dates {
            display: flex;
        }

        .bottom-container ul {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            list-style-type: none;
        }

        .bottom-container button {
            background-color: rgb(198, 58, 31);
            border: none;
            height: 30px;
            padding: 4px;
            border-radius: 5px;
        }

        .next-departure li {
            list-style-type: none;
        }

        .discount-badge {
            background-color: #00c4b4;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 10px;
        }

        .featured-badge {
            margin: 10px;
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #ffcc00;
            color: #000;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .featured-badge i {
            margin-right: 5px;
        }

        .footer-container {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .dates-container {
            display: flex;
            flex-direction: column;
        }

        .title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }


        .dates {
            display: flex;
            align-items: center;
        }

        .dates span {
            margin-right: 20px;
            color: #333;
        }

        .dates span:last-child {
            margin-right: 0;
        }

        .button {
            text-decoration: none;
            background-color: #e67e22;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .button:hover {
            background-color: #00c4b4;
        }

        @media (max-width: 375px) {
            .trip-container {
                margin: 0 auto;
                flex-direction: column;
                align-items: center;
            }


            .dates {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<?php
include("frontend/header.php");
?>
<section style="  padding: 80px 15px 80px 15px;">
    <div class="trip-container">
        <div class="content-section">
            <div class="image-section">
                <img alt="Aerial view of a beautiful beach with turquoise water and white sand, surrounded by lush green palm trees."
                    src="assets/img/Manaslu.jpg"
                    style="width: 300px; height: 250px; margin: 10px; border-radius: 5px;" />
                <div class="featured-badge">
                    <i class="fas fa-star"></i>
                    Featured
                </div>
            </div>
            <div class="trip-info">
                <div class="title">
                    <h2 style="width:375x;">7 Days tour to Explore the Beauty of Philippines</h2>
                </div>
                <div class="information">
                    <div class="content-left">
                        <div style="margin: 5px 0px 5px 0px;">
                            <i class="fas fa-map-marker-alt" style="color: #00c4b4;"></i>
                            Maldives, Philippines
                        </div>
                        <div style="margin: 5px 0px 5px 0px;">
                            <i class="fas fa-calendar-alt" style="color: #00c4b4;"></i>
                            7 Days
                        </div>
                        <div style="margin: 5px 0px 5px 0px;">
                            <i class="fas fa-user-friends" style="color: #00c4b4;"></i>
                            2 People
                        </div>
                        <div class="descripton">
                            <p style="width: 350px;">Travel is the movement of people between relatively distant
                                geographical locations, and
                                can involve travel by foot, bicycle,...</p>
                        </div>
                    </div>
                    <div class="content-right">
                        <div class="discount-badge">8% Off</div>
                        <div class="price" style="margin-bottom: 5px;"><strong style="font-size: 20px;">$1,100</strong>
                            <del style="font-size: small;">$1,200</del>
                        </div>
                        <div class="next-departure">
                            <li><i class="fas fa-check" style="color: #00c4b4;"></i> Jan 22</li>
                            <li><i class="fas fa-check" style="color: #00c4b4;"></i> Jan 23</li>
                            <li><i class="fas fa-check" style="color: #00c4b4;"></i> Jan 24</li>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-container">
                <div class="dates-container">
                    <div class="title">Next Departure</div>
                    <div class="dates">
                        <span>January 22, 2025</span>
                        <span>January 23, 2025</span>
                        <span>January 24, 2025</span>
                    </div>
                </div>
                <a href="viewtrip.html" class="button">View Trip</a>
            </div>
        </div>
    </div>
</section>
<?php
include("frontend/footer.php");
?>
<?php
include("frontend/scrollup.html");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>