<?php

$animals = array(
  "Africa" => array("Hemisotidae", "Chamaeleonidae", "Panthera leo", "Giraffa camelopardalis", "Bucerotidae"),
  "North America" => array("Mammuthus columbi", "Martes americana", "Lynx canadensis", "Bison bison", "Spermophilus"),
  "Asia" => array("Castor fiber", "Falco peregrinus", "Ursus thibetanus", "Nyctereutes procyonoides", "Loris")
);


function second_task ($animals_all) {
  $animals_new = array();

  foreach ($animals_all as $continent => $animals_names) {
    $t = array();
    foreach ($animals_names as $name) {
      if (strpos($name, ' ') !== false) {
        $t[] = $name;
      }
    }

    if (count($t) !== 0) {
      $animals_new[$continent] = $t;
    }
  }

  return $animals_new;
}


function third_task ($animals_two_words) {
  $second_words = make_arr_second_words($animals_two_words);
  return make_arr_random_names($animals_two_words, $second_words);
}


function make_arr_second_words($animals_all) {
  $second_words = array();
  foreach ($animals_all as $continent => $animals) {
    foreach ($animals as $animal) {
      $animal = explode(' ', $animal);
      $second_words[] = $animal[1];
    }
  }
  return $second_words;
}


function make_arr_random_names($animals_all, $second_words) {
  $animals_fantastic = array();
  foreach ($animals_all as $continent => $animals) {
    foreach($animals as $animal) {
      do {
        $a = rand(0, count($second_words) - 1);
      } while ($second_words[$a] === '');
      $animal = explode(' ', $animal);
      $animals_fantastic[$continent][] = $animal[0] . ' ' . $second_words[$a];
      $second_words[$a] = '';
    }
  }

  return $animals_fantastic;
}


function printing ($animals_again) {
  $text = '';
  foreach ($animals_again as $continent => $animals) {
    $text = $text . '<div class="continent"><h2>' . $continent . '</h2>';

    $first = true;
    foreach ($animals as $animal)
    {
      if ($first) {
        $text .= $animal;
        $first = false;
      }
      else {
        $text .= ', ';
        $text = $text . $animal;
      }
    }
    $text = $text . '</div>';
  }
  return $text;
}


$a = second_task($animals);
$b = third_task($a);
$c = printing($b);

echo <<<HTML
<!DOCTYPE html>
<html>
<head>
<title>Animals</title>
</head>
<body>
  $c
</body>
</html>
HTML;
?>
