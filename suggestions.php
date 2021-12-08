<?php include './header.php';
require './view.php';


if (isset($_POST['video_delete'])) {
    $id  = $_POST['id'];

    delete_video($conn, $id);
    ?>

    <script>
        window.location.reload();
    </script>

    <?php
}


if (isset($_POST['video_submit'])) {
    $url  = $_POST['url'];
    $title  = $_POST['title'];
    $username  = $_SESSION["username"];
    $tag  = $_POST['tag'];
    insert_video($conn, $url, $title, $username, $tag);
}


$results = get_all_video_view($conn);

if (isset($_GET['search_video'])) {
    $text  = $_GET['text'];
    $results = search_videos($conn, $text);
}
?>




<div class='col-lg-8 my-5  col-sm-12 col-md-8 offset-md-2 offset-lg-2'>

    <?php for ($i = 0; $i < sizeof($results); $i++) {
    ?>
        <div class="my-3 border shadow">
            <?php
            if ($_SESSION  &&  $_SESSION["username"] == $results[$i][3]) { ?>
                <small>
                    <form class="m-2 float-right" method="post" action="./suggestions.php">
                        <input type="hidden" name="id" value="<?php print_r($results[$i][0]) ?>" />
                        <button type="submit" class="btn btn-white" onclick="return confirm('Are you sure you want to delete?')" name="video_delete"> <i class="fa fa-trash"></i> </button>
                    </form>
                </small>
            <?php } ?>

            <div class="youtube-container ">
                <iframe src="https://www.youtube.com/embed/<?php print_r(explode("https://youtu.be/", $results[$i][1])[1]); ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="p-2">
                <h5 class="font-weight-bold my-2"><?php print_r($results[$i][4]) ?> </h5>
                <a class=""> <small class=""> Tag : <?php print_r($results[$i][2]) ?> </small> </a>
                <a class="float-right"> <small class=""> @<?php print_r($results[$i][3]) ?> </small> </a>

            </div>

        </div>
    <?php } ?>
    <?php
    if ($_SESSION && $_SESSION["username"]) {  ?>
        <div class="my-5">
            <?php uploadVideos($conn) ?>
        </div>
    <?php }; ?>
</div>

<?php include './footer.php' ?>