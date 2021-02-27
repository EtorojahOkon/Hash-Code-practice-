<?php

/* Declarations */
$pizzas = array();
$output = array();
$two_p = array();
$three_p = array();
$four_p = array();
$people = array();
$count = 0;
$total = 0;

/* Requirements */
$input = file('a_example.in');
$info = $input[0];
$pizza_no = explode(" ", $input[0])[0];
$two_team_no = explode(" ", $input[0])[1];
$three_team_no = explode(" ", $input[0])[2];
$four_team_no = explode(" ", $input[0])[3];


/* Pizzas */
for ($i=0; $i < intval($pizza_no); $i++) { 
   array_push($pizzas, $i);
}

//shuffle($pizzas);

/* No of teams pizzas shared to */
for ($z=0; $z < intval($two_team_no); $z++) { 
   array_push($people, 2);
}

for ($y=0; $y < intval($three_team_no); $y++) { 
   array_push($people, 3);
}

for ($x=0; $x < intval($four_team_no); $x++) { 
   array_push($people, 4);
}

foreach ($people as $key => $value) {
   $total = $total + $value;
   $count++;
   if ($total > $pizza_no)  {
     break;
   }
   else {
      if($total !== $pizza_no && $total > $pizza_no) {
         $a = intval($count - 1);
      }
      else {
         $a = $count;
      }
   }
   
}

array_push($output, $a."\n");

$shared_to = array_chunk($people, $a)[0];
$cnt2 = count(array_filter($shared_to, function($q){return $q == 2;})) * 2;
$cnt3 = count(array_filter($shared_to, function($q){return $q == 3;})) * 3;
$cnt4 = count(array_filter($shared_to, function($q){return $q == 4;})) * 4;

/* Actual sharing */
for ($j=0; $j < intval($cnt2); $j++) { 
   array_push($two_p, $pizzas[$j]);
   unset($pizzas[$j]);
}
$t_p = array_values($pizzas);

if(intval($pizza_no) >= 5) {
   for ($k=0; $k < intval($cnt3); $k++) { 
      array_push($three_p, $t_p[$k]);
      unset($t_p[$k]);
   }
}
$tr_p = array_values($t_p);

if(intval($pizza_no) >= 9) {
   for ($l=0; $l < intval($cnt4); $l++) { 
      array_push($four_p, $tr_p[$l]);
   }
}

if (count($two_p) !== 0) {
   for ($u=0; $u < count($two_p); $u++) { 
      if ($u % 2 !== 0) {
         array_push($output, "2 ".$two_p[$u - 1]." ".$two_p[$u]."\n");
      }
   }
}

if(count($three_p) !== 0) {
   for ($u=0; $u < count($three_p); $u++) { 
      if ($u % 3 == 0) {
        array_push($output, "3 ".$three_p[$u]." ".$three_p[$u + 1]." ".$three_p[$u + 2]."\n");
      }
   }
}

if(count($four_p) !== 0) {
   for ($u=0; $u < count($four_p); $u++) { 
      if ($u % 4 == 0) {
         array_push($output, "4 ".$four_p[$u]." ".$four_p[$u + 1]." ".$four_p[$u + 2]." ".$four_p[$u + 3]."\n");
      }
   }
}

// Write to Output file
file_put_contents('outputs/example.txt', implode("", $output));
?>