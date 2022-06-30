<?php

use Alura\Doctrine\Entity\Phone;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . "/../vendor/autoload.php";

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();


$studentsRepository = $entityManager->getRepository(Student::class);

/**
 * @var Student[] $students
 */
$students = $studentsRepository->findAll();

foreach ($students as $student) {
    $phones = $student
        ->getPhone()
        ->map(function(Phone $phone){
            return $phone->getPhoneNumber();
        })
        ->toArray();

    echo "Id: {$student->getId()}\n";
    echo "Nome: {$student->getNome()}\n";
    echo "Telefone: " . implode(", ", $phones) . "\n";
    
    
    $allClass = $student->getCursos();

    foreach  ($allClass as $class) {
        echo "\tID Curso: {$class->getId()}\n";
        echo "\tCurso: {$class->getName()}\n";
        echo "\n";
    }

    echo "\n";
}