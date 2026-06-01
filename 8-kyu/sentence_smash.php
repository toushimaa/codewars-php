<?php

function smash(array $words): string
{
    // Note: I intentionally uncommented dead return statements for syntax highlighting and color coding
    // Colored code is easier to read at a glance within walls of gray block comments.
    // Alternate solutions are here to document my learning/thinking process, not intended as production code.

    // Solution 1: One-liner using implode()
    return implode(" ", $words);

    // Solution 2: Manual approach using a boolean flag
    
    $sentence = "";
    $isFirst = true;
    foreach ($words as $individualWords) {
        if ($isFirst) {
            $sentence .= $individualWords;
            $isFirst = false;
        } else {
            $sentence .= " " . $individualWords;
        }
    }
    return $sentence;
    

    // Solution 3: No boolean flag — using index check instead
    
    $sentence = "";
    foreach ($words as $index => $word) {
        $sentence .= ($index === 0) ? $word : " " . $word;
    }
    return $sentence;
    
}