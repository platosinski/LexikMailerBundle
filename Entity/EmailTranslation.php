<?php

namespace Lexik\Bundle\MailerBundle\Entity;

use Lexik\Bundle\MailerBundle\Model\BaseEmailTranslation;

/**
 * @author Laurent Heurtault <l.heurtault@lexik.fr>
 * @author Cédric Girard <c.girard@lexik.fr>
 * @author Yoann Aparici <y.aparici@lexik.fr>
 */
class EmailTranslation extends BaseEmailTranslation
{
    /**
     * prePersist
     * preUpdate
     */
    public function updateTimestamps()
    {
        if (!$this->createdAt) {
            $this->createdAt = new \DateTime();
        }
        $this->updatedAt = new \DateTime();
    }
}
