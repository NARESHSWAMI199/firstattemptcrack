<?php include  './header.php'; 
    require './view.php';
?>




<!-- update form -->
<?php
if (isset($_POST['update'])) {
    $question  = $_POST['question'];
    $answer  = $_POST['answer'];
    $tag  = $_POST['tag'];
    $id = $_POST["id"];
    $url = $_POST["url"];
?>

    <div class='col-lg-8 my-5  col-sm-12 col-md-8 offset-md-2 offset-lg-2'>
        <?php
        updateForm($id, $question, $answer, $tag,$url);
        ?>
    </div>

<?php
}else {
    echo "<h3 class='my-5'> Invalid Request  </h3>";

} ?>

<?php include './footer.php'; ?>