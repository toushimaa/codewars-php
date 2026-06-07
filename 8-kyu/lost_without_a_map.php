<?php

function maps(array $arr): array {
  // Solution 1: array_map()
  return array_map(fn($item) =>  $item * 2 , $arr);

  // Solution 2: foreach
  /*
  $newArr = [];
  foreach ($arr as $item){
    $newArr[] = $item * 2;

  return $newArr;
  */
}