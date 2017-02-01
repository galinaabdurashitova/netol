<?php

namespace hw11\Students;

function myAutoloader($classNameWithNameSpace)
{
  $pathToFile = str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'] . '/' . $classNameWithNameSpace . '.php');
  if (file_exists($pathToFile)) {
    include $pathToFile;
  }
}

spl_autoload_register('hw11\Teachers\myAutoloader');

interface StudentsInterface
{
  public function myName();
  public function getHomework($homework);
  public function makeHomework();
  public function getMark();
}

class Student implements StudentsInterface
{
  private $name;
  public $homework = Null;

  public function __construct($name)
  {
    $this->name = $name;
  }

  public function myName()
  {
    return $this->name;
  }

  public function getHomework($homework)
  {
    $this->homework = $homework;
    echo $this->name . ': Задание получил<br>';
  }

  public function makeHomework()
  {
    if ($this->homework === Null) {
      echo $this->name . ': У меня нет домашки<br>';
    } else {
      if ($this->homework->checkStatus()) {
        echo $this->name . ': Я уже сделал это задание<br>';
      } else {
        echo $this->name . ': Ура! ';
        $this->homework->done();
      }
    }
  }

  public function cheatHomework()
  {
    $homework = new \hw11\Homeworks\Homework($this->homework->teacherName(), 'Петя');
    $this->homework = $homework;
    echo $this->name . ': Ха-ха-ха! Я все списал, и никто не заметит<br>';
  }

  public function getMark()
  {
    if ($this->homework->checkMark() != Null) {
      if ($this->homework->checkMark() > 3) {
        echo $this->name . ': Я рад :)<br>';
      } else {
        echo $this->name . ': Я расстроен :(<br>';
      }
      $this->homework = '';
    } else {
      echo $this->name . ': Это задание еще не проверено<br>';
    }
  }
}
