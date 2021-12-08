<?php

include './header.php';
require './dbconfig.php';
require './model.php';

$results = [];
$video_resutls = [];
if (isset($_GET['search_button'])) {
    $text  = $_GET['txtMessage'];
    $results = search_results($conn, $text);
    $video_resutls = search_videos($conn, $text);
} else {
    echo " <h3 class='my-5 text-center'> sorry invalid request </h3>";
}

if (sizeof($results) == 0 && sizeof($video_resutls) == 0) {
    echo " <h3 class='my-5 text-center'> result not found.. </h3>";
}

?>


<?php
if (sizeof($video_resutls) != 0) { ?>

<div class='col-lg-8 my-5  col-sm-12 col-md-8 offset-md-2 offset-lg-2'>


        <?php
        for ($i = 0; $i < sizeof($video_resutls); $i++) {
        ?>
            <div class="my-3 border shadow">             
                <div class="youtube-container ">
                    <iframe src="https://www.youtube.com/embed/<?php print_r(explode("https://youtu.be/", $video_resutls[$i][1])[1]); ?>" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="p-2">
                    <h5 class="font-weight-bold my-2"><?php print_r($video_resutls[$i][4]) ?> </h5>
                    <a class=""> <small class=""> Tag : <?php print_r($video_resutls[$i][2]) ?> </small> </a>
                    <a class="float-right"> <small class=""> @<?php print_r($video_resutls[$i][3]) ?> </small> </a>

                </div>

            </div>
        <?php } ?>

    </div>

<?php } ?>

<div class='col-lg-8 my-5  col-sm-12 col-md-8 offset-md-2 offset-lg-2'>

    <?php
    if (sizeof($results) != 0) {
        for ($i = 0; $i < sizeof($results); $i++) { ?>
            <div class='p-4 col-12  border border-top-0 border-left-0 border-right-0 shadow'>
                <small><span class='float-right'> @<?php print($results[$i][3]) ?> <small>Edited On Date : <?php print_r($results[$i][5]) ?> </small> </span> </small>
                <h5 class="font-weight-bold"> Q <?php print_r($i + 1) ?>. <?php print_r($results[$i][1]) ?> </h5>
                <p> Ans: <span class="text-success"><?php print_r($results[$i][2]) ?></span> </p>
                <small>Tag : <span class=""> <?php print_r($results[$i][4]) ?> </span></small>
            </div>

    <?php }
    }  ?>
</div>
<?php include './footer.php' ?>