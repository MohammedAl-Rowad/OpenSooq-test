<?php
class Levenshtein
{

    // Enforce the instantiation of the class through the static method...
    private function __construct()
    {}

    public static function levenshtein_dist(string $a, string $b): int
    {
        return (new static())->init_calc(strtolower($a), strtolower($b));
    }

    public function init_calc(string $a, string $b): int
    {
        $a_len = strlen($a);
        $b_len = strlen($b);
        $this->distance_matrix = $this->create_distance_matrix($a_len, $b_len);
        $this->fill_first_row($a);
        $this->fill_first_column($b);
        $this->calc_distance_and_put_it_in_matrix($a, $b);
        return $this->distance_matrix[$b_len][$a_len];
    }

    /**
     * Create & return empty distance matrix
     * for all possible modifications
     * of substrings of a to substrings of b.
     *
     * @param integer $a_len
     * @param integer $b_len
     * @return array
     */
    private function create_distance_matrix(int $a_len, int $b_len): array
    {
        return array_map(function () use ($a_len) { // I have PHP 7.2 I can't use arrow functions
            return array_fill(0, $a_len + 1, null);
        }, array_fill(0, $b_len, null));
    }

    /**
     *
     *
     * @param string $a
     * @return void
     */
    private function fill_first_row(string $a): void
    {
        $this->loop_helper($a, function ($i) {
            $this->distance_matrix[0][$i] = $i;
        });
    }

    private function fill_first_column(string $b): void
    {
        $this->loop_helper($b, function ($i) {
            $this->distance_matrix[$i][0] = $i;
        });
    }

    private function calc_distance_and_put_it_in_matrix(string $a, string $b): void
    {
        $this->loop_helper($b, function ($j) use ($a, $b) {
            $this->loop_helper($a, function ($i) use ($a, $b, $j) {
                $indicator = $a[$i - 1] === $b[$j - 1] ? 0 : 1;
                $this->distance_matrix[$j][$i] = min(
                    $this->distance_matrix[$j][$i - 1] + 1, // deletion
                    $this->distance_matrix[$j - 1][$i] + 1, // insertion
                    $this->distance_matrix[$j - 1][$i - 1] + $indicator // substitution
                );
            }, 1);
        }, 1);
    }

    private function loop_helper(string $str, $fun, int $def_len = 0): void
    {
        for ($i = $def_len; $i <= strlen($str); $i++) {
            $fun($i);
        }
    }
}

// $distance_matrix = array_map(function () use ($a) {
//     return array_fill(0, strlen($a) + 1, null);
// }, array_fill(0, strlen($a), null));

// for ($i = 0; $i <= strlen($a); $i++) {
//     $distance_matrix[0][$i] = $i;
// }

// for ($j = 0; $j <= strlen($b); $j++) {
//     $distance_matrix[$j][0] = $j;
// }

// for ($j = 1; $j <= strlen($b); $j++) {
//     for ($i = 1; $i <= strlen($a); $i++) {
//         $indicator = $a[$i - 1] === $b[$j - 1] ? 0 : 1;
//         $distance_matrix[$j][$i] = min(
//             $distance_matrix[$j][$i - 1] + 1, // deletion
//             $distance_matrix[$j - 1][$i] + 1, // insertion
//             $distance_matrix[$j - 1][$i - 1] + $indicator // substitution
//         );
//     }
// }
