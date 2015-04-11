<?php

namespace Lexik\Bundle\MailerBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Lexik\Bundle\MailerBundle\Exception\NoTranslationException;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Laurent Heurtault <l.heurtault@lexik.fr>
 * @author Cédric Girard <c.girard@lexik.fr>
 * @author Yoann Aparici <y.aparici@lexik.fr>
 */
class BaseEmail implements EmailInterface
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    protected $reference;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $bcc;

    /**
     * @var string
     */
    protected $spool;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $translations;

    /**
     * @var \Lexik\Bundle\MailerBundle\Model\BaseLayout
     */
    protected $layout;

    /**
     * The locale to use to get the right email content.
     *
     * @var string
     */
    private $locale;

    /**
     * Translation object for the current $this->locale value.
     *
     * @var \Lexik\Bundle\MailerBundle\Model\BaseEmailTranslation
     */
    private $currentTranslation;

    /**
     * @var array
     *
     * @Assert\Valid()
     */
    protected $headers;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->headers      = array();
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set reference
     *
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get bcc
     *
     *
     * @return string
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * Set bcc
     *
     * @param string $bcc
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
    }

    /**
     * Get spool
     *
     * @return string
     */
    public function getSpool()
    {
        return $this->spool;
    }

    /**
     * Set spool
     *
     * @param string $spool
     */
    public function setSpool($spool)
    {
        $this->spool = $spool;
    }

    /**
     * Set layout
     *
     * @param BaseLayout $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Get layout
     *
     * @return BaseLayout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Get translations
     *
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Add a translation
     *
     * @param BaseEmailTranslation $translation
     */
    public function addTranslation(BaseEmailTranslation $translation)
    {
        $this->translations->add($translation);
        $translation->setEmail($this);
    }

    /**
     * Get EmailTranslation for a given lang, if not exist it will be created
     *
     * @param string $lang
     * @return BaseEmailTranslation
     */
    public function getTranslation($lang)
    {
        // Check if locale given
        if (strpos($lang, '_')) {
            list($lang, $culture) = explode('_', $lang);
        }

        if (strlen($lang) != 2) {
            throw new \InvalidArgumentException(sprintf('$lang is not valid : "%s" given', $lang));
        }

        foreach ($this->getTranslations() as $translation) {
            if ($translation->getLang() === $lang) {
                return $translation;
            }
        }

        return null;
    }

    /**
     * Set the current translation.
     *
     * @throws \Lexik\Bundle\MailerBundle\Exception\NoTranslationException
     * @internal param string $locale
     */
    protected function setCurrentTranslation()
    {
        if (!($this->currentTranslation instanceof BaseEmailTranslation) || $this->currentTranslation->getLang() != $this->locale) {
            $i = 0;
            $end = count($this->translations);
            $found = false;

            while ($i<$end && !$found) {
                $found = ($this->translations[$i]->getLang() == $this->locale);
                $i++;
            }

            if ($found) {
                $this->currentTranslation = $this->translations[$i-1];
            } else {
                throw new NoTranslationException($this->locale, sprintf('No translation found for email "%s" and locale "%s".', $this->reference, $this->locale));
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        $this->setCurrentTranslation();
    }

    /**
     * {@inheritdoc}
     */
    public function getSubject()
    {
        return $this->currentTranslation->getSubject();
    }

    /**
     * {@inheritdoc}
     */
    public function getBody()
    {
        return $this->currentTranslation->getBody();
    }

    /**
     * {@inheritdoc}
     */
    public function getBodyText()
    {
        return (string) $this->currentTranslation->getBodyText();
    }

    /**
     * {@inheritdoc}
     */
    public function getLayoutBody()
    {
        $body = '';

        if ($this->layout instanceof BaseLayout) {
            $this->layout->setLocale($this->locale);

            $body = $this->layout->getBody();
        }

        return $body;
    }

    /**
     * @param string $default
     * @return string
     * @see \Lexik\Bundle\MailerBundle\Model\EmailInterface::getFromAddress()
     */
    public function getFromAddress($default = '')
    {
        $from = $this->currentTranslation->getFromAddress();

        return !empty($from) ? $from : $default;
    }

    /**
     * @see \Lexik\Bundle\MailerBundle\Model\EmailInterface::getFromName()
     */
    public function getFromName()
    {
        return $this->currentTranslation->getFromName();
    }

    /**
     * @see \Lexik\Bundle\MailerBundle\Model\EmailInterface::getBccs()
     */
    public function getBccs()
    {
        // multiple
        if (strpos($this->bcc, ';')) {
            $bccs = preg_split('/\s*;\s*/', $this->bcc, -1, PREG_SPLIT_NO_EMPTY);
            // single
        } else {
            $bccs = $this->bcc ? array(trim($this->bcc)) : array();
        }

        return $bccs;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastModifiedTimestamp()
    {
        $date = $this->currentTranslation->getUpdatedAt();

        if ( ! $date instanceof \DateTime ) {
            $date = new \DateTime('now');
        }

        return $date->format('U');
    }

    /**
     * {@inheritdoc}
     */
    public function getChecksum()
    {
        return md5(sprintf('%s_%s', $this->locale, $this->getReference()));
    }

    /**
     * Set headers
     *
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }
}
