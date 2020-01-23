<?php
require './Hamming.php';
require './Levenshtein.php';

// print(Hamming::hamming_dist("roaad", "rowad"));

$a = "this is test";
$b = "the is test";
// Create empty edit distance matrix for all possible modifications of
// substrings of a to substrings of b.
$distance_matrix = array_map(function () use ($a) {
    return array_fill(0, strlen($a) + 1, null);
}, array_fill(0, strlen($a), null));

for ($i = 0; $i <= strlen($a); $i++) {
    $distance_matrix[0][$i] = $i;
}

for ($j = 0; $j <= strlen($b); $j++) {
    $distance_matrix[$j][0] = $j;
}

for ($j = 1; $j <= strlen($b); $j++) {
    for ($i = 1; $i <= strlen($a); $i++) {
        $indicator = $a[$i - 1] === $b[$j - 1] ? 0 : 1;
        $distance_matrix[$j][$i] = min(
            $distance_matrix[$j][$i - 1] + 1, // deletion
            $distance_matrix[$j - 1][$i] + 1, // insertion
            $distance_matrix[$j - 1][$i - 1] + $indicator // substitution
        );
    }
}
print($distance_matrix[strlen($b)][strlen($a)] . "\n");

// print_r($distance_matrix);

print(Levenshtein::levenshtein_dist("this is a test", "thi is test"));
