<?php

use Alura\Doctrine\Entity\Curso;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . "/../vendor/autoload.php";




$entityManegerFactory = new EntityManagerFactory();
$entityManeger = $entityManegerFactory->getEntityManager();

$cursosRepository = $entityManeger->getRepository(Curso::class);

/**
 * @var Curso[] $cursoList
 */
$cursoList = $cursosRepository->findAll();

foreach($cursoList as $curso) {
    echo "ID: {$curso->getId()}\nNome: {$curso->getName()}\n";
}