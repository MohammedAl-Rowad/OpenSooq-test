<?php
/**
 * This file contains step 9 run it like this
 * How to run:
 * 1 - open the terminal/cmd and 'cd' into where you
 * downloaded this file.
 * 2 - write in the terminal the following
 *  2.1 - php command_line_step_9
 * 3 - should work
 * ~~~
 * I'm using PHP 7.2.24
 */

require './Levenshtein.php';

while (true) {
    info("first");
    $str1 = read_stdin();
    should_we_exit($str1);
    info("second");
    $str2 = read_stdin();
    should_we_exit($str2);
    $res = Levenshtein::levenshtein_dist($str1, $str2);
    print("Levenshtein distance between '{$str1}' & '{$str2}' is = {$res}" . "\n");
}

/**
 *
 * @param string $str
 * @return void
 */
function should_we_exit(string $str): void
{
    if ($str === "exit") {
        exit;
    }
};

/**
 * reads the standard input...
 * @return string
 */
function read_stdin(): string
{
    $fr = fopen("php://stdin", "r"); // open our file pointer to read from stdin
    $input = fgets($fr, 128); // read a maximum of 128 characters
    $input = rtrim($input); // trim any trailing spaces.
    fclose($fr); // close the file handle
    return $input; // return the text entered
}

/**
 *
 * @param string $str
 * @return void
 */
function info(string $str): void
{
    print("Enter {$str} string please ( enter 'exit' to exit ):\n");
}
