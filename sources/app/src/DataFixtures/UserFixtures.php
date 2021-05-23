<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

final class UserFixtures extends Fixture
{
    public const USER_LOGIN = 'foo2';

    public const USER_PASSWORD = 'bar';
    
    public const USER_EMAIL = 'foo@foo.cz';
    
    public const USER_ROLE = ['admin'];
    
    

    
    
    public function load(ObjectManager $manager): void
    {
        $this->createUser($manager, self::USER_LOGIN, self::USER_PASSWORD, self::USER_EMAIL, self::USER_ROLE);
    }

    /**
     * @param string[] $roles
     */
    private function createUser(ObjectManager $manager, string $login, string $password, string $email, array $roles): void
    {
        $userEntity = new User();
        $userEntity->setLogin($login);
        $userEntity->setPlainPassword($password);
        $userEntity->setEmail($email);
        $userEntity->setRoles($roles);
        
        $manager->persist($userEntity);
        $manager->flush();
    }
}
