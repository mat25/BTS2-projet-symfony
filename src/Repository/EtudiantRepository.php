<?php

namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Etudiant>
 *
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    // Methode permettant de rechercher tout les étudiants mineurs
    public function findMineurs() :array {
        // Utiliser le langage DQL (Doctrine Query Langauge)
        // Exprimer des requetes se basant sur le modele objet (Entity)
        // La requete DQL sera transformer en une requete SQL par Doctrine
        // Lors de l'execution de la methode
        $dateMajorite = new \DateTime("-18 years");
        // 1. Exprimer la requete DQL
        $requeteDQL = "SELECT etudiant FROM App\Entity\Etudiant as etudiant 
        WHERE etudiant.dateNaissance > :dateMajorite";
        // 2. Construire la requete (representation object de la requete)
        $requete = $this->getEntityManager()->createQuery($requeteDQL);
        // 3. Donner une valeur au parametre de la requete
        $requete->setParameter('dateMajorite',$dateMajorite);
        // 4. Executer la requete et retourner le resultat
        // 4. Executer la requete et retourner le resultat
        return $requete->getResult();
    }

    public function findMineurs2() : array {
        // Utiliser le Query Builder : classe permettant de construire
        // Dynamiquement des requêtes DQL
        $dateMajorite = new \DateTime("-18 years");
        return $this->createQueryBuilder('e')
            ->where("e.dateNaissance > :dateMajorite")
            ->setParameter('dateMajorite',$dateMajorite)
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Etudiant[] Returns an array of Etudiant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Etudiant
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
