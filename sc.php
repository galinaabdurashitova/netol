<?php
function alg($x, $y = 1, $z = 1) {
  if ($x < $y) {
    return 'задуманное число НЕ входит в числовой ряд';
  }
  if ($x == $y) {
    return 'задуманное число входит в числовой ряд';
  }
  else {
    $t = $y;
    $y += $z;
    $z = $t;
    return alg($x, $y, $z);
  }
}

$x = $_GET['x'];
echo alg($x);
?>
