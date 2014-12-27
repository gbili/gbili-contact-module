<?php
namespace GbiliContactModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity 
 * @ORM\Table(name="gbili_contact_module_default_message")
 */
class DefaultMessage 
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(name="firstname", type="string", length=64)
     */
    private $firstname;

    /**
     * @ORM\Column(name="lastname", type="string", length=64)
     */
    private $lastname;

    /**
     * @ORM\Column(name="company", type="string", length=64)
     */
    private $company;

    /**
     * @ORM\Column(name="service", type="string", length=64)
     */
    private $service;

    /**
     * @ORM\Column(name="locale", type="string", length=6)
     */
    private $locale;

    /**
     * @ORM\Column(name="body", type="text", length=64)
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    public function __construct()
    {
    }

    public function hasId()
    {
        return null !== $this->id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setCompany($company)
    {
        $this->company = $company;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function setService($service)
    {
        $this->service = $service;
    }

    public function getService()
    {
        return $this->service;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @ORM\PrePersist
     */
    public function setDate(\DateTime $time)
    {
        $this->date = $time;
    }

    /**
     * Get Created Date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
