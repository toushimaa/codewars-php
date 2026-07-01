<?php
declare(strict_types=1);

/*
Program flow:
1. Define the mapping of roman numerals
2. String to array, loop through each letter
3. If current letter is smaller than the next letter, subtract instead
4. Else add
5. Return final result
*/

// Procedural route
const ROMAN_TO_NUM = [
    'M' => 1000,
    'D' => 500,
    'C' => 100,
    'L' => 50,
    'X' => 10,
    'V' => 5,
    'I' => 1
];

function solution (string $romanWord): int {
    $romanDecimal = 0;
    $romanWord = strtoupper(trim($romanWord)); // Basic guard clause
    $romanWord = str_split($romanWord);

    foreach ($romanWord as $currentIndex => $romanLetter) {
        $currentValue = ROMAN_TO_NUM[$romanLetter] ?? 0;

        $nextIndex = $currentIndex + 1;
        $nextLetter = $romanWord[$nextIndex] ?? null; // null coalescing for the very last index, if no next letter, then null

        // If next letter is a valid char from the Roman to decimal mapping, then set it to its appropriate key => value, otherwise 0
        $nextValue = ROMAN_TO_NUM[$nextLetter] ?? 0;
    
        if ($currentValue < $nextValue) {
            $romanDecimal -= $currentValue;
        } else {
            $romanDecimal += $currentValue;
        }
    }
    return $romanDecimal;
}