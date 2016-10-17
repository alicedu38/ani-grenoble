<?php

namespace Site\UtilisateurBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AniGrenoble\UtilisateurBundle\Entity\Utilisateur;

class LoadUtilisateur implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms d'utilisateurs' à ajouter
    $names = array(
      'admin',
      'test'
    );

    foreach ($names as $name) {
      // On crée les utilisateurs
      $util = new Utilisateur();
      $util->setUsername($name);
      $util->setPassword($name);

      // On ne se sert pas du sel pour l'instant
      $util->setEmail($name."@test.fr");
      // On définit uniquement le role ROLE_USER qui est le role de base
      $util->setRoles(array('ROLE_ADMIN'));

      // On la persiste
      $manager->persist($util);
    }

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}