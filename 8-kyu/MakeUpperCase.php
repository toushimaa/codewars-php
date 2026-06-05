<?php
function makeUpperCase(string $input): string {
  
  // Note: I intentionally uncommented dead return statements for syntax highlighting and color coding
  // Colored code is easier to read at a glance within walls of gray block comments.
  // Alternate solutions are here to document my learning/thinking process, not intended as production code.
  
  // Solution 1(Preferred): Multibyte string to upper function. Useful for words like 'café' to turn into 'CAFÉ' which strtoupper() lacks. Also good for non-English characters.
  return mb_strtoupper($input, 'UTF-8');
  
  // Solution 2: String to upper function
  return strtoupper($input);
  
  // Solution 3: ASCII approach. ASCII table of 'a-z' is from 97-122 and its uppercase equivalent is 32 below
  // 1. Initialize $result as empty string
  // 2. Learned: ord() function to return the ASCII value of a character. 
  // 3. Loop through all the individual characters of a string.
  // 4. Put into $char the currently indexed character of the input $string
  // 5. Put into $ascii the ASCII value of $char
  // 6. Check if the character is in the lowercase letters, if yes, subtract by 32 which would be equivalent to its uppercase, if not, simply put whatever the $char is into the variable $result
  // 7. Repeat until we've gone through each of the input string's characters
  // 8. Finally, return the resulting string through $result
  // 9. Learned: chr() function is basically the opposite of ord() so it converts back to the character
  // 10. Learned: mb_strlen(), just like strlen() but to handle multi-byte characters like the é from café
  
  $result = "";
  
  for($i = 0; $i < mb_strlen($input); $i++){
    
    $char = $input[$i];
    // $ascii = ord($char);
    
    // if($ascii >= 97 && $ascii <= 122){ // alternative
    if($char >= 'a' && $char <= 'z'){ // as per the lesson in my Fake Binary solution referencing about ASCII
      $result .= chr(ord($char) - 32); // get the ASCII value of $char, minus it by 32, then convert it back to the character according to its ASCII equivalent
    }
    else{
      $result .= $char;
    }

  }
  
  return $result;
  
}