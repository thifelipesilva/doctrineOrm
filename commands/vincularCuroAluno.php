<?php

use Alura\Doctrine\Entity\Curso;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . "/../vendor/autoload.php";


$entityManagerFactory  = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$idStudent = $argv[1];
$idClass = $argv[2];

/**
 * @var Curso $class
 */
$class = $entityManager->find(Curso::class, $idClass);

/**
 * @var Student $student
 */
$student = $entityManager->find(Student::class, $idStudent);

$class->addStudent($student);

$entityManager->flush();
