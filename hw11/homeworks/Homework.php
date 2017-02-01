<?php

namespace hw11\Homeworks;

function myAutoloader($classNameWithNameSpace)
{
  $pathToFile = str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'] . '/' . $classNameWithNameSpace . '.php');
  if (file_exists($pathToFile)) {
    include $pathToFile;
  }
}

spl_autoload_register('hw11\Teachers\myAutoloader');

interface HomeworksInterface
{
  public function studentName();
  public function teacherName();
  public function checkStatus();
  public function done();
  public function marking($mark);
}

class Homework implements HomeworksInterface
{
  private $teacher;
  private $student;
  private $isDone = False;
  private $mark = Null;

  public function __construct($teacher, $student)
  {
    $this->teacher = $teacher;
    $this->student = $student;
  }

  public function __set($student, $otherName)
  {
    if ($otherName != $this->student) {
      echo $this->student . ', нельзя списывать!<br>';
    }
  }

  public function __unset($mark)
  {
    echo 'Нельзя исправлять журнал!<br>';
  }

  public function studentName()
  {
    return $this->student;
  }

  public function teacherName()
  {
    return $this->teacher;
  }

  public function checkStatus()
  {
    return $this->isDone;
  }

  public function checkMark()
  {
    return $this->mark;
  }

  public function done()
  {
    $this->isDone = True;
    echo 'Домашка сделана<br>';
  }

  public function marking($mark)
  {
    $this->mark = $mark;
    echo 'Оценка ' . $this->mark . ' поставлена<br>';
  }
}
