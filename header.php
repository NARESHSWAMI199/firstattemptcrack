<?php 
session_start([
    'cookie_lifetime' => 86400,
]);


$url = $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$opened_user =  parse_url($url);
?>
<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Attempt Cracker</title>
    <style>
        img[alt="www.000webhost.com"] {
            display: none
        }
    </style>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>



<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white">
    <a class="navbar-brand" href="./index.php">First Attempt Cracker</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse bg-white navbar-collapse" id="navbarSupportedContent">

        <form action="./search.php" method="get" class="form-inline pt-2 pl-5 my-lg-2">
            <input class="form-control mr-sm-2" type="search" name="txtMessage" id="txtMessage" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" name="search_button" type="submit">Search</button>
        </form>

        <ul class="navbar-nav pl-5 bg-white ml-auto">
            <li class="nav-item <?php if ($opened_user["path"] == "/index.php")  echo "active" ?>">
                <a class="nav-link" href="./index.php"> <i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link  <?php if ($opened_user["path"] == "/syllabus.php")  echo "active" ?>" href="./syllabus.php"> <i class="fa fa-book"></i> Syllabus</a>
            </li>


            <li class="nav-item">
                <a class="nav-link <?php if ($opened_user["path"] == "/first.php")  echo "active" ?>" href="./first.php"><i class="fa fa-question"></i> All Questions</a>
            </li>


            <li class="nav-item">
                <a class="nav-link  <?php if ($opened_user["path"] == "/buttons.php")  echo "active" ?>" href="./buttons.php"><i class="fa fa-file"></i> All PDF</a>
            </li>


            <li class="nav-item">
                <a class="nav-link <?php if ($opened_user["path"] == "/suggestions.php") echo 'active' ?>" href="./suggestions.php"><i class="fa fa-play"></i> All Video</a>
            </li>
            <?php if (isset($_SESSION["username"]) != '') { ?>
                <li class="nav-item <?php if ($opened_user["path"] == "/dashboard.php") echo 'active' ?>">
                    <a class="nav-link" href="./dashboard.php"><i class="fa fa-dashboard"></i> Your Dashboard</a>
                </li>
                <li class="nav-item">
                    <form action="./first.php" method="post">
                        <input type="hidden" name="url" value="<?php print_r($url) ?>" id="">
                        <button class="btn bg-white nav-link" name="logout" type="submit" style="padding-top:5px"> <i class="fa fa-sign-out"></i> Logout</button>
                    </form>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <button type="button" class="btn bg-white nav-link" data-toggle="modal" data-target="#exampleModal" style="padding-top:5px">
                        <span><i class="fa fa-sign-in"></i> Login</span>
                    </button>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>

<body class="body pt-5">
    <script type="text/javascript" src="./gtransapi.js"></script>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script type="text/javascript" src="./gtransapi.js"></script>


    <div class="my-5">

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="./dashboard.php" method="post">
                            <input type="hidden" class="form-control" id="url" name="url" value="<?php print_r($url) ?>" />
                            <label for="form-group">Username :</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your name : " />
                            <label for="">Passowrd : </label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Enter your password : " />
                            <input class=" w-100 btn btn-primary mt-2" name="login" type="submit" value="Let's Enter !!">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="header"></div>