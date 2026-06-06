<?php

  // Note: I intentionally uncommented dead return statements for syntax highlighting and color coding
  // Colored code is easier to read at a glance within walls of gray block comments.
  // Alternate solutions are here to document my learning/thinking process, not intended as production code.

function fake_bin(string $s): string {
  // Solution 1: For-if loop using string's length as the counter
  // Learned: is_numeric() built-in function from PHP. Returns true if parameter is a number or a numeric string
  // Learned: throw new Exception to handle when user submits invalid input to tell what PHP should do
  // instead of just silently doing a type-juggling and returning the wrong result without any kind of warning
  
  if(is_numeric($s)){
    for($i = 0; $i < strlen($s); $i++){
      if($s[$i] < 5){
      $s[$i] = 0;
      }
      else if($s[$i] >= 5){
      $s[$i] = 1;
      }
    }
  }
  // Edge case handling if strictly only accepting numbers
  // Learned: Apparently PHP treats a character to its corresponding ASCII value when I used a comparison operator between a character and a number
  // I tried to make it so that if there's a non-number, it would leave it as it is so if the input test case is "4530a8b9", it'll go through the 0 and 1 fake binary filtering
  // while leaving the characters as it is, intended to return the input string "4530a8b9" as "0100a1b1"
  else{
    throw new Exception("Invalid character detected");
  }

  return $s;
  
  // Solution 2: Refactored Solution 1 using ternary

  for ($i = 0; $i < strlen($s); $i++){
    $s[$i] = $s[$i] >= 5 ? 1 : 0;
  }
  
  // condensed in one line, Solution 1 is over-engineered for this specific kata.
  for ($i = 0; $i < strlen($s); $i++) { $s[$i] = ($s[$i] >= 5) ? 1 : 0; } 
  return $s;

  // Solution 3: Regex approach
  return preg_replace(
    array("/[01234]/", "/[56789]/"),
    array("0", "1"),
    $s
  );

  // Solution 4(Preferred): String translate
  return strtr($s, "0123456789", "0000011111");

  // Solution 5: String replace

  // Readability alternative: explicit arrays make it clearer which digits are being replaced.
  // range(0, 4) is shorter, but it relies on PHP converting integers to string search values.
  // $s = str_replace(["0", "1", "2", "3", "4"], "0", $s);
  // $s = str_replace(["5", "6", "7", "8", "9"], "1", $s);

  $s = str_replace(range(0,4), 0, $s);
  $s = str_replace(range(5,9), 1, $s);
  return $s;
}