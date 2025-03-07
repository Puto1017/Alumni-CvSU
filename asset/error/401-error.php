<?php
http_response_code(401); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>401 Error - Unauthorized</title>
    <?php include('../../asset/OOP/error-link/error-link.php'); ?>
</head>
<body>

    <?php include('../../asset/OOP/error-link/error-nav.php'); ?>

    <div class="error-container">
        <h1><i class="fas fa-exclamation-triangle"></i> 401</h1>
        <p class="error-message">Oops! You are not authorized to view this page.</p>
        <p class="error-suggestion">It seems like you need to log in to access this page. Please try the following:</p>
        <div class="error-suggestion-links">
            <a href="/Alumni-CvSU/index" class="error-home-button"><i class="fas fa-home"></i> Go to Home</a>
            <a href="/contact" class="error-contact-button"><i class="fas fa-phone-alt"></i> Contact Us</a>
        </div>
    </div>

    <?php include('../../asset/OOP/error-link/error-footer.php'); ?>
</body>
</html>
<style>
    body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #e8f5e9; 
    color: #2c6b2f; 
    line-height: 1.6;
}
a {
    text-decoration: none; 
    color: inherit; 
}

.error-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #388e3c;
    padding: 20px 30px;
    position: sticky;
    top: 0;
    z-index: 10;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.error-nav .error-logo {
    display: flex;
    align-items: center;
}

.error-nav .error-logo img {
    max-width: 40px;
    margin-right: 10px;
}

.error-nav .error-logo h1 {
    color: #fff;
    font-size: 28px;
    font-weight: 700;
    margin: 0;
}

.error-container {
    text-align: center;
    padding: 50px 20px;
    animation: fadeIn 1s ease-in-out;
}

.error-container h1 {
    font-size: 100px;
    color: #d32f2f;
    animation: bounce 1s infinite;
}

.error-container .error-message {
    font-size: 24px;
    margin: 20px 0;
    animation: fadeIn 2s ease-in-out;
}

.error-container .error-suggestion {
    font-size: 18px;
    margin: 20px 0;
    animation: fadeIn 2s ease-in-out;
}

.error-container .error-suggestion-links {
    margin: 20px 0;
}

.error-container .error-suggestion-links a {
    display: inline-block;
    margin: 10px;
    padding: 10px 20px;
    background-color: #388e3c;
    color: #fff;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.error-container .error-suggestion-links a:hover {
    background-color: #2c6b2f;
    transform: scale(1.1);
}

.error-footer {
    text-align: center;
    padding: 10px 20px; 
    background-color: #388e3c;
    color: white;
    font-size: 14px; 
}

.error-social-links {
    display: flex;
    justify-content: center; 
    gap: 15px;
    margin-bottom: 10px; 
}

.error-social-links a {
    font-size: 20px; 
    color: white;
    transition: transform 0.3s ease, color 0.3s ease;
}

.error-social-links a:hover {
    transform: scale(1.1);
    color: #66bb6a; 
}

.error-footer-content {
    margin-top: 5px;
    font-size: 12px;
}

.error-footer-content h2 {
    text-align: left;
    font-size: 16px;
    margin-bottom: 5px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-30px);
    }
    60% {
        transform: translateY(-15px);
    }
}
</style>