<script>
    // voice to text
    var recognition = new webkitSpeechRecognition();
    recognition.continuous = true;
    recognition.interimResults = true;
    recognition.lang = "hi-IN";

    var listening = false;



    function listenanswer() {
        recognition.onresult = function(event) {
            var interim_transcript = '';
            var final_transcript = '';

            for (var i = event.resultIndex; i < event.results.length; ++i) {
                if (event.results[i].isFinal) {
                    final_transcript += event.results[i][0].transcript;
                    document.getElementById('answer').value = final_transcript;
                    toggle();
                } else {
                    interim_transcript += event.results[i][0].transcript;
                    document.getElementById('answer').value = interim_transcript;
                }
            }
            console.log(interim_transcript, final_transcript);

        };



        toggle();


        function toggle() {
            recognition.start();
            listening = true;
            return document.getElementById('listen1').innerHTML = "<button id='answer_mic' type='button' class='w-100 btn btn-white bg-white' onclick=stopans()> <i class='fa fa-microphone'> </i> Stop </button>";
        }
    }


    function stopans() {
        recognition.stop();
        listening = false;

        return document.getElementById('listen1').innerHTML = "<button id='answer_mic' type='button' class='w-100 btn btn-white bg-white' onclick=listenanswer()> <i class='fa fa-microphone'> </i> Speak </button>";
    }


    function listenquestion() {
        recognition.onresult = function(event) {
            var interim_transcript = '';
            var final_transcript = '';

            for (var i = event.resultIndex; i < event.results.length; ++i) {
                if (event.results[i].isFinal) {
                    final_transcript += event.results[i][0].transcript;
                    document.getElementById('question').value = final_transcript;
                    toggle();
                } else {
                    interim_transcript += event.results[i][0].transcript;
                    document.getElementById('question').value = interim_transcript;
                }
            }
            console.log(interim_transcript, final_transcript);

        };

        toggle();


        function toggle() {
            recognition.start();
            listening = true;
            return document.getElementById('listen').innerHTML = "<button id='question_mic' type='button' class='w-100 btn btn-white bg-white' onclick=stopquestion()> <i class='fa fa-microphone'> </i> Stop </button>";
        }

    }
    
    
    function stopquestion() {
        recognition.stop();
        listening = false;
        return document.getElementById('listen').innerHTML = "<button id='question_mic' type='button' class='w-100 btn btn-white bg-white' onclick=listenquestion()> <i class='fa fa-microphone'> </i> Speak </button>";
    }
</script>

<script type="text/javascript">
    google.load("elements", "1", {
        packages: "transliteration"
    });
    var control;

    function onLoad() {
        var options = {
            //Source Language
            sourceLanguage: google.elements.transliteration.LanguageCode.ENGLISH,
            // Destination language to Transliterate
            destinationLanguage: [google.elements.transliteration.LanguageCode.HINDI],
            shortcutKey: 'ctrl+g',
            transliterationEnabled: true
        };
        control = new google.elements.transliteration.TransliterationControl(options);
        control.makeTransliteratable(['txtMessage']);
    }
    google.setOnLoadCallback(onLoad);
</script>

<a id="headerbtn" href="#footer" class="float-right  border text-dark"> <i class="fa fa-angle-down"></i> </a>

<div id="footer"></div>
<a id="footerbtn" href="#header" class="text-dark"> <i class="fa fa-angle-up"></i> </a>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>