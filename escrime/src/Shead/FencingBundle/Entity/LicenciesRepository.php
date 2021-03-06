<?php

namespace Shead\FencingBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Shead\FencingBundle\Entity\Clubs;
use Shead\FencingBundle\Entity\Licencies;

/**
 * LicenciesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LicenciesRepository extends EntityRepository
{
	public function Licenced($codeClub,$codet)
	{
		// $req=$this->getEntityManager()
		// 	->createQuery(
		// 		"SELECT l 
		// 		FROM SheadFencingBundle:Clubs c 
		// 		JOIN c.id l 
		// 		WHERE c.code = :codeClub AND l.codet = :codep")
		// 		->setParameter('codeClub',$codeClub)
		// 		->setParameter('codep',$codet);


		$req=$this->getEntityManager()->createQueryBuilder('l')
		->addSelect('SheadFencingBundle:Clubs c')
		->leftJoin('c.code','l')
		->where('l.codet = :codet')
		->andWhere('c.code = :code')
		->setParameters(array('code'=>$codeClub,'codet'=>$codet));

        return $req->getQuery()->getOneOrNullResult();   
        
	}

	public function findOneByIdJoinedToLicencies($id)
	{
    $query = $this->getEntityManager()
        ->createQuery('
            SELECT p, c FROM SheadFencingBundle:Clubs p
            JOIN p.licencies c
            WHERE p.id = :id'
        )->setParameter('id', $id);

    	try {
        return $query->getScalarResult();
    	} 
        catch (\Doctrine\ORM\NoResultException $e) {
        return null;
        }  
	}

	public function findOneByCodeJoinedToLicencies($code)
	{
    $query = $this->getEntityManager()
        ->createQuery('
            SELECT p, c FROM SheadFencingBundle:Clubs p
            JOIN p.licencies c
            WHERE p.code = :code'
        )->setParameter('code', $code);

    	try {
        return $query->getScalarResult();
    	} 
        catch (\Doctrine\ORM\NoResultException $e) {
        return null;
        }  
	}
	
}
