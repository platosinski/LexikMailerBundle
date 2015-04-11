<?php

namespace Lexik\Bundle\MailerBundle\Entity;

use Lexik\Bundle\MailerBundle\Model\BaseLayoutTranslation;

/**
 * @author Laurent Heurtault <l.heurtault@lexik.fr>
 * @author Cédric Girard <c.girard@lexik.fr>
 */
class LayoutTranslation extends BaseLayoutTranslation
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
