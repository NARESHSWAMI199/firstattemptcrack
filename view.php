<?php

require './dbconfig.php';
require './model.php';









// function get_all_question($conn)
// {
//     $result = get_all($conn);
//     return $result;
// }


function insert_questions()
{
    echo '<form class="form-group" action="./dashboard.php" method="post">
    <h3 class="my-5"> Insert Question From Here.. </h3> 
    <label for="">Question : </label>
    <textarea class="form-control" id="question" required name="question"  placeholder="Enter your Question :" ></textarea>
    <div id="listen">
    <button id="question_mic" type="button" class="w-100 btn btn-white bg-white" onclick="listenquestion()"> <i class="fa fa-microphone"> </i> Speak </button>
    </div>
    

    <label for=""> Answer : </label>
    <textarea class="form-control"  id="answer" required name="answer" placeholder="Enter your answer :" ></textarea>
    <div id="listen1">
    <button id="answer_mic" type="button" class="w-100 btn btn-white bg-white" onclick="listenanswer()"> <i class="fa fa-microphone"> </i> Speak </button>
    </div>

    <label for="">Tag :</label>
    <select required class="custom-select" name="tag" id="tag">
        <option value="">Please Select Question Type</option>
        <option value="cultural">Art & Culture</option>
        <option value="geography">Geography</option>
        <option value="gernalscience">Gernal Science</option>
        <option value="currentgk">Current Affair</option>
        <option value="history">History</option>
        <option value="other">other</option>

    </select>
    <br />
    <input name="submit" type="submit" id="submit" class="btn btn-primary my-3" />
</form>';
}



function uploadVideos()
{
    echo '<form class="form-group" action="./suggestions.php" method="post">
    <h3 class="my-5"> Insert Videos From Here.. </h3>
    
    <label for="">Url : </label>
    <input type="url" required class="form-control" name="url" id="question" placeholder="Enter url :" />

    <label for=""> Title : </label>
    <input class="form-control" name="title" required id="title" placeholder="Enter title :" />

    <label for="">Tag :</label>
    <input class="form-control" name="tag" id="tag" placeholder="Enter any tag :" />
    <br />
    <input name="video_submit" type="submit" class="btn btn-primary mt-5" />
</form>';
}


function updateForm($id, $question, $answer, $tag,$url)
{

    echo "<form class=\"form-group\" action=\"./dashboard.php\" method=\"post\">
    <h3 class=\"my-5\"> Update From Here.. </h3>
    <input type=\"hidden\" required class=\"form-control\" name=\"id\" value=\"{$id}\"  placeholder=\"Enter your question :\" />
    <input type=\"hidden\" required class=\"form-control\" name=\"url\" value=\"{$url}\"  placeholder=\"Enter your question :\" />

    <label for=''>Question : </label>
    <input type=\"text\" required class=\"form-control\" name=\"question\" value='$question'  placeholder=\"Enter your question :\" />

    <label for=''> Answer : </label>
    <input type=\"text\" class=\"form-control\" name=\"answer\" value='$answer' required  placeholder=\"Enter your answer :\" />
    <label for=''>Tag :</label>
    <select required class=\"custom-select\" name=\"tag\"  id=\"tag\">
        <option value='$tag'>$tag</option>
        <option value=\"cultural\">Art&Culture</option>
        <option value=\"geography\">Geography</option>
        <option value=\"art&science\">GernalScience</option>
        <option value=\"currentgk\">Current Affair</option>
        <option value=\"history\">History</option>
        <option value=\"other\">other</option>
    </select>
    <br />
    <input  type=\"submit\"  name=\"updateform\" class=\"btn btn-primary mt-5\" />
</form>";
}

// video view
function get_all_video_view($conn)
{
    return  get_all_video($conn);
}
