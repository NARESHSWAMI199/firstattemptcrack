<?php
require('./dbconfig.php');





// NOTE : if you want check query error you can use this

// if ($ex_qs){
//     echo "successfully inserted";
//     // header('Location:/first.php');
// }else {
//     echo("Error description: " . mysqli_error($conn));
// }



// function name($conn)
// {
//     $qs = "select * from video ORDER BY id DESC";
//     $ex_qs = mysqli_query($conn, $qs);
//     $result = mysqli_fetch_all($ex_qs);
//     return $result;
// }



// FOR PDF
function get_all_questions($conn, $tag)
{
    if ($tag == "all") {
        $qs = "SELECT * FROM paper1 ORDER BY id DESC ";
    } else {

        $qs = "SELECT * FROM paper1 WHERE `tag`='$tag' ORDER BY id DESC";
    }
    $ex_query = mysqli_query($conn, $qs);
    $result = mysqli_fetch_all($ex_query);
    return $result;
}


// login page for user
function getUser($conn, $username, $password)
{
    $qs = "select `username` from login where `username`= '$username' and `password`= '$password'";
    $ex_qs = mysqli_query($conn, $qs);
    $result = mysqli_fetch_all($ex_qs);
    return $result;
}




// get all data according username 
function dashboard($conn, $username, $start_from, $per_page_record)
{
    $qs = "select * from paper1 where `name`='$username' ORDER BY `id` DESC LIMIT $start_from, $per_page_record ";
    $ex_qs = mysqli_query($conn, $qs);
    $result = mysqli_fetch_all($ex_qs);
    return $result;
}



// get data according username and tag for dashboard
function get_all_according_tag_and_username($conn, $start_from, $per_page_record, $tag, $username)
{
    if ($tag == "all") {
        $qs = "SELECT * FROM `paper1` where `name`='$username' ORDER BY id DESC LIMIT $start_from, $per_page_record ";
    } else {
        $qs = "SELECT * FROM `paper1` where `tag`= '$tag' and `name`='$username' ORDER BY id DESC LIMIT $start_from, $per_page_record ";
    }
    $ex_qs = mysqli_query($conn, $qs);
    $result = mysqli_fetch_all($ex_qs);
    return $result;
}




// Dashboard : get data according username and tag
function total_row_according_tag_and_username($conn, $tag, $username)
{
    $qs = "select * from paper1 where `tag`='$tag' and `name`='$username' ORDER BY `id` DESC";
    $ex_qs = mysqli_query($conn, $qs);
    $result = sizeof(mysqli_fetch_all($ex_qs));
    return $result;
}



// DASHBOARD : Get total number of row where user present
function total_row_of_user($conn, $username)
{
    $qs = "select * from paper1 where `name`='$username'";
    $ex_qs = mysqli_query($conn, $qs);
    $result = sizeof(mysqli_fetch_all($ex_qs));
    return $result;
}





# get data according tag 
function get_all_according_tag($conn, $start_from, $per_page_record, $tag)
{
    if ($tag == "all") {
        $qs = "SELECT * FROM `paper1` ORDER BY id DESC LIMIT $start_from, $per_page_record ";
    } else {
        $qs = "SELECT * FROM `paper1` where `tag`= '$tag ' ORDER BY id DESC  LIMIT $start_from, $per_page_record ";
    }
    $ex_qs = mysqli_query($conn, $qs);
    $result = mysqli_fetch_all($ex_qs);
    return $result;
}





// get total row's count
function total_row($conn)
{
    $qs = "select * from paper1";
    $ex_qs = mysqli_query($conn, $qs);
    $result = sizeof(mysqli_fetch_all($ex_qs));
    return $result;
}


// count row according tag
function total_row_according_tag($conn, $tag)
{
    $qs = "select * from paper1 where `tag`='$tag'";
    $ex_qs = mysqli_query($conn, $qs);
    $result = sizeof(mysqli_fetch_all($ex_qs));
    return $result;
}



// Dashborad : insert questions
function insert_questions_model($conn, $question, $answer, $name, $tag)
{
    $qs = "insert into paper1 (`ques`, `ans`, `name`, `tag`) values('$question', '$answer' , '$name', '$tag')";
    mysqli_query($conn, $qs);
}



// SEARCH : SEARCH RESULT 
function search_results($conn, $text)
{
    $text = trim($text);
    $qs = "select * from paper1 where `ques` like '%$text%' or ans like '%$text%' or `name` like '%$text%' or `date` like '%$text%' ORDER BY id DESC  LIMIT 0, 60";
    $ex_qs = mysqli_query($conn, $qs);
    $result = mysqli_fetch_all($ex_qs);
    return $result;
}


// UPDATE :   UPDATE QUESTION, ANSWER, AND TAG
function update_question_model($conn, $id, $question, $answer, $tag)
{
    $qs = "UPDATE paper1 SET `ques` = '$question' ,`ans`='$answer' , `tag`='$tag'  WHERE `id`='$id' ";
    mysqli_query($conn, $qs);
}



// GET : GET ALL QUESTIONS
function get_all($conn, $start_from, $per_page_record)
{
    $qs = "SELECT * FROM `paper1` ORDER BY id DESC LIMIT $start_from, $per_page_record ";
    $ex_qs = mysqli_query($conn, $qs);
    $result = mysqli_fetch_all($ex_qs);
    return $result;
}




// VIDEO : GET ALL NEW VIDEOS 
function get_all_video($conn)
{
    $qs = "select * from video ORDER BY id DESC";
    $ex_qs = mysqli_query($conn, $qs);
    $result = mysqli_fetch_all($ex_qs);
    return $result;
}


// INSERT : INSERT VIDEOS
function insert_video($conn, $url, $title, $username, $tag)
{
    $qs = "insert into video (`url`, `tag`, `name`, `title`) values('$url', '$tag' , '$username',  '$title')";
    mysqli_query($conn, $qs);
}

// DELETE : VIDEO  // IMPORVE THIS 
function delete_video($conn, $id)
{
    $qs = "DELETE FROM video where `id` = '$id'";
    mysqli_query($conn, $qs);
}


// DELETE : DELETE QUESTION ACCORDING ID 
function delete($conn, $id)
{
    $qs = "DELETE FROM paper1 where `id` = '$id' ";
    mysqli_query($conn, $qs);
}


// COMPRESS DELETE

// function delete_using_table_and_id($conn,$table,$id)
// {
//     $qs = "DELETE FROM $table where `id` = '$id' ";
//     mysqli_query($conn, $qs);
// }



// SEARCH : VIDEO // IMPROVE THIS
function search_videos($conn, $text)
{
    $qs = "select * from video where `title` like '%$text%' or `tag` like '%$text%' or `name` like '%$text%' ORDER BY id DESC  ";
    $ex_qs = mysqli_query($conn, $qs);
    $result = mysqli_fetch_all($ex_qs);
    return $result;
}
