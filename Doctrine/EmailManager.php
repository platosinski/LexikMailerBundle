<?php

namespace Lexik\Bundle\MailerBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Lexik\Bundle\MailerBundle\Model\EmailManager as BaseEmailManager;

/**
 * Class EmailManager
 * @package Lexik\Bundle\MailerBundle\Doctrine
 */
class EmailManager extends BaseEmailManager
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var string
     */
    protected $emailClass;

    /**
     * @var string
     */
    protected $emailTranslationClass;

    /**
     * Constructor
     *
     * @param ObjectManager $manager
     * @param string        $emailClass
     * @param string        $emailTranslationClass
     */
    public function __construct(ObjectManager $manager, $emailClass, $emailTranslationClass)
    {
        $this->objectManager = $manager;
        $this->emailClass = $emailClass;
        $this->emailTranslationClass = $emailTranslationClass;
    }

    /**
     * @return string
     */
    public function getEmailClass()
    {
        return $this->emailClass;
    }

    /**
     * @return string
     */
    public function getEmailTranslationClass()
    {
        return $this->emailTranslationClass;
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
