<?php
/**
 * Created by PhpStorm.
 * User: mariusz
 * Date: 22.02.17
 * Time: 01:21
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * ChosenProgram
 *
 * @ORM\Table(name="chosen_program")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChosenProgramRepository")
 */
class ChosenProgram
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SchoolClass", inversedBy="classes")
     */
    private $class;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="users")
     */
    private $teacher;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Program", inversedBy="programs")
     */
    private $program;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

//    /**
//     * @param mixed $id
//     */
//    public function setId($id)
//    {
//        $this->id = $id;
//    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * @param mixed $teacher
     */
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * @return mixed
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * @param mixed $program
     */
    public function setProgram($program)
    {
        $this->program = $program;
    }

}