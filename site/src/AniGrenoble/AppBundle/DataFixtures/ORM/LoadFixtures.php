<?php

namespace AniGrenoble\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AniGrenoble\UtilisateurBundle\Entity\Utilisateur;
use AniGrenoble\AppBundle\Entity\Categorie;

class LoadUtilisateur implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    $this->loadUsers($manager);
    $this->loadCategories($manager);
  }

  private function loadUsers(ObjectManager $manager)
  {
    // On crée les utilisateurs
    $util1 = new Utilisateur();
    $util1->setUsername("admin");
    $util1->setPassword("admin");
    // On ne se sert pas du sel pour l'instant
    $util1->setEmail("admin"."@admin.fr");
    // On définit uniquement le role ROLE_USER qui est le role de base
    $util1->setRoles(array('ROLE_ADMIN'));
    // On la persiste
    $manager->persist($util1);

    // On crée les utilisateurs
    $util2 = new Utilisateur();
    $util2->setUsername("superadmin");
    $util2->setPassword("superadmin");
    $util2->setEmail("superadmin"."@superadmin.fr");
    $util2->setRoles(array('ROLE_SUPER_ADMIN'));
    $manager->persist($util2);

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }

  private function loadCategories(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $names = array(
      'Evenement',
      'Reunion hebdomadaire'
    );

    foreach ($names as $name) {
      // On crée la catégorie
      $categorie = new Categorie();
      $categorie->setNom($name);

      // On la persiste
      $manager->persist($categorie);
    }

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}