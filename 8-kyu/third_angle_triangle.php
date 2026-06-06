<?php

// declare(strict_types=1); apparently this will only work in the current file it was declared in, not in the test file from where the function was called
// I tried to enforce the strict typing but the test file doesn't allow it, and there isn't any on the test file so a numeric string still gets past
// Codewars test file has already coerced types before calling the function, so a "60" becomes 60 before even arriving here
// So throwing in a "60" string in one of the test cases still gets past because the function here receives the already-coerced integers

// Learned: PHP supports union types (int|float) for parameters and return types
// Learned: PHP attempts to silently convert mismatched types by default, like string "60" to int 60
// Learned: declare(strict_types=1); must be the very first statement in a file to enforce strict typing

function otherAngle(int|float $a, int|float $b): int|float {

    // Solution 1: Simple, no defensive programming
    // return 180 - ($a + $b);

    // Solution 2(Preferred): With guard clauses
    // Learned: Guard clauses - early checking of inputs; exit immediately if invalid
    // It "guards" the rest of the function from running with bad data.
    // I put these because of the following mathematical truths about triangles.
    // Following conditions must be fulfilled for a triangle to be considered valid.

    if ($a <= 0 || $b <= 0) { // Condition 1: Interior angles must be positive non-zero
        throw new InvalidArgumentException("Angles must be positive");
    }
    if ($a >= 180 || $b >= 180) { // Condition 2: An angle cannot be equal or greater than 180
        throw new InvalidArgumentException("Individual angles cannot be equal or greater than 180");
    }
    if ($a + $b >= 180) { // Condition 3: Sum of both angles must be less than 180
        throw new InvalidArgumentException("Sum of the angles cannot be equal or greater than 180");
    }

    return 180 - ($a + $b);

}