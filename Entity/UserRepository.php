<?php

namespace CanalTP\SamEcoreUserManagerBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    private $filter = array('locked' => false);

    public function findAll() {
        return parent::findBy($this->filter);
    }

    public function findBy(
        array $criterias = [],
        array $orderBy = null,
        $limit = null,
        $offset = null)
    {
        $criterias = array_merge($criterias, $this->filter);
        return parent::findBy($criterias, $orderBy, $limit, $offset);
    }
}
