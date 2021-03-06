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

    public function allRequestsByHall($id)
    {
        return $this
            ->createQueryBuilder('h')
            ->select('h')
            ->where('h.hallId= :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getScalarResult();
    }

    public function requestByDateAndTime($id, $date, $timeStart)
    {
        return $this
            ->createQueryBuilder('d')
            ->select('d')
            ->where('d.hallId= :id')
            ->andWhere('d.date= :date')
            ->andWhere('d.timeStart= :timeStart')
            ->setParameters(array('id'=>$id, 'date'=>$date,'timeStart'=>$timeStart))
            ->getQuery()
            ->getResult();
    }
}
