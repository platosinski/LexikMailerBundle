<?php

namespace Lexik\Bundle\MailerBundle\Entity;

use Lexik\Bundle\MailerBundle\Model\BaseEmail;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * @author Laurent Heurtault <l.heurtault@lexik.fr>
 * @author Cédric Girard <c.girard@lexik.fr>
 * @author Yoann Aparici <y.aparici@lexik.fr>
 *
 * @DoctrineAssert\UniqueEntity("reference")
 */
class Email extends BaseEmail
{
}
