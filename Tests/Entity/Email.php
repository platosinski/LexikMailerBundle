<?php

namespace Lexik\Bundle\MailerBundle\Tests\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lexik\Bundle\MailerBundle\Entity\Email as BaseEmail;

/**
 * Class Email
 *
 * @package Lexik\Bundle\MailerBundle\Tests\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="lexik_email")
 */
class Email extends BaseEmail
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var EmailTranslation[]
     *
     * @ORM\OneToMany(targetEntity="Lexik\Bundle\MailerBundle\Tests\Entity\EmailTranslation", mappedBy="email", cascade={"all"})
     */
    protected $translations;

    /**
     * @var Layout
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\MailerBundle\Tests\Entity\Layout")
     */
    protected $layout;

    /**
     * Get id
     */
    public function getId()
    {
        return $this->id;
    }
}
