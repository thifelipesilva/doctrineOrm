<?php

namespace Alura\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Entity
 */
class Curso {

    /**
     * @ID
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $name;

    /**
     * @ManyToMany(targetEntity="Student", inversedBy="cursos")
     */
    private $students;

    public function __construct()
    {   
        $this->students = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self     
    {
        $this->name = $name;
        return $this;
    }

    public function addStudent(Student $student): self
    {
        if ($this->students->contains($student)) {
            return $this;
        }
        $this->students->add($student);
        return $this;
    }

    public function getStudents(): Collection
    {
        return $this->students;
    }

}