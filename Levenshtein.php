<?php
/**
 * This file containes steps from 1 to 7
 *
 *
 * Implementation of Levenshtein distance
 * (this one is really really hard took me so much to "understand it")
 * links that helped me:
 * 1 - https://en.wikipedia.org/wiki/Levenshtein_distance
 * 2 - https://youtu.be/We3YDTzNXEk
 * 3 - https://www.youtube.com/watch?v=MiqoA-yF-0M ( this one is really good !)
 * ~~~
 * I'm using PHP 7.2.24
 * ~~~
 * I used this website to validate my results
 * https://planetcalc.com/1721/
 */
class Levenshtein
{
    private $distance_matrix;
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
     * Create distance matrix
     * for all possible modifications
     * of substrings of a to substrings of b.
     *
     * @param integer $a_len
     * @param integer $b_len
     * @return array
     */
    private function create_distance_matrix(int $a_len, int $b_len): array
    {
        return array_map(function () use ($a_len) {
            return array_fill(0, $a_len + 1, null);
        }, array_fill(0, $b_len, null));
    }

    /**
     *
     * Fill the first row of the matrix.
     * aka => transforming empty string to a.
     * In this case the number of transformations equals to size of a substring.
     * @param string $a
     * @return void
     */
    private function fill_first_row(string $a): void
    {
        $this->loop_helper($a, function ($i) {
            $this->distance_matrix[0][$i] = $i;
        });
    }

    /**
     * Fill the first column of the matrix.
     * aka => transforming empty string to b.
     * In this case the number of transformations equals to size of b substring.
     *
     * @param string $b
     * @return void
     */
    private function fill_first_column(string $b): void
    {
        $this->loop_helper($b, function ($i) {
            $this->distance_matrix[$i][0] = $i;
        });
    }

    /**
     * calculating the distance by
     * finding the min value from 3 cells
     * | val | val |
     * | val | new |
     *
     * each time and add 1 to it.
     *
     * @param string $a
     * @param string $b
     * @return void
     */
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

    /**
     * I wrote this loop many times, so
     * I added a helper function to loop for me
     * and I only need to pass a closure to it.
     * @param string $str
     * @param [function] $fun
     * @param integer $def_len
     * @return void
     */
    private function loop_helper(string $str, $fun, int $def_len = 0): void
    {
        for ($i = $def_len; $i <= strlen($str); $i++) {
            $fun($i);
        }
    }
}
