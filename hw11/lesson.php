<?php

namespace hw11;

function myAutoloader($classNameWithNameSpace)
{
  $pathToFile = str_replace('/', DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT'] . '/' . $classNameWithNameSpace . '.php');
  if (file_exists($pathToFile)) {
    include $pathToFile;
  }
}

spl_autoload_register('hw11\myAutoloader');

$teacher1 = new Teachers\Teacher('Мария Ивановна');

$classArray = array(new Students\Student('Боря'), new Students\Student('Вова'), new Students\Student('Паша'), new Students\Student('Вася'));
$teacher1->lesson($classArray);

$classArray[0]->makeHomework();
$classArray[1]->homework = clone $classArray[0]->homework;
$classArray[1]->homework->student = $classArray[1]->myName();
$classArray[2]->cheatHomework();

foreach ($classArray as $student) {
  $teacher1->checkHomework($student, $student->homework);
}

foreach ($classArray as $student) {
  $student->getMark();
}
