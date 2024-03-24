<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Website</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .carousel-inner,
        .carousel-item,
        .carousel-item img {
            width: 100%;
            height: 100vh;
            /* Set the height to full viewport height */
            object-fit: cover;
           
        }

        .header-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 100;
            
        }

        .about-section {
            padding: 20px;
            background-color: #f8f9fa;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-interval="5000"> <!-- Set interval to 5000ms -->
                <img src="img/image1.jpg" class="d-block w-100" alt="...">
                <div class="header-buttons">
                    <a href="login.php" class="btn btn-primary mr-2">Login</a>
                    <a href="registration.php" class="btn btn-secondary">Sign Up</a>
                </div>
            </div>
            <div class="carousel-item" data-interval="5000">
                <div class="header-buttons">
                    <a href="login.php" class="btn btn-primary mr-2">Login</a>
                    <a href="registration.php" class="btn btn-secondary">Sign Up</a>
                </div>
                <img src="img/image2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-interval="5000">
                <div class="header-buttons">
                    <a href="login.php" class="btn btn-primary mr-2">Login</a>
                    <a href="registration.php" class="btn btn-secondary">Sign Up</a>
                </div>
                <img src="img/image3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="about-section">
        <h2>About Us</h2>
        <p>add somthing.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>