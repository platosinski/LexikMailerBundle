<?php

namespace Lexik\Bundle\MailerBundle\Repository;

use Lexik\Bundle\MailerBundle\Model\BaseEmail;

/**
 * Interface EmailRepositoryInterface
 * @package Lexik\Bundle\MailerBundle\Repository
 */
interface EmailRepositoryInterface
{
    /**
     * Finds an object by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     *
     * @return BaseEmail The object.
     */
    public function find($id);

    /**
     * Finds all objects in the repository.
     *
     * @return BaseEmail[] The objects.
     */
    public function findAll();

    /**
     * Finds objects by a set of criteria.
     *
     * Optionally sorting and limiting details can be passed. An implementation may throw
     * an UnexpectedValueException if certain values of the sorting or limiting details are
     * not supported.
     *
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return BaseEmail[] The objects.
     *
     * @throws \UnexpectedValueException
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * Finds a single object by a set of criteria.
     *
     * @param array $criteria The criteria.
     *
     * @return BaseEmail The object.
     */
    public function findOneBy(array $criteria);
}
