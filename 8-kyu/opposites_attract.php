<?php
  
function lovefunc(int $flower1, int $flower2) : bool {
  // Note: I intentionally uncommented dead return statements for syntax highlighting and color coding
  // Colored code is easier to read at a glance within walls of gray block comments.
  // Alternate solutions are here to document my learning/thinking process, not intended as production code.

  // Explicit outer parentheses for better code readability
  // The very first solution that came to my mind since it resembled an XOR gate.
  // Solution 1.A: Exclusive OR (XOR) approach
  return (($flower1 % 2 === 0) xor ($flower2 % 2 === 0)); // ? true : false; <-- added this on my first try, removed since it already evaluates to bool.
  
  // Solution 1.B: "xor" is exactly the same as "strictly not equal to" !==
  return (($flower1 % 2 === 0) !== ($flower2 % 2 === 0));
  
  // Solution 2: Mathematical approach by summation of two numbers, still resembling an XOR truth table.
  //        Even + Even = Even
  //        Odd  + Odd  = Even
  //        Odd  + Even = Odd
  //        Even + Odd  = Odd
  return ($flower1 + $flower2) % 2 !== 0;
  // if remainder is non-zero, then the sum is odd. They are only in love if the sum is odd.
  // Flower petals in real life are equivalent to an absolute value,
  // I considered "=== 1" instead of "!== 0" for better readability, but resorted back to "!== 0" to handle negative edge cases.

  // Solution 3: Bitwise solution. Usage of bitwise xor instead of logical xor or "!==" operator.
  return ($flower1 ^ $flower2) & 1;
  // Step 1. Do bitwise XOR on the two numbers first.
  // Step 2. Then do bitwise AND (& 1) to evaluate the last bit, return int 1, otherwise return int 0.
  // Step 3. Because we declared the function with ": bool" return type declaration, PHP will automatically do a type casting.
  // Step 4. PHP casts the integer 0 as false, integer 1 as true.

  // Bitwise equation, visualized:
  // When reading the binary sequence from left to right, we only care about the last bit aka the Least Significant Bit.
  // Test Case 1:
  //
  // Step 1. ($flower1 ^ $flower2)
  //   0 0 0 1  (1) (Odd)
  // ^ 0 1 0 0  (4) (Even)
  //   -----------
  //   0 1 0 1  (5) returns int 5
  //
  // Step 2. (& 1)
  //   0 1 0 1 (5) (from ($flower1 ^ $flower2))
  // & 0 0 0 1 (1)
  //   -----------
  //   0 0 0 1 (1) returns int 1

}