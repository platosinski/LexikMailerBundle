<?php

namespace Lexik\Bundle\MailerBundle\Tests\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lexik\Bundle\MailerBundle\Entity\Layout as BaseLayout;

/**
 * Class Layout
 *
 * @package Lexik\Bundle\MailerBundle\Tests\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="lexik_layout")
 */
class Layout extends BaseLayout
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
     * @var LayoutTranslation[]
     *
     * @ORM\OneToMany(targetEntity="Lexik\Bundle\MailerBundle\Tests\Entity\LayoutTranslation", mappedBy="layout", cascade={"all"})
     */
    protected $translations;

    /**
     * Get id
     */
    public function getId()
    {
        return $this->id;
    }
}
