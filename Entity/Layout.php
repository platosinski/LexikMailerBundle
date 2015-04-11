<?php

namespace Lexik\Bundle\MailerBundle\Entity;

use Lexik\Bundle\MailerBundle\Model\BaseLayout;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * @author Laurent Heurtault <l.heurtault@lexik.fr>
 * @author Cédric Girard <c.girard@lexik.fr>
 *
 * @DoctrineAssert\UniqueEntity("reference")
 */
class Layout extends BaseLayout
{
}
