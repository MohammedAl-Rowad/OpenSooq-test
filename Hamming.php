<?php
class Hamming
{

    // Enforce the instantiation of the class through the static method...
    private function __construct()
    {}

    public static function hamming_dist(string $a, string $b): int
    {
        $len = strlen($a);
        if ($len !== strlen($b)) {
            throw new Exception("'{$a}' is not the same length of '{$b}'", 1);
        }

        return (new static())->hamming_dist_calc(strtolower($a), strtolower($b));
    }

    public function hamming_dist_calc(string $a, string $b): int
    {
        $arr_of_chars = str_split($a);
        $res = 0;
        for ($i = 0; $i < strlen($a); $i++) {
            $res += $a[$i] !== $b[$i] ? 1 : 0;
        }
        return $res;
    }
}
