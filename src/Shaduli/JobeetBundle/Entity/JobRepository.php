<?php

namespace Shaduli\JobeetBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * JobRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class JobRepository extends EntityRepository {

   

    public function getActiveJobs($category, $limit = null) {
        $qb = $this->createQueryBuilder('j')
                ->select('j')
                ->where('j.expires_at > :expiry_date')
                ->setParameter('expiry_date', date('Y-m-d H:i:s', time()))
                ->andWhere('j.category = :category_id')
                ->setParameter('category_id', $category->getId())
                ->orderBy('j.expires_at');

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
                        ->getResult();
    }

    

}
