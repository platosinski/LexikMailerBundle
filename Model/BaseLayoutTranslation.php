<?php

namespace Lexik\Bundle\MailerBundle\Model;

use Symfony\Component\Locale\Locale;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Laurent Heurtault <l.heurtault@lexik.fr>
 * @author Cédric Girard <c.girard@lexik.fr>
 */
class BaseLayoutTranslation
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
     */
    protected $body;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var BaseLayout
     *
     * @Assert\NotBlank()
     */
    protected $layout;

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
     * Get layout
     *
     * @return BaseLayout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set layout
     *
     * @param BaseLayout $layout
     */
    public function setLayout(BaseLayout $layout)
    {
        $this->layout = $layout;
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
