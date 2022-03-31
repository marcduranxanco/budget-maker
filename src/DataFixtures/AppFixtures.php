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
        $admin->setPhone('111111111');
        $admin->setLocale('ES');
        $hash = $this->passwordHasher->hashPassword($admin, 'admin');
        $admin->setPassword($hash);

        $comercial = new User();
        $comercial->setEmail('comercial@curso.local');
        $comercial->setRoles(['ROLE_COMERCIAL']);
        $comercial->setPhone('222222222');
        $hash = $this->passwordHasher->hashPassword($comercial, 'comercial');
        $comercial->setPassword($hash);

        $jefeproyecto = new User();
        $jefeproyecto->setEmail('jefeproyecto@curso.local');
        $jefeproyecto->setRoles(['ROLE_JEFEPROYECTO']);
        $jefeproyecto->setPhone('333333333');
        $hash = $this->passwordHasher->hashPassword($jefeproyecto, 'jefeproyecto');
        $jefeproyecto->setPassword($hash);

        $empleado = new User();
        $empleado->setEmail('empleado@curso.local');
        $empleado->setRoles(['ROLE_EMPLEADO']);
        $empleado->setLocale('EN');
        $empleado->setPhone('444444444');
        $hash = $this->passwordHasher->hashPassword($empleado, 'empleado');
        $empleado->setPassword($hash);

        return [$admin, $comercial, $jefeproyecto, $empleado];
    }
}
