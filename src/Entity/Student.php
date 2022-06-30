<?php

namespace Alura\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Entity
 */
class Student {
    /**
     * @ID
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $nome;

    /**
     * @OneToMany(targetEntity="Phone", mappedBy="student", cascade={"remove", "persist"})
     */
    private $phones;

    /**
     * ManyToMany(targetEntity="Curso", mappedBy="student")
     */
    private $cursos;


    public function __construct()
    {
        $this->phones = new ArrayCollection();
        $this->cursos = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    public function addPhone(Phone $phone): self     
    {
        $this->phones->add($phone);
        $phone->setStudent($this);//definindo q o telefone pertence ao aluno apos add o telefone.
        return $this;
    }

    public function getPhone(): Collection
    {
        return $this->phones;
    }

    public function addCurso(Curso $curso): self
    {
        if ($this->cursos->contains($curso)) {
            return $this;
        }

        $this->cursos->add($curso);
        $curso->addStudent($this);
        return $this;
    }

    /**
     * @return Curso
     */
    public function getCursos(): Collection
    {
        return $this->cursos;
    }
}