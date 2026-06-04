<?php
  function hoopCount (int $n) : string {
    // Note: I intentionally uncommented dead return statements for syntax highlighting and color coding
    // Colored code is easier to read at a glance within walls of gray block comments.
    // Alternate solutions are here to document my learning/thinking process, not intended as production code.
    
    // Solution 1(Preferred): Ternary one-liner
    return ($n >= 10) ? "Great, now move on to tricks" : "Keep at it until you get it";
    
    // Solution 2: Simple if/else statement
    if($n >= 10){
      return "Great, now move on to tricks";
    }
    else{
      return "Keep at it until you get it";
    }
    
    // Solution 3: Match approach
    return match(true){
      $n >= 10 => "Great, now move on to tricks",
      default => "Keep at it until you get it"
    };
  } 