<?php
// Note: I intentionally uncommented dead return statements for syntax highlighting and color coding
// Colored code is easier to read at a glance within walls of gray block comments.
// Alternate solutions are here to document my learning/thinking process, not intended as production code.

// Solution: match(true) approach
// Why match? Uses '===' strict equal vs switch's loose equal '=='
// Can return and handle multiple conditions, for switch case statements, I'd have to do a fall-through by purposefully omitting break statements
// match is an expression, unlike switch, and has no fall-through by default
// No need for break statement, once a 'match' is found, only that code will be executed
// If no match is found and there's no default, PHP will throw an 'UnhandledMatchError' exception

// function for fixed amount of parameters (most appropriate for this kata)
function getGrade(int|float $a, int|float $b, int|float $c): string {

  $score = ($a + $b + $c) / 3; // calculate and store the average score

  return match(true) {
    90 <= $score && $score <= 100 => 'A',
    80 <= $score && $score <  90	=> 'B',
    70 <= $score && $score <  80	=> 'C',
    60 <= $score && $score <  70  => 'D',
    default                       => 'F',
  };
  
}

// function for a variable amount of subjects to be graded
function getVariadicGrade(int|float ...$scores): string {

  // Guard clause for passing empty values
  if (count($scores)===0) throw new InvalidArgumentException("At least one score must be provided");

  $averageScore = array_sum($scores) / count($scores); // calculate and store the average score

  return match(true) {
    90 <= $averageScore && $averageScore <= 100 => 'A',
    80 <= $averageScore && $averageScore <  90	=> 'B',
    70 <= $averageScore && $averageScore <  80	=> 'C',
    60 <= $averageScore && $averageScore <  70  => 'D',
    default                                     => 'F',
  };

}

/*
Pre-PHP 5.6 equivalent (no splat operator):
  function getVariadicGrade(): string {

    $scores = func_get_args();
    $averageScore = array_sum($scores) / count($scores);

    return match(true) {
      90 <= $averageScore && $averageScore <= 100 => 'A',
      80 <= $averageScore && $averageScore <  90  => 'B',
      70 <= $averageScore && $averageScore <  80  => 'C',
      60 <= $averageScore && $averageScore <  70  => 'D',
      default                                     => 'F',
    };

  }
*/

// for grading each student's individual scores instead of average (optional feature), just a personal challenge
function getEachGrade(int|float ...$scores): array {

  // Guard clause for passing empty values
  if (empty($scores)) throw new InvalidArgumentException("At least one score must be provided");

  // 1. Imperative approach
  // Initialize empty array to hold the results
  $results = [];

  // Evaluate each score and store the matched grade into array $results
  foreach ($scores as $score) {
    $results[] = match(true) {
      90 <= $score && $score <= 100 => 'A',
      80 <= $score && $score <  90	=> 'B',
      70 <= $score && $score <  80	=> 'C',
      60 <= $score && $score <  70  => 'D',
      default                       => 'F',
    };
  }

  // Return the array
  return $results;

  // 2. Declarative approach
  // Using array_map()
  return array_map(
    fn($score) => match(true) {
        90 <= $score && $score <= 100 => 'A',
        80 <= $score && $score <  90	=> 'B',
        70 <= $score && $score <  80	=> 'C',
        60 <= $score && $score <  70  => 'D',
        default                       => 'F',
      },
      $scores
  );
  // I personally found foreach more readable, but I practiced the steps for array_map and written it over and over again until I get it in my head

  // How the array_map works and my personal explanation:
  // Step 1. Look at $scores as the array to derive from(2nd parameter in array_map)
  // Step 2. Take the 1st element in $scores then assign it to $score
  // Step 3. Do the match expression and see what the $score evaluates to what letter grade.
  // Step 4. Save the result and "array_push" it into the brand-new array
  // Step 5. Move into the 2nd element and repeat from Step 3, repeat until you've gone through the whole array of $scores.
  // Step 6. Then finally, return it as an array that now contains these new values, aka the letter grades.

  // Alternative explanation:
  // "Derive from 1st element from the array in the 2nd parameter,
  // then call the function that we anonymously created that contains the match expression for it to be called over and back again in every element we access in array $scores,
  // so it looks for the 2nd element in the array, "calls back" the function again, 3rd element, "call it back" again,
  // repeat until you went through all the array, and then finally, return it as an array that now contains these new values, aka the letter grades"

  // Alternative, more readable way to use array_map
  // 1. Define the function to be called back over and over again for each element in the array
  /*
  function scoreToLetter(int|float $score): string {
    return match(true) {
      90 <= $score && $score <= 100 => 'A',
      80 <= $score && $score <  90	=> 'B',
      70 <= $score && $score <  80	=> 'C',
      60 <= $score && $score <  70  => 'D',
      default                       => 'F',
    };
  }
  $results = array_map("scoreToLetter", $scores);
  return $results;
  */
  // 2. foreach element in $scores, call scoreToLetter() to convert each individual $score derived from $scores to its letter grade,
  // then finally, return it and store in $results
  // Learned: defining scoreToLetter() inside here would register it globally, and by the 2nd time getEachGrade is called, it would throw an exception. Don't do in live code.
}

// In the real world scenario, subjects in school aren't fixed as 3, it makes more sense to implement it dynamically where you can input variable amounts of parameters for it
// which led me to find solutions and discover about variadic functions and how it's meant to be used for these kinds of scenarios.

// Learned: variadic functions - accept a variable number of arguments, where you don't know exactly how many parameters the user might pass ahead of time.
// Learned: func_get_args() - archaic way to return a copy of the passed arguments as an indexed array and can only be called inside a function
// Learned: '...' splat operator - gathers inputs into an array; modern version of implementing func_get_args()
// Learned: array_sum() - takes an array as the parameter and calculates the sum of all elements within and returns it as int|float
// Learned: count() - 'count' how many elements are there in the array; has an optional mode to also count elements for multidimensional arrays
// Learned: match expression - modern alternative to switch case statements
// Learned: echo - I tried to return array $results and discovered that echo can only display strings; does type coercion, if you pass int 3, it'll convert to "3" before outputting
// Learned: print_r() - for quick debugging; displays information about a variable to be easy to be read
// Learned: var_dump() - same but with more detail; for deeper technical debugging
// Learned: json_encode() - convert into JSON string. Primary purpose is for data transfer / API responses
// Learned: JSON_PRETTY_PRINT for 2nd parameter in json_encode() to add spaces and line breaks
// Learned: array_map() - returns a brand-new array containing the transformed values from the original array; requires a callback function in the 1st parameter
// array_map strictly requires the second argument and any subsequent parameters to be arrays
// Learned: array_push() - insert one or more elements at the end of the array

// Learned: callback function - a function that you pass as an argument into another function and is then executed inside that outer function to complete a specific action or routine
// Learned: anonymous function - a function with no name definition, making function(){} but completely skipping the name; can be assigned to a variable
// It can have multiple lines of code, explicit type hints, and requires a manual return statement.
// Learned: arrow functions - were introduced in PHP 7.4 as a more concise syntax for anonymous functions.
// uses fn keyword instead of function, uses an arrow =>, has implicit return, no curly braces and is strictly limited to one single expression
// Variable scope difference: Standard anonymous functions are isolated from the outside.
// It cannot see variables outside of itself unless you explicitly hand them over using the use keyword.
// The use keyword allows the function to access variables from the outside scope.
// By default, variables are passed by value (a copy), and to modify the original variable, pass it by reference using &.

/*
// An Anonymous Function assigned to a variable
$discount = 10;

// MUST use the 'use' keyword here to access $discount ($discount is outside the scope of $calculateTotal)
$calculateTotal = function ($price) use ($discount) {
  return $price - $discount;
};

echo $calculateTotal(100); // Outputs: 90

// An Arrow Function doing the exact same thing
$calculateTotal = fn($price) => $price - $discount;
*/

/*
$passingGrade = 75;

// This fails because it cannot see $passingGrade
$check = function($score) {
    return $score >= $passingGrade; 
};

//  This works because we explicitly opened the door with "use" keyword
$check = function($score) use ($passingGrade) {
    return $score >= $passingGrade;
};

$passingGrade = 75;

//  This works perfectly out of the box! It captures $passingGrade automatically.
$check = fn($score) => $score >= $passingGrade;
*/

// Printing/Debugging:
// echo getGrade(70, 70, 100); // should return 'B'
// echo getVariadicGrade(70, 70, 100, 85, 90); // average is 83, should return 'B'
// echo "[" . implode(", ", getEachGrade(70, 70, 100, 85, 90)) . "]"; // should return the array then formatted as string "[C, C, A, B, A]"
// echo print_r(getEachGrade(70, 70, 100, 85, 90));
// var_dump(getEachGrade(70, 70, 100, 85, 90));
// echo json_encode(getEachGrade(70, 70, 100, 85, 90), JSON_PRETTY_PRINT);