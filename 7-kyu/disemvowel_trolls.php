<?php
  
function disemvowel(string $s): string {

  // Note: I intentionally uncommented dead return statements for syntax highlighting and color coding
  // Colored code is easier to read at a glance within walls of gray block comments.
  // Alternate solutions are here to document my learning/thinking process, not intended as production code.

  // Non-regex solution
  // Solution 1.A
  $vowels = ['a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U'];
  $characters = str_split($s);
  $filteredText = "";

  foreach ($characters as $character) {
    if (!in_array($character, $vowels, true)) {
      $filteredText .= $character;
    }
  }
  return $filteredText;

  // Solution 1.B
  $vowels = ['a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U'];
  return str_replace($vowels, "", $s);
  // Learned: str_replace can take array on its 1st parameter, and then replace each element in the array with the 2nd parameter, from the one being searched and replaced on (3rd parameter)
  // TL;DR "Replace all the vowels with an empty string from $s"

  // Regex solution - /pattern/
  // Look for vowels
  // Substitute with ""
  // return the filtered text
  
  // Solution 2.A
  return preg_replace("/[aeiouAEIOU]/", "", $s);
  
  // Solution 2.B - with i flag (Preferred)
  return preg_replace("/[aeiou]/i", "", $s);
  // Learned: i flag - ignore case
  // Learned: [] character class - matches any single character listed within the brackets
  // [aeiou] matches any one of: a, e, i, o, u

}