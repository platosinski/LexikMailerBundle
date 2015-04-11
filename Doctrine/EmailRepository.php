<?php

namespace Lexik\Bundle\MailerBundle\Doctrine;

use Doctrine\ORM\EntityRepository;
use Lexik\Bundle\MailerBundle\Repository\EmailRepositoryInterface;

/**
 * Class EmailRepository
 * @package Lexik\Bundle\MailerBundle\Doctrine
 */
class EmailRepository extends EntityRepository implements EmailRepositoryInterface
{
}
