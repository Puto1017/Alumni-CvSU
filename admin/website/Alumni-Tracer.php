<?php
require_once('main_db.php');

$userLoggedIn = isset($_SESSION['user_id']);
$userVerified = false;
$userExistsInPersonalInfo = false;

if ($userLoggedIn) {
    // Check if user exists in 'user' table (verified)
    $queryUser = "SELECT user_id FROM user WHERE user_id = ?";
    $stmtUser = $mysqli->prepare($queryUser);
    $stmtUser->bind_param("s", $_SESSION['user_id']);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();
    $userVerified = ($resultUser->num_rows > 0);
    $stmtUser->close();
}
if ($userVerified) {
    // Check if user exists in personal_info table
    $queryPersonalInfo = "SELECT user_id FROM personal_info WHERE user_id = ?";
    $stmtPersonal = $mysqli->prepare($queryPersonalInfo);
    $stmtPersonal->bind_param("s", $_SESSION['user_id']);
    $stmtPersonal->execute();
    $resultPersonal = $stmtPersonal->get_result();
    $userExistsInPersonalInfo = ($resultPersonal->num_rows > 0);
    $stmtPersonal->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Tracer</title>
</head>
<style>
    .ats-hero {
        color: white;
        padding: 80px 20px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
        min-height: 300px;
        height: 500px;
    }

    .ats-hero h2 {
        font-size: 32px;
        margin-bottom: 15px;
        font-weight: 700;
        position: relative;
        z-index: 2;
    }

    .ats-hero p {
        font-size: 16px;
        margin-bottom: 20px;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
        position: relative;
        z-index: 2;
    }

    .ats-hero .cta-btn {
        padding: 12px 25px;
        background: gold;
        color: black;
        border-radius: 25px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 40px;
        position: absolute;
        bottom: 100px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
        border: 2px solid transparent;
    }

    .ats-hero .cta-btn:hover {
        background: #92940e;
        transform: translateX(-50%) translateY(-2px);
    }

    .ats-hero::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        height: 500px;
        background-image: url('asset/images/bground.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        filter: brightness(0.4);
        z-index: 1;
    }

    @media (max-width: 768px) {
        .ats-hero {
            padding: 60px 15px;
            min-height: 250px;
        }

        .ats-hero h2 {
            font-size: 28px;
        }

        .ats-hero p {
            font-size: 15px;
            max-width: 100%;
            padding: 0 10px;
        }

        .ats-hero .cta-btn {
            padding: 10px 20px;
            font-size: 15px;
            bottom: 20px;
        }
    }

    @media (max-width: 480px) {
        .ats-hero {
            padding: 50px 10px;
            min-height: 220px;
        }

        .ats-hero h2 {
            font-size: 24px;
        }

        .ats-hero p {
            font-size: 14px;
            line-height: 1.5;
        }

        .ats-hero .cta-btn {
            padding: 8px 18px;
            font-size: 14px;
        }
    }
</style>

<body>
    <section class="ats-hero">
        <h2>Welcome to Alumni Statistics</h2>
        <p>You can view alumni data by querying the database for relevant metrics. This includes details like graduation year, employment status, and field of expertise. These insights help in understanding alumni trends and achievements.</p>
        <?php if (!$userLoggedIn || $userExistsInPersonalInfo): ?>
            <a href="#services" class="cta-btn" id="scroll-btn">View Alumni Tracer</a>

        <?php elseif ($userLoggedIn && !$userVerified): ?>
            <a href="Account?section=Verify-Account" class="cta-btn">Take the Alumni Tracer Survey</a>

        <?php else: ?>
            <a href="Account?section=Alumni-Tracer-Form" class="cta-btn">Take the Alumni Tracer Survey</a>
        <?php endif; ?>
    </section>


    <section id="services">


        <script>
            document.getElementById('scroll-btn').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default anchor behavior

                const targetElement = document.getElementById('services'); // Select the target element

                // Scroll to the target element smoothly
                targetElement.scrollIntoView({
                    behavior: 'smooth' // Enable smooth scrolling
                });
            });
        </script>

        <?php include('components/alumni_tracer/alumni-track-tracer.php'); ?>
    </section>

</body>

</html>