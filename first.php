<?php include './header.php';
require './dbconfig.php';
require './view.php';



$opened_user =  parse_url($url);
// print_r($opened_user);

$opened_tag = "";
$opened_page = "";
$opened_page_num = "";
// echo $opened_tag;
$per_page_record = 30;
$tag = "";
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
    // $opened_page = explode("according=", $opened_user["query"]);
    // print_r($opened_page);
    $opened_page_num = $page;
    if ($_GET["tag"]) {
        $tag = $_GET["tag"];
    } else {
        $tag = "";
    }
    if ($tag != "") {
        $opened_tag = $tag;
        $start_from = ($page - 1) * $per_page_record;
        $results = get_all_according_tag($conn, $start_from, $per_page_record, $tag);
        if ($tag == "all") {
            $total_records = total_row($conn, $tag);
        } else {
            $total_records = total_row_according_tag($conn, $tag);
        }

        $total_pages = ceil($total_records / $per_page_record);
    } else {
        $start_from = ($page - 1) * $per_page_record;
        $total_records = total_row($conn, $tag);
        $total_pages = ceil($total_records / $per_page_record);
        $results = get_all($conn, $start_from, $per_page_record);
    }
} else {
    $page = 1;
    $start_from = ($page - 1) * $per_page_record;
    $total_records = total_row($conn);
    $total_pages = ceil($total_records / $per_page_record);
    $results = get_all($conn, $start_from, $per_page_record);
}
if (isset($_GET['according'])) {
    $opened_tag = explode("according=", $opened_user["query"])[1];
    $tag = $_GET["according"];
    $page = 1;
    if ($opened_page_num != "") {
        $opened_page = explode("&", $opened_user["query"])[1];
        $opened_page_num = explode("page=", $opened_page)[1];
        $page  = $opened_page_num;
    }
    if ($_GET['according'] == "all") {
        $start_from = ($page - 1) * $per_page_record;
        $total_records = total_row($conn, $tag);
        $results = get_all($conn, $start_from, $per_page_record);
        $total_pages = ceil($total_records / $per_page_record);
    } else {
        $start_from = ($page - 1) * $per_page_record;
        $results = get_all_according_tag($conn, $start_from, $per_page_record, $tag);
        $total_records = total_row_according_tag($conn, $tag);
        $results = get_all_according_tag($conn, $start_from, $per_page_record, $tag);
        $total_pages = ceil($total_records / $per_page_record);
    }
}




if (isset($_POST['delete'])) {
    $id  = $_POST['id'];
    delete($conn, $id);
?>

    <script>

        window.location.reload();
    </script>

    <?php
}


if (isset($_POST["logout"])) {
    session_destroy();
    $url = $_POST["url"];
    $opened_user =  parse_url($url);

    if ($opened_user["path"] == '/first.php' || $opened_user["path"] == '/dashboard.php') {
    ?>
        <script>
            window.location.href = "<?php print_r($url) ?>"
        </script>
    <?php

    } else { ?>
        <script>
            window.location.href = "./dashboard.php";
        </script>
<?php
    }
}
?>





<div class="container-fluid">
    <nav class="nav nav-pills mt-5 nav-fill">
        <form class="nav-item" action="./first.php" id="all" method="get">
            <input type="hidden" name="according" value="all" />
            <a class="text-dark nav-link" href="javascript:$('#all').submit();">All Type</a>
        </form>
        <form class="nav-item" action="./first.php" id="history" method="get">
            <input type="hidden" value="history" name="according" value="all" />
            <a class="text-dark nav-link" href="javascript:$('#history').submit();">History</a>
        </form>
        <form class="nav-item" action="./first.php" id="geography" method="get">
            <input type="hidden" value="geography" name="according" value="all" />
            <a class="text-dark nav-link" href="javascript:$('#geography').submit();">Geography</a>
        </form>
        <form class="nav-item" action="./first.php" id="gernalscience" method="get">
            <input type="hidden" value="gernalscience" name="according" value="all" />
            <a class="text-dark nav-link" href="javascript:$('#gernalscience').submit();">Gernal Science</a>
        </form>
        <form class="nav-item" action="./first.php" id="cultural" method="get">
            <input type="hidden" value="cultural" name="according" value="all" />
            <a class="text-dark nav-link" href="javascript:$('#cultural').submit();">Art & Cultural</a>
        </form>
        <form class="nav-item" action="./first.php" id="currentgk" method="get">
            <input type="hidden" value="currentgk" name="according" value="all" />
            <a class="text-dark nav-link" href="javascript:$('#currentgk').submit();">Current Affairs</a>
        </form>
        <form class="nav-item" action="./first.php" id="other" method="get">
            <input type="hidden" value="other" name="according" value="all" />
            <a class="text-dark nav-link" href="javascript:$('#other').submit();">All Other</a>
        </form>
    </nav>

</div>
<div class='col-lg-8 my-5  col-sm-12 col-md-8 offset-md-2 offset-lg-2'>
    <div class='row justify-content-center'>
        <?php
        $question = ($page * $per_page_record) - $per_page_record;

        if (sizeof($results) != 0) {
            for ($i = 0; $i < sizeof($results); $i++) {
                $question += 1;
        ?>
                <div id="history" class='p-4 col-12 history border border-top-0 border-left-0 border-right-0 shadow'>
                    <small><span class='float-right'> @<?php print($results[$i][3]) ?> </span>
                        <?php if ($_SESSION && $_SESSION["username"] == $results[$i][3]) { ?>
                            <form class="" method="post" action="./edit.php">
                                <input type="hidden" name="url" value="<?php print_r($url) ?>" />
                                <input type="hidden" name="id" value="<?php print_r($results[$i][0]) ?>" />
                                <input type="hidden" name="question" value="<?php print_r($results[$i][1]) ?>" />
                                <input type="hidden" name="answer" value="<?php print_r($results[$i][2]) ?>" />
                                <input type="hidden" name="tag" value="<?php print_r($results[$i][4]) ?>" />
                                <button type="submit" class="btn bg-white remove" name="update" style="padding:0%"> <i class="fa fa-edit"></i> <small> On Date : <?php print_r($results[$i][5]) ?> </small></button>
                            </form>

                        <?php } ?>
                    </small>
                    <?php if (substr(trim($results[$i][1]), -1) == "?") { ?>
                        <h5 class="font-weight-bold"> Q <?php print_r($question); ?>. <?php print_r($results[$i][1]); ?> </h5>
                    <?php } else { ?>
                        <h5 class="font-weight-bold"> Q <?php print_r($question) ?>. <?php print_r($results[$i][1]) ?> ? </h5>
                    <?php } ?>
                    <p> Ans: <span class="text-success"><?php print_r($results[$i][2]) ?></span> </p>
                    <small>Tag : <span class=""> <?php print_r($results[$i][4]) ?> </span>
                        <?php if ($_SESSION  &&  $_SESSION["username"] == $results[$i][3]) { ?>
                            <form class="float-right" method="post" action="./first.php">
                                <input type="hidden" name="id" value="<?php print_r($results[$i][0]) ?>" />
                                <button type="submit" class="btn btn-white" onclick="return confirm('Are you sure you want to delete?')" name="delete"> <i class="fa fa-trash"></i> </button>
                            </form>
                        <?php
                        } ?>


                    </small>
                </div>
            <?php } ?>
        <?php } ?>

        <div class="my-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">

                    <?php
                    if ($total_pages == $page && $page > 5) {
                        $i = $page - 5;
                    } else {
                        $i = $page;
                    }
                    if ($page - 4 > 0 && $page >= 5) { ?>
                        <form action="" method="get">
                            <input type="hidden" name="tag" value="<?php print_r($opened_tag) ?>" />
                            <li class="page-item <?php if ($start_from == $page - 4) print_r('active') ?>"><button type="submit" class="page-link" value="<?php print_r($page - 4) ?>" name="page" href="#">Previous</button></li>
                        </form>
                    <?php } else if ($start_from > 0 && $page <= 6) { ?>
                        <form action="" method="get">
                            <input type="hidden" name="tag" value="<?php print_r($opened_tag) ?>" />
                            <li class="page-item <?php if ($start_from == $page - 1) print_r('active') ?>"><button type="submit" class="page-link" value="<?php print_r($page - 1) ?>" name="page" href="#">Previous</button></li>
                        </form>
                        <?php }
                    // echo $total_pages;

                    if ($page <= $total_pages) {
                        for ($i = $i; $i < $page + 5; $i++) {
                            if ($i > 0 && $i <= $total_pages) {
                        ?>
                                <form action="" method="get">
                                    <input type="hidden" name="tag" value="<?php print_r($opened_tag) ?>" />
                                    <li class="page-item <?php if ($i == $page) print_r('active') ?>"><button type="submit" class="page-link" value="<?php print_r($i) ?>" name="page" href="#"><?php print_r($i) ?></button></li>
                                </form>
                    <?php
                            }
                        }
                    }

                    ?>
                    <?php if ($page == ($total_pages - 5)  && $page < $total_pages) { ?>
                        <form action="" method="get">
                            <input type="hidden" name="tag" value="<?php print_r($opened_tag) ?>" />
                            <li class="page-item <?php if ($start_from == $page - 1) print_r('active') ?>"><button type="submit" class="page-link" value="<?php print_r($page + 5) ?>" name="page" href="#">Next</button></li>
                        </form>
                    <?php } else if ($page < $total_pages) { ?>
                        <form action="" method="get">
                            <input type="hidden" name="tag" value="<?php print_r($opened_tag) ?>" />
                            <li class="page-item <?php if ($start_from == $page - 1) print_r('active') ?>"><button type="submit" class="page-link" value="<?php print_r($page + 1) ?>" name="page" href="#">Next</button></li>
                        </form>
                    <?php   }    ?>
                </ul>
            </nav>
        </div>
    </div>


    <div>
        <div>
        </div>
    </div>

  <?php if ($_SESSION && $_SESSION["username"]) {
                insert_questions();
            }; ?>
</div>






<?php include('./footer.php')  ?>