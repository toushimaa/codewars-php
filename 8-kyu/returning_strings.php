<?php

function greet(string $name): string {
    //Solution 1: Simple, basic string interpolation
    return "Hello, {$name} how are you doing today?";

    // Solution 2: Using sprintf() function
    // sprintf tends to be useful when there are 2 or more variables, like using a string and then a float as example.
    return sprintf("Hello, %s how are you doing today?", $name);
    
}