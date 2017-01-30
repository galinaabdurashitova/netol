<?php

interface Product
{
  public function getDescription();
  public function getInfo();
}

trait WeightDiscount
{
  protected function changeDiscount()
  {
    if ($this->weight < 10) {
      $this->discount = 0;
    }
  }
}

abstract class Object
{
  protected $price;
  protected $discount = 10;

  public function setPrice($newPrice)
  {
    $this->price = $newPrice;
  }

  protected function setDiscount($newDiscount)
  {
    $this->discount = $newDiscount;
  }

  public function getPrice()
  {
    return $this->price - ($this->price * ($this->discount / 100)) + $this->deliveryPrice();
  }

  private function deliveryPrice()
  {
    if ($this->discount > 0) {
      return 300;
    } else {
      return 250;
    }
  }

  public abstract function getDescription();

}


class Hoodie extends Object implements Product
{
  private $size;
  private $color;

  public function __construct($size, $color)
  {
    $this->size = $size;
    $this->color = $color;

  }

  public function getDescription()
  {
    return 'Толстовка цвета ' . $this->color . ' и ' . $this->size . ' размера.';
  }

  public function getInfo()
  {
    return array($this->size, $this->color);
  }
}


class Coffee extends Object implements Product
{
  private $name;
  private $weight;
  use WeightDiscount;

  public function __construct($name, $weight)
  {
    $this->name = $name;
    $this->weight = $weight;
    $this->changeDiscount();
  }

  public function getDescription()
  {
    return 'Пакет кофейных зерен фирмы ' . $this->name . ' и весом ' . $this->weight . 'кг.';
  }

  public function getInfo()
  {
    return array($this->name, $this->weight);
  }
}


class Cup extends Object implements Product
{
  private $capacity;
  private $color;

  public function __construct($capacity, $color)
  {
    $this->capacity = $capacity;
    $this->color = $color;
  }

  public function getDescription()
  {
    return 'Кружка объемом ' . $this->capacity . 'мл и цвета ' . $this->color . '.';
  }

  public function getInfo()
  {
    return array($this->capacity, $this->color);
  }
}


$hoodie1 = new Hoodie('s', 'красный');
$hoodie1->setPrice(1000);
echo $hoodie1->getPrice() . '<br>';
$coffee1 = new Coffee('Арабика', 9);
$coffee1->setPrice(15000);
echo $coffee1->getPrice() . '<br>';
$cup1 = new Cup('200', 'белый');
$cup1->setPrice(200);
echo $cup1->getPrice() . '<br>';
