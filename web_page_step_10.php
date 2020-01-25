<?php
/**
 * How to run this file using PHP built in server
 * 1 - open the terminal/cmd and 'cd' to where
 * you downloaded this file
 * 2 - type the following into the terminal
 *  2.1 - php -S loclhost:8081
 * 3 - open your broswer to this link http://localhost:8081/web_page_step_10.php
 * 4 - should work.
 *
 */

function should_we_calc(): bool
{
    return isset($_POST["str1"]) && isset($_POST["str2"]);
}
// require the code on demand!
if (should_we_calc()) {
    require './Levenshtein.php';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>🐘 PHP 🐘</title>
    <style>
        main {
            margin: auto;
            width: 50%;
            padding: 10px;
        }
        input, button {
            padding: 10px;
        }

        button {
            cursor: pointer;
        }

    </style>
</head>
<body>
<main>
<h5>
    I didn't style this because it's not part of the test!
</h5>
<h5>
    you can compare with empty string here...
</h5>
<form action="web_page_step_10.php" method="post">
        <input type="text" name="str1" placeholder="please enter the first string">
        <input type="text" name="str2" placeholder="please enter the second string">
        <button type="submit" >
            🧮 Show Levenshtein Distance 🧮
        </button>
</form>
</main>
<?php
if (should_we_calc()) {
    $res = Levenshtein::levenshtein_dist($_POST["str1"], $_POST["str2"]);
    $str1 = htmlentities($_POST["str1"]); // Convert all applicable characters to HTML entities ( security )
    $str2 = htmlentities($_POST["str2"]); // Convert all applicable characters to HTML entities ( security )
    echo "<h3> 🔵 Levenshtein distance between '${str1}' & '{$str2}' is = {$res} </h3>";
    echo "<hr />";
    $str1_len = strlen($str1);
    $str2_len = strlen($str2);
    echo "<h3> 🔵 The length of the first string is = {$str1_len} and the second string is = {$str2_len} </h3>";
}
?>
</body>
</html>
