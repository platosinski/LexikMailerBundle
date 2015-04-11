<?php

namespace Lexik\Bundle\MailerBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Lexik\Bundle\MailerBundle\Model\LayoutManager as BaseLayoutManager;

/**
 * Class LayoutManager
 * @package Lexik\Bundle\MailerBundle\Doctrine
 */
class LayoutManager extends BaseLayoutManager
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var string
     */
    protected $layoutClass;

    /**
     * @var string
     */
    protected $layoutTranslationClass;

    /**
     * Constructor
     *
     * @param ObjectManager $manager
     * @param string        $layoutClass
     * @param string        $layoutTranslationClass
     */
    public function __construct(ObjectManager $manager, $layoutClass, $layoutTranslationClass)
    {
        $this->objectManager = $manager;
        $this->layoutClass = $layoutClass;
        $this->layoutTranslationClass = $layoutTranslationClass;
    }

    /**
     * @return string
     */
    public function getLayoutClass()
    {
        return $this->layoutClass;
    }

    /**
     * @return string
     */
    public function getLayoutTranslationClass()
    {
        return $this->layoutTranslationClass;
    }

    /**
     * @param      $entity
     * @param bool $flush
     */
    public function save($entity, $flush = true)
    {
        $this->objectManager->persist($entity);
        if ($flush) {
            $this->objectManager->flush();
        }
    }
}
