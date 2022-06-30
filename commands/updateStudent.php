<?php

use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';


$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$id = $argv[1];
$nameUpdated = $argv[2];


$student = $entityManager->find(Student::class, $id);
$student->setNome($nameUpdated);

$entityManager->flush();