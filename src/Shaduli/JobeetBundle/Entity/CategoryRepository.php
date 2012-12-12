<?php

namespace Shaduli\JobeetBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository {

    public function getWithJobs($max = null) {
        $qb = $this->createQueryBuilder('c')
                   ->select('c,j')
                   ->leftJoin('c.jobs', 'j')
                   ->where('j.expires_at > :expiry_date')
                   ->setParameter('expiry_date', date('Y-m-d H:i:s', time()))
                   ->orderBy('j.expires_at');

        if (false === is_null($max))
            $qb->setMaxResults($max);
        
        return $qb->getQuery()
                  ->getResult();
    }

}
