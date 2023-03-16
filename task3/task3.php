<?php
/*
 * Single Responsibility Principle
 * In this implementation, the printNumber function takes a number as input and generates the corresponding string
 * Based on whether the number is a multiple of 3, 5, or both. If the number is not a multiple of either 3 or 5,
 * The function returns the number itself. The printf statement is used to print both the number and its corresponding
 * string.
 * */
function printNumber($number): void
{
    $output = '';

    if ($number % 3 == 0) {
        $output .= 'Toucan';
    }
    if ($number % 5 == 0) {
        $output .= 'Tech';
    }
    if ($output === '') {
        $output = $number;
    }

    printf("%d : %s\n", $number, $output);
}

for ($i = 1; $i <= 100; $i++) {
    printNumber($i);
}
