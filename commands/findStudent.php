<?php

use Alura\Doctrine\Entity\Phone;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();



$studentRepository = $entityManager->getRepository(Student::class);//tipo de repositorio

/**
 * @var Student[] $studentList
 */
$studentList = $studentRepository->findAll();//buscando todos alunos

foreach($studentList as $student) {
    $phones = $student
        ->getPhone()
        ->map(function (Phone $phone) {
            return $phone->getPhoneNumber();
        })
        ->toArray();
    echo "ID: {$student->getId()}\nNome: {$student->getNome()}\n";
    echo "Telefones: " . implode(', ', $phones) . PHP_EOL;
}


