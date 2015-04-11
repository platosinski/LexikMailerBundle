<?php

namespace Lexik\Bundle\MailerBundle\Model;

/**
 * Class EmailManager
 *
 * @package Lexik\Bundle\MailerBundle\Model
 */
abstract class EmailManager implements EmailManagerInterface
{
    /**
     * @return BaseEmail
     */
    public function createEmail()
    {
        $class = $this->getEmailClass();
        $email = new $class;

        return $email;
    }

    /**
     * @param BaseEmail $email
     * @param string    $lang
     *
     * @return BaseEmailTranslation
     */
    public function createEmailTranslation(BaseEmail $email, $lang = null)
    {
        $class = $this->getEmailTranslationClass();
        /** @var BaseEmailTranslation $translation */
        $translation = new $class($lang);
        $translation->setEmail($email);

        return $translation;
    }
}
