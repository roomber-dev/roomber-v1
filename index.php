<?php

//header("Location: /new");

?>

<html>
<center><img src="../assets/img/roomber-logo.png" height="110" class="logo" />&nbsp;<img src="../assets/img/roomber-logo-text.png" height="100" class="logo" /></center><br>

<noscript>
    <center>
        <div class="noscriptm">
            <p class="noscriptmsg">This site requires Javascript to work, please enable Javascript in your browser or use a browser with Javascript support.</p>
        </div>
    </center>
</noscript>

<head>
    <!--    <script>
   var startTime = (new Date()).getTime();
</script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
$(document).ready(function() {
    var endTime = (new Date()).getTime();
       var millisecondsLoading = endTime - startTime;
       console.log("[DEBUG] Webpage loaded. Took", millisecondsLoading, "ms")
       // Put millisecondsLoading in a hidden form field
       // or Ajax it back to the server or whatever.
});
    </script>-->

    <script>
        var startTime = (new Date()).getTime();
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script>
        $(window).load(function() {
            var endTime = (new Date()).getTime();
            var millisecondsLoading = endTime - startTime;
            console.log("[DEBUG] Webpage loaded. Took", millisecondsLoading, "ms")
            // Put millisecondsLoading in a hidden form field
            // or Ajax it back to the server or whatever.
        });
       /* document.addEventListener('DOMContentLoaded', function() {
            var checkbox = document.querySelector('input[type=\"checkbox\"]');

            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    // do this
                    document.body.style.backgroundImage = "url('./assets/img/bg_light.png')";
                } else {
                    // do that
                    document.body.style.backgroundImage = "url('./assets/img/bg_dark.png')";
                }
            });
        });*/
    </script>

<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<?php
$filename = 'data.json';
$data = file_get_contents($filename);
$brand_name = json_decode($data, true)["brand_name"];
$full_brand_name = json_decode($data, true)["full_brand_name"];
$site_address = json_decode($data, true)["site_address"];
$cooldown = json_decode($data, true)["cooldown"];
session_start();


include_once "../func/formatMessageHTML.php";
include_once "../func/generateRandomColor.php";
include_once "../func/loginForm.php";
include_once "../func/registerForm.php";
include_once "../func/siteMeta.php";
include_once "../func/dbconnect.php";
include_once "../func/str_contains.php";
include_once "../func/random_str.php";
include_once "../func/minify_css.php";
include_once "../func/random_id.php";
$mysqli = new mysqli("localhost", $username, $password, $database);

//echo '<center><div class="ipupdates" id="ipupdates"><p class="ipupdatesmessage">Hey! Incase our servers go down or there\'s a problem, join our <a href="https://discord.gg/uCrrUcm8wR" target="_blank" rel="noopener noreferrer">discord server</a>!</p></div><button id="dismissipmsg" onclick="dismissipmsg(\'ipupdates\', this);">Dismiss</button></center>';
echo "<script>".file_get_contents("../assets/js/consoleWarning.js")."</script>";


function showError($message) {
    echo '<center><span class="error">'.$message.'</span></center>';
}

/*echo '<style>';
for ($i = 0; $i < 50; $i++){
    $test = $i + 1;
    echo '.confetti:nth-child('.$test.') { 
        background-color: #'.random_color().';
        left: '.rand(10, 100).'%;
        animation-delay: '.rand(-6, 0).';
    }'."\r\n";
}
echo '</style>';
echo '
<script>

//sets a random absolute position to a html element; receives the html element

document.getElementsByClassName("confetti").forEach(function (item, index) {
    moveElmRand(item);
  });
function moveElmRand(elm){
 elm.style.position ="absolute";
 elm.style.top = Math.floor(Math.random()*90+5)+"%";
 elm.style.left = Math.floor(Math.random()*90+5)+"%";
}

</script>
';

    echo '<div class="confetticontainer">';
for ($i = 0; $i < 50; $i++){
    echo '<div class="confetti" id="confet"></div>';
}
echo '</div>';*/
//echo '<script>alert(\'\')</script>';




/*if (!function_exists('str_starts_with')) {
echo 'str_starts_with does not exist';
} else {
    echo 'str_starts_with exists';
}*/

if (isset($_GET['logout'])) {


    //$logout_message = "<div class='msgln'><span class='left-info'>User <a href='javascript:insert_mention(\"" . $_SESSION['name'] . "\");'><b class='user-name-left'>" . $_SESSION['name'] . "</b></a> has left the chat.</span><br></div>";
    //file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);




    /*if(str_contains(file_get_contents("online.html"), "<div class='onlineuser'><b class='user-name'>".$_SESSION['name']."</b></div>&nbsp;&nbsp;")) { 
        file_put_contents("online.html", str_replace("<div class='onlineuser'><b class='user-name'>".$_SESSION['name']."</b></div>&nbsp;&nbsp;", "", file_get_contents("online.html")), FILE_APPEND | LOCK_EX);
    }*/

    session_destroy();
    header("Location: index.php"); //Redirect the user
}

if (isset($_POST['enter'])) {
    if(isset($_POST['email'])) {
        include "./func/checkRegisterDetails.php";
    } else {
    if ($_POST['name'] != "" && $_POST['password'] != "") {
        include "./func/checkLoginDetails.php";
    } else {
        echo '<center><span class="error">Please fill in the fields</span></center>';
    }
}
}




?>

<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />

    <title><?php echo $full_brand_name; ?></title>
    <meta name="description" content="<?php echo $siteDescription; ?>" />
    <link rel="icon" href="assets/img/roomber-logo.png" type="image/png">  
    <!--<link rel="stylesheet" href="style.css" />-->
    <meta property="og:title" content="<?php echo $siteTitle; ?>">
    <meta property="og:description" content="<?php echo $siteDescription; ?>">
    <meta property="og:url" content="<?php echo $siteUrl; ?>">
    <meta property="og:image" content="<?php echo $siteImage; ?>">

    <?php

    //if($_SESSION['name'] == 'mega') {
    //    echo "<script type='text/javascript'>var eastereggenabled = true;</script>";
    //} else {
    echo "<script type='text/javascript'>var eastereggenabled = false;</script>";
    //}



    echo '<style>' . minify_css(file_get_contents("style.css")) . '</style>';

    ?>


</head>


<body id="container" <?php 
if(isset($_SESSION['id'])) {
    $result = $mysqli->query("SELECT style FROM users WHERE id = '" . $_SESSION['id'] . "'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "style='background-image: url(\"../assets/img/bg_".$row['style'].".png\") '";
    }  
} else {
    echo "style='background-image: url(\"../assets/img/bg_dark.png\") '";
}
?>>
        <div id="sendSound"></div>
    <div id="discord"><a href="https://discord.gg/uCrrUcm8wR" target="_blank" rel="noopener noreferrer"><img src='../assets/img/discord_logo.png' width="100" /></a></div>
    <div id="insecurelinkpopup" class="insecurelinkpopup">

        <!-- Modal content -->
        <div class="insecurelinkpopup-content">
            <span class="close">&times;</span>
            <p style='text-align: center;   font-size: large;'>Warning, this site might be malicious. Do you still want to continue?</p><br><br>
            <div class='buttonPlacementDiv-insecurelinkpopup-content'><a class="yesButton-insecurewebpage-open">Yes</a><a class="cancelButton-insecurewebpage-open">Cancel</a></div>



        </div>
    </div>




    <?php
    if (!isset($_SESSION['id'])) {
        if(isset($_GET['register']) or isset($_POST['register'])) {
            registerForm();
        } else {
            loginForm();
        }
        
    } else {
        if (!function_exists('str_contains')) {
            function str_contains(string $haystack, string $needle): bool
            {
                return '' === $needle || false !== strpos($haystack, $needle);
            }
        }
        /*if(!str_contains(file_get_contents("online.html"), "<div class='onlineuser'><b class='user-name'>".$_SESSION['name']."</b></div>&nbsp;&nbsp;")) {
            $text_message = "<div class='onlineuser'><b class='user-name'>".$_SESSION['name']."</b></div>&nbsp;&nbsp;";   
            file_put_contents("online.html", $text_message, FILE_APPEND | LOCK_EX);
        }*/ // <b class='user-name'>neksodebe</b><br>


    ?>

        <div id="wrapper">
            <div id="menu">
                <p class="welcome">Welcome,
                    <?php
                    /*  if ($result = $mysqli->query("SELECT username, namecolor_fg, namecolor_bg FROM users WHERE id=" . $_SESSION['id'] . " LIMIT 1")) {
                        while ($row = $result->fetch_assoc()) {
                            $filtered = str_replace("<", "&lt;", $row['username']);
                            $filtered = str_replace(">", "&gt;", $filtered);
                            echo '<b class="user" style="background:' . $row['namecolor_bg'] . '; color:' . $row['namecolor_fg'] . ';">' . $filtered . '</b>';
                        }
                        $result->free();
                    }*/

                    include "../func/getFormattedUsername.php";
                    getFormattedUsername($mysqli);
                    ?>
                </p>
                <p class="logout"><a id="exit" href="#">Log out</a></p>

            </div>



            <div id="chatbox">
                <?php

                include "../func/getChatMessages.php";
                    getChatMessages($mysqli);
                ?>
            </div>
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" placeholder="Message" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
            </form>


            <?php
            /*if ($_SESSION['name'] == 'neksodebe') {
                echo '<div id="onlineppltext">
                    <p class="onlineppl"><b>Commands</b></p>
                    </div>
                &nbsp;&nbsp;&nbsp;/clear - Clears the chat<br>
                &nbsp;&nbsp;&nbsp;/censorship - Toggles the censorship<br>
                &nbsp;&nbsp;&nbsp;/silence_chat - Silences the chat
';
            }*/
            ?>

            <br><br>
            <!--<div id="onlineppltext">
            <p class="onlineppl"><b>Online</b></p>
        </div>-->
            <!--<div id="onlinebox">

            </div>-->
        </div>
        <script type="text/javascript">
            var insecurelink_url = "#";
            /*function sendmsg(msg) {
                var clientmsg = msg
                $.post("post.php", {
                    text: clientmsg
                });
                $("#usermsg").val("");
            }*/

            document.getElementById("usermsg").focus();
            // jQuery Document
            $(document).ready(function() {
                $("#submitmsg").click(function() {


                   /* if (eastereggenabled == true) {
                        var audio = new Audio('./assets/sound/boom.mp3');
                        audio.play();
                    } else {
                        var audio = new Audio('./assets/sound/send.mp3');
                        audio.play();
                    }*/
                    var clientmsg = $("#usermsg").val();

                    if(clientmsg != "" && clientmsg != " ") {
                    $.post("post.php", {
                        text: clientmsg,
                        style: false
                    }, function(data, status, jqXHR) {
                        //console.log(data);
                        if(data != "") {
                        $("#sendSound").html(data);
                        }
                    });
                    $("#usermsg").val("");
                    

                }
                return false;
                });

                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request

                    $.ajax({
                        url: "refresh.php",
                        cache: false,
                        success: function(html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div

                            //Auto-scroll           
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                            if (newscrollHeight > oldscrollHeight) {
                                $("#chatbox").animate({
                                    scrollTop: newscrollHeight
                                }, 'normal'); //Autoscroll to bottom of div
                            }
                        }
                    });
                }

                setInterval(loadLog, 500);
                

               /* function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request

                    $.ajax({
                        url: "refresh.php",
                        cache: false,
                        success: function(html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div

                            //Auto-scroll           
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                            if (newscrollHeight > oldscrollHeight) {
                                $("#chatbox").animate({
                                    scrollTop: newscrollHeight
                                }, 'normal'); //Autoscroll to bottom of div
                            }
                        }
                    });
                }

                setInterval(loadLog, 500);*/

                /*function loadOnlineList() {
                    var oldscrollHeight = $("#onlinebox")[0].scrollHeight - 20; //Scroll height before the request
                    
                    $.ajax({
                        url: "online.html",
                        cache: false,
                        success: function (html) {
                            $("#onlinebox").html(html); //Insert chat log into the #chatbox div
 
                            //Auto-scroll           
                            var newscrollHeight = $("#onlinebox")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#onlinebox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }   
                        }
                    });
                }
 
                setInterval (loadOnlineList, 500);*/

                $("#exit").click(function() {
                   // var exit = confirm("Are you sure you want to log out?");
                    //if (exit == true) {
                        window.location = "index.php?logout=true";
                   // }
                });
            });


            /*$('#user-name').click(function(e) {
                e.preventDefault();

                document.getElementById('usermsg').value += ' @neksodebe'

                return false;
            });*/

            function insert_mention(username) {
                username = username.replace('"', "\\\"")
                document.getElementById('usermsg').value += '@' + username;
            }

            function open_webpage_insecure(url) {
                var modal = document.getElementById("insecurelinkpopup");
                //if(confirm("Are you sure you want to open '"+url+"'? This site may be dangerous.")) {
                insecurelink_url = url;
                modal.style.display = "block";

                //
                // }
            }

            function dismissipmsg(id, btn) {
                document.getElementById(id).style.visibility = "hidden";
                btn.style.display = 'none';
            }


            var modal = document.getElementById("insecurelinkpopup");


            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            var noButton = document.getElementsByClassName("cancelButton-insecurewebpage-open")[0];
            var yesButton = document.getElementsByClassName("yesButton-insecurewebpage-open")[0];
            noButton.onclick = function() {
                modal.style.display = "none";
            }
            yesButton.onclick = function() {
                window.open(insecurelink_url, '_blank').focus();
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>


</body>

</html>
<?php
    }
?>