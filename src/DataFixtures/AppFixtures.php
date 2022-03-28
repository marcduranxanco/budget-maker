<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct (UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach($this->crearUsuarios() as $usuario)
        {
            $manager->persist($usuario);
        };
        $manager->flush();
    }

    /**
     * @return array<User>
     */
    private function crearUsuarios(): array
    {
        $admin = new User();
        $admin->setEmail('admin@curso.local');
        $admin->setRoles(['ROLE_ADMIN']);
        $hash = $this->passwordHasher->hashPassword($admin, 'admin');
        $admin->setPassword($hash);

        $comercial = new User();
        $comercial->setEmail('comercial@curso.local');
        $comercial->setRoles(['ROLE_COMERCIAL']);
        $hash = $this->passwordHasher->hashPassword($comercial, 'comercial');
        $comercial->setPassword($hash);

        $jefeproyecto = new User();
        $jefeproyecto->setEmail('jefeproyecto@curso.local');
        $jefeproyecto->setRoles(['ROLE_JEFEPROYECTO']);
        $hash = $this->passwordHasher->hashPassword($jefeproyecto, 'jefeproyecto');
        $jefeproyecto->setPassword($hash);

        $empleado = new User();
        $empleado->setEmail('empleado@curso.local');
        $empleado->setRoles(['ROLE_EMPLEADO']);
        $hash = $this->passwordHasher->hashPassword($empleado, 'empleado');
        $empleado->setPassword($hash);

        return [$admin, $comercial, $jefeproyecto, $empleado];
    }
}
