<?php

namespace Lexik\Bundle\MailerBundle\Model;

/**
 * Interface EmailManagerInterface
 * @package Lexik\Bundle\MailerBundle\Model
 */
interface EmailManagerInterface
{
    /**
     * @return BaseEmail
     */
    public function createEmail();

    /**
     * @param BaseEmail $email
     * @param string    $lang
     *
     * @return mixed
     */
    public function createEmailTranslation(BaseEmail $email, $lang = null);

    /**
     * @return string
     */
    public function getEmailClass();

    /**
     * @return string
     */
    public function getEmailTranslationClass();

    /**
     * @param $email
     */
    public function save($email);
}
