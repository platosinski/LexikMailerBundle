<?php

namespace Lexik\Bundle\MailerBundle\Tests\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lexik\Bundle\MailerBundle\Entity\EmailTranslation as BaseEmailTranslation;

/**
 * Class EmailTranslation
 *
 * @package Lexik\Bundle\MailerBundle\Tests\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="lexik_email_translation")
 */
class EmailTranslation extends BaseEmailTranslation
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
     * @var Email
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\MailerBundle\Tests\Entity\Email", inversedBy="translations")
     * @ORM\JoinColumn(name="email_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $email;

    /**
     * Get id
     */
    public function getId()
    {
        return $this->id;
    }
}
