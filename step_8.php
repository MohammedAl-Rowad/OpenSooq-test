<?php
/**
 * This file contains step 8
 * ~~~
 * I'm using PHP 7.2.24
 */

require './Hamming.php';
require './Levenshtein.php';

function hamming_tests(): void
{
    $tests = [
        "roaaD" => "rowad",
        "100101" => "101101",
        "saraH" => "suRah",
        "SamSang" => "Samsung",
        "poloo" => "marco",
        "my name is mohammed al-rowad" => "dawor-al demmahom si eman ym",
        "" => "",
        // "This will throw en error" => "Hamming_dist",
    ];
    foreach ($tests as $str1 => $str2) {
        $res = Hamming::hamming_dist($str1, $str2);
        print("Hamming distance between '{$str1}' & '{$str2}' is = {$res}" . "\n");
    }
}

function levenshtein_tests(): void
{
    $tests = [
        "roaaD" => "rowad",
        "100101" => "101101",
        "saraH" => "suRah",
        "SamSang" => "Samsung",
        "poloo" => "marco",
        "my name is mohammed al-rowad" => "dawor-al demmahom si eman ym",
        "" => "the result will be the full length of me => 46",
        "This will NOT throw en error" => "Nice",
        "d" => "abcdefg",
        "this is a test" => "this is test",
        "this is test" => "the is test",
        "372891698sdfudfhnapiuhyt7h342ugnfpiaunwerjgf" => "ajksldgpi8bh74w-0ehfbgufpaijbguefaewsbnflasdfnlfbj",
    ];
    foreach ($tests as $str1 => $str2) {
        $res = Levenshtein::levenshtein_dist($str1, $str2);
        print("Levenshtein distance between '{$str1}' & '{$str2}' is = {$res}" . "\n");
    }
}

hamming_tests();
print("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
levenshtein_tests();
