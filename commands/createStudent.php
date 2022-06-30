<?php

use Alura\Doctrine\Entity\Phone;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();//gerenciador de entidades

$student = new Student();
$student->setNome($argv[1]); //recebendo o atributo nome pela linha de comando - variavel $argv

//$i = 2 - segundo argumento no comando de linha
//$argc - numero de argumentos
for ($i = 2; $i < $argc; $i++) {
    $phoneNumber = $argv[$i];
    $phone = new Phone();
    $phone->setPhoneNumber($phoneNumber);

    $student->addPhone($phone);
}


// inserindo um aluno no banco. o Doctrine mapeia todas as alterações em memória antes, e envia de uma só vez ao banco, otimizando (e muito) a performance da aplicação.
$entityManager->persist($student);
$entityManager->flush();