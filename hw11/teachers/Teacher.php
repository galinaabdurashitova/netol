<?php

namespace hw11\Teachers;

function myAutoloader($classNameWithNameSpace)
{
  $pathToFile = str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'] . '/' . $classNameWithNameSpace . '.php');
  if (file_exists($pathToFile)) {
    include $pathToFile;
  }
}

spl_autoload_register('hw11\Teachers\myAutoloader');

interface TeachersInterface
{
  public function lesson($student);
  public function checkHomework($student, $homework);
}

class Teacher implements TeachersInterface
{
  private $name;

  public function __construct($name)
  {
    $this->name = $name;
  }

  public function lesson($studentsArray)
  {
    echo $this->name . ': Урок проведен<br>';
    foreach ($studentsArray as $student) {
      $homework = new \hw11\Homeworks\Homework($this->name, $student->myName());
      $student->getHomework($homework);
    }
  }

  public function checkHomework($student, $homework)
  {
    try {
      $this->checkOwner($student->myName(), $homework->studentName());
    } catch (NotOwnHomework $e) {
      echo $this->name . ': ' . $e->getMessage();
      $homework->marking(1);
    }

    if ($homework->checkMark() == Null) {
      if ($homework->checkStatus() == False) {
        $homework->marking(1);
        echo $this->name . ': ' . $student->myName() . ' не сделал домашнее задание<br>';
      } else {
        $homework->marking(rand(2,5));
        echo $this->name . ': Домашняя работа от ' . $student->myName() . ' проверена<br>';
      }
    }
  }

  private function checkOwner($name1, $name2)
  {
    if ($name1 !== $name2) {
      throw new NotOwnHomework('Ученик ' . $name1 . ' принес не свою работу<br>');
    }
  }
}

class NotOwnHomework extends \Exception {}
