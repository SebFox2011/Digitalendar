<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setUsername("admin");
        $admin->setPassword($this->passwordEncoder->encodePassword($admin,"1234"));
        $admin->setEmail("admin@gmail.com");
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $user1 = new User();
        $user1->setUsername("user1");
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,"1234"));
        $user1->setEmail("user1@gmail.com");
        $user1->setRoles(['ROLE_USER']);
        $this->setReference('user1',$user1);

        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername("user2");
        $user2->setPassword($this->passwordEncoder->encodePassword($user2,"1234"));
        $user2->setEmail("user2@gmail.com");
        $user2->setRoles(['ROLE_USER']);
        $this->setReference('user2',$user2);

        $manager->persist($user2);

        $manager->flush();
    }
}
