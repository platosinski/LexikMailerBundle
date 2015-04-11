<?php

namespace Lexik\Bundle\MailerBundle\Tests\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lexik\Bundle\MailerBundle\Entity\LayoutTranslation as BaseLayoutTranslation;

/**
 * Class LayoutTranslation
 *
 * @package Lexik\Bundle\MailerBundle\Tests\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="lexik_layout_translation")
 */
class LayoutTranslation extends BaseLayoutTranslation
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
     * @var Layout
     *
     * @ORM\ManyToOne(targetEntity="Lexik\Bundle\MailerBundle\Tests\Entity\Layout", inversedBy="translations")
     * @ORM\JoinColumn(name="layout_id", referencedColumnName="id", onDelete="CASCADE")
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
