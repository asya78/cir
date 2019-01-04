<?php

namespace CirTuSofiaBundle\Repository;


/**
 * RequestHallRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RequestHallRepository extends \Doctrine\ORM\EntityRepository
{

    public function countRequestsById($id)
    {
        return $this
            ->createQueryBuilder('s')
            ->select('count(s.requesterId)')
            ->where('s.requesterId= :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
