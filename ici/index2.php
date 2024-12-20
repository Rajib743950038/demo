<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suspension Notice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #1b2735, #090a0f, #282c34, #1c1f26);
        background-size: 400% 400%;
        color: #fff;
        animation: gradientBackground 15s ease infinite;
        overflow: hidden;
        text-align: center;
    }

    @keyframes gradientBackground {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .content {
        background: rgba(0, 0, 0, 0.8);
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        max-width: 600px;
        animation: fadeIn 2s;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .content .icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #ff9c00;
    }

    .content h1 {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .content p {
        font-size: 1.2rem;
        margin: 1rem 0;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1.5rem;
        border: none;
        border-radius: 5px;
        background-color: #25D366;
        color: #fff;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s, color 0.3s;
        text-decoration: none;
    }

    .btn:hover {
        background-color: #1DA851;
    }

    .btn i {
        margin-right: 0.5rem;
    }

    .footer {
        font-size: 0.8rem;
        margin-top: 1rem;
    }

    .circle-logo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 0 auto 1rem auto;
    }

    .circle-logo img {
        width: 100%;
        height: auto;
        border-radius: 50%;
    }
    </style>
</head>

<body>
    <div class="content">
        <!-- <div class="circle-logo">
            <img src="img/logo.jpg" alt="Logo">
        </div> !----->
        <!--     <i class="fas fa-ban icon"></i> --->
        <h1>App Suspended</h1>
        <p>Your app has been suspended because your time has expired and you have not made the required payment. Please
            contact the developer on WhatsApp for assistance.</p>
        <p>Developer Number: 7050186049</p>
        <a class="btn" href="https://wa.me/917050186049">
            <i class="fab fa-whatsapp"></i> Contact Developer
        </a>
        <p class="footer">Powered by CB Admin</p>
    </div>
</body>

</html>