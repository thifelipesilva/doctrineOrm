<?php

namespace Alura\Doctrine\Entity;

/**
 * @Entity
 */
class Phone {
    
    /**
     * @ID
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $phoneNumber;

    /**
     * @ManyToOne(targetEntity="Student")
     */
    private $student;


    public function getId(): int
    {
        return $this->id;
    }

    public function getPhoneNumber(): string             
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getStudent(): Student        
    {
        return $this->student;
    }

    public function setStudent(Student $student): self
    {
        $this->student = $student;
        return $this;
    }
}

