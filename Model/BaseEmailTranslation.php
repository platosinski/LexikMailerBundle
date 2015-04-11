<?php

namespace Lexik\Bundle\MailerBundle\Model;

use Symfony\Component\Locale\Locale;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Laurent Heurtault <l.heurtault@lexik.fr>
 * @author Cédric Girard <c.girard@lexik.fr>
 * @author Yoann Aparici <y.aparici@lexik.fr>
 */
class BaseEmailTranslation
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=2)
     */
    protected $lang;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    protected $subject;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    protected $body;

    /**
     * @var string
     */
    protected $bodyText;

    /**
     * @var string
     *
     * @Assert\Email()
     */
    protected $fromAddress;

    /**
     * @var string
     */
    protected $fromName;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var \Lexik\Bundle\MailerBundle\Model\BaseEmail
     *
     * @Assert\NotBlank()
     */
    protected $email;

    /**
     * __construct
     *
     * @param string $lang
     */
    public function __construct($lang = null)
    {
        $this->lang = $lang;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set lang
     *
     * @param string $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set subject
     *
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set body
     *
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get bodyText
     *
     * @return string
     */
    public function getBodyText()
    {
        return $this->bodyText;
    }

    /**
     * Set bodyText
     *
     * @param string $bodyText
     */
    public function setBodyText($bodyText)
    {
        $this->bodyText = $bodyText;
    }

    /**
     * Get from address
     *
     * @return string
     */
    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    /**
     * Set from address
     *
     * @param string $fromAddress
     */
    public function setFromAddress($fromAddress)
    {
        $this->fromAddress = $fromAddress;
    }

    /**
     * Get from name
     *
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * Set from name
     *
     * @param string $fromName
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get email
     *
     * @return BaseEmail
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param BaseEmail $email
     */
    public function setEmail(BaseEmail $email)
    {
        $this->email = $email;
    }

    /**
     * Display language
     *
     * @return string
     */
    public function displayLanguage()
    {
        return Locale::getDisplayLanguage($this->getLang());
    }
}
