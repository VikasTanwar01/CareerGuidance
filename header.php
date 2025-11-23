<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Intelligent Career Guidance</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom stylesheet -->
    <link type="text/css" rel="stylesheet" href="css/s.css"/>
</head>

<body>

<!-- Header -->
<header id="header" class="transparent-nav" style="position: fixed; background-color: rgb(120, 70, 167); top: 0;">
    <div class="container">

        <div class="navbar-header">
            <!-- Logo -->
            <div class="navbar-brand">
                <a class="logo" href="http://localhost/career/main.php">Career.ly</a>
            </div>
            <!-- /Logo -->

            <!-- Mobile toggle -->
            <button class="navbar-toggle">
                <span></span>
            </button>
        </div>

        <?php
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true):
        ?>

        <!-- Navigation for NOT logged-in users -->
        <nav id="nav">
            <ul class="main-menu nav navbar-nav navbar-right">
                <li><a href="http://localhost/career/main.php">Home</a></li>

                <li class="dropdown">
                    <a class="dropbtn" href="javascript:void(0)">Services <span>&#11167;</span></a>
                    <div class="dropdown-content">
                        <a href="http://localhost:5000/">Career Prediction</a>
                        <a href="http://localhost/career/courses.php">Courses</a>
                        <a href="http://localhost/career/blog.php">Knowledge Network</a>
                    </div>
                </li>

                <li><a href="http://localhost/career/main.php#about">About Us</a></li>
                <li><a href="http://localhost/career/contact.php">Contact Us</a></li>
                <li><a href="http://localhost/career/login.php">Login</a></li>
                <li><a href="http://localhost/career/register.php">Register</a></li>
            </ul>
        </nav>

        <?php else: ?>

        <!-- Navigation for LOGGED-IN users -->
        <nav id="nav">
            <ul class="main-menu nav navbar-nav navbar-right">
                <li><a href="http://localhost/career/main.php">Home</a></li>

                <li class="dropdown">
                    <a class="dropbtn" href="javascript:void(0)">Services <span>&#11167;</span></a>
                    <div class="dropdown-content">
                        <a href="http://localhost:5000/">Career Prediction</a>
                        <a href="http://localhost/career/courses.php">Courses</a>
                        <a href="http://localhost/career/blog.php">Knowledge Network</a>
                    </div>
                </li>

                <li><a href="http://localhost/career/main.php#about">About Us</a></li>
                <li><a href="http://localhost/career/contact.php">Contact Us</a></li>
                <li><a href="http://localhost/career/logout.php">Log out</a></li>
            </ul>
        </nav>

        <?php endif; ?>

    </div>
</header>

<!-- Chatbot -->
<link rel="stylesheet" href="/career/static/css/chatbot.css">

<div id="chatbot-toggle">💬</div>

<div id="chatbot-container">
    <div id="chatbot-header">Career Chatbot</div>
    <div id="chatbot-messages"></div>

    <div id="chatbot-input">
        <textarea id="chatbot-text" placeholder="Type a message..."></textarea>
        <button id="chatbot-send">Send</button>
    </div>
</div>

<script src="/career/static/js/chatbot.js"></script>
