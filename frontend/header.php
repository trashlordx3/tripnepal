<div class="header-section">
    <div class="bg-teal text-white py-2 fixed-top top-header" id="topHeader">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a href="#">
                    <i class="fab fa-facebook-f" id="social-icon">
                    </i>
                </a>
                <a href="#">
                    <i class="fab fa-twitter" id="social-icon">
                    </i>
                </a>
                <a href="#">
                    <i class="fab fa-instagram" id="social-icon">
                    </i>
                </a>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3"><i class="fas fa-phone" id="social-icon"></i> <a href="tel:+977 9742847684"
                        style="color:white; text-decoration:none;">9741847684</a></span>
                <span><i class="fas fa-envelope" id="social-icon"></i>
                    <a href="mailto:contact@gmail.com"
                        style="color:white; text-decoration:none;">contact@gmail.com</a></span>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="index" style="align-items: center;">
                <img src="assets/img/logo.jpg" alt="Logo" width="50" height="40" class="d-inline-block align-text-top">
                <span>NepalTrip</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="destinationDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Destination</a>
                        <ul class="dropdown-menu" aria-labelledby="destinationDropdown">
                            <li><a class="dropdown-item" href="#">Kathmandu</a></li>
                            <li><a class="dropdown-item" href="#">Pokhara</a></li>
                            <li><a class="dropdown-item" href="destination">More</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="activitiesDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Activities</a>
                        <ul class="dropdown-menu" aria-labelledby="activitiesDropdown">
                            <li><a class="dropdown-item" href="#">Trekking</a></li>
                            <li><a class="dropdown-item" href="#">Tour </a></li>
                            <li><a class="dropdown-item" href="activity">More</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tripTypesDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Trip Types</a>
                        <ul class="dropdown-menu" aria-labelledby="tripTypesDropdown">

                            <li><a class="dropdown-item" href="nature">Nature Friendly</a></li>
                            <li><a class="dropdown-item" href="cultural">Cultural</a></li>
                            <li><a class="dropdown-item" href="budget">Budget Travel</a></li>

                            <li><a class="dropdown-item" href="triptype">More</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                        <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                            <li><a class="dropdown-item" href="aboutus">About Us</a></li>
                            <li><a class="dropdown-item" href="#">Our Team</a></li>
                            <li><a class="dropdown-item" href="#">FAQ'S</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="contactus">Contact</a></li>
                </ul>
                <div class="d-flex">
                    <a href="login" class="nav-link">Login</a>|
                    <a href="signup" class="nav-link">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>
    <script>
        // JavaScript to hide top header on scroll
        const topHeader = document.getElementById('topHeader');
        const mainNavbar = document.getElementById('mainNavbar');
        let lastScrollTop = 0;

        window.addEventListener('scroll', () => {
            let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > lastScrollTop) {
                // Scrolling down
                topHeader.classList.add('top-header-hidden');
                mainNavbar.classList.add('show-navbar');
            } else {
                // Scrolling up
                topHeader.classList.remove('top-header-hidden');
                mainNavbar.classList.remove('show-navbar');
            }

            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        });
    </script>
</div>
<div style="height:110px"></div>