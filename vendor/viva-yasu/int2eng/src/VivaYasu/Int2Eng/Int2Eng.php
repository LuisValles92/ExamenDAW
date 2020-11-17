<?php

namespace VivaYasu\Int2Eng;

class Int2Eng
{
    /** @var $num_eng array  */
    private $num_eng = [
        '0' => 'zero',
        '1' => 'one',
        '2' => 'two',
        '3' => 'three',
        '4' => 'four',
        '5' => 'five',
        '6' => 'six',
        '7' => 'seven',
        '8' => 'eight',
        '9' => 'nine',
        '10' => 'ten',
        '11' => 'eleven',
        '12' => 'twelve',
        '13' => 'thirteen',
        '14' => 'fourteen',
        '15' => 'fifteen',
        '16' => 'sixteen',
        '17' => 'seventeen',
        '18' => 'eighteen',
        '19' => 'nineteen',
        '20' => 'twenty',
        '30' => 'thirty',
        '40' => 'forty',
        '50' => 'fifty',
        '60' => 'sixty',
        '70' => 'seventy',
        '80' => 'eighty',
        '90' => 'ninety'
    ];

    /** @var $int int integer before convert */
    private $int;

    /** @var $eng string number written in English */
    private $eng;

    /**
     * Int2Eng constructor.
     * @param $int int Integer convert to English
     */
    public function __construct($int)
    {
        $this->int = $int;
        $this->eng = $this->get_number($int);
    }

    /**
     * eng getter
     *
     * @return string
     */
    public function get_eng()
    {
        return $this->eng;
    }

    /**
     * @param $num int
     * @return string
     */
    private function get_number($num)
    {
        if (strlen($num) == 1) {
            $result = $this->num_eng[$num];
        } elseif (strlen($num) == 2) {
            $result = $this->get_two_digits($num);
        } elseif (strlen($num) == 3) {
            $result = $this->get_three_digits($num);
        } else {
            $result = $this->get_four_digits($num);
        }
        return $result;
    }

    /**
     * @param $num int
     * @return string
     */
    private function get_two_digits($num)
    {
        $first_digit = substr($num, 0, 1);
        $second_digit = substr($num, 1, 1);
        if ($num < 20) {
            $result = $this->num_eng[$num];
        } elseif ($num % 10 == 0) {
            $result = $this->num_eng[$num];
        } else {
            $two = $this->num_eng[$first_digit . '0'];
            $one = $this->num_eng[$second_digit];
            $result = $two . ' ' . $one;
        }
        return $result;
    }

    /**
     * @param $num int
     * @return string
     */
    private function get_three_digits($num)
    {
        $first_digit = substr($num, 0, 1);
        $other_digits = intval(substr($num, 1, 2));

        if ($num % 100 == 0) {
            $tmp = $this->num_eng[$first_digit];
            $result = $tmp . ' hundred';
        } else {
            $first = $this->num_eng[$first_digit];
            $other = $this->get_two_digits($other_digits);
            $result = $first . ' hundred and ' . $other;
        }
        return $result;
    }

    /**
     * @param $num int
     * @return string
     */
    private function get_four_digits($num)
    {
        $first_digit = substr($num, 0, 1);
        $first_second_digits = substr($num, 0, 2);
        $two_digits = substr($num, 2, 2);

        if ($num % 1000 == 0) {
            $tmp = $this->num_eng[$first_digit];
            $result = $tmp . ' thousand';
        } elseif ($num % 100 == 0) {
            $tmp = $this->num_eng[$first_second_digits];
            $result = $tmp . ' hundred';
        } else {
            $ten_hundred = $this->get_two_digits($first_second_digits);
            $two_digits = $this->get_two_digits($two_digits);
            $result = $ten_hundred . ' hundred and ' . $two_digits;
        }

        return $result;
    }
}
