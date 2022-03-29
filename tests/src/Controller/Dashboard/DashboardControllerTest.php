<?php

namespace App\Tests\src\Controller\Dashboard;

use http\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use Symfony\Component\DomCrawler\Crawler;

class DashboardControllerTest extends WebTestCase
{
    private const MESSAGE_BY_USER = [
        'admin' => 'Bienvenido al panel administrador',
        'comercial' => 'Bienvenido al panel comercial',
        'empleado' => 'Bienvenido al panel empleado',
        'jefeproyecto' => 'Bienvenido al panel jefe de proyecto'
    ];

    public function testAdminDashboardRights(): void
    {
        $client = static::createClient();

        $crawler = $this->getCrawlerDashboardByUser($client, 'admin@curso.local', 'admin');
        $this->assertResponseIsSuccessful();
        $this->assertEquals($crawler->filter('body main h1')->innerText(), self::MESSAGE_BY_USER['admin']);

        $crawler = $this->getCrawlerDashboardByUser($client, 'admin@curso.local', 'comercial');
        $this->assertResponseIsSuccessful();
        $this->assertEquals($crawler->filter('body main h1')->innerText(), self::MESSAGE_BY_USER['comercial']);

        $crawler = $this->getCrawlerDashboardByUser($client, 'admin@curso.local', 'empleado');
        $this->assertResponseIsSuccessful();
        $this->assertEquals($crawler->filter('body main h1')->innerText(), self::MESSAGE_BY_USER['empleado']);

        $crawler = $this->getCrawlerDashboardByUser($client, 'admin@curso.local', 'jefeproyecto');
        $this->assertResponseIsSuccessful();
        $this->assertEquals($crawler->filter('body main h1')->innerText(), self::MESSAGE_BY_USER['jefeproyecto']);
    }

    public function testComercialDashboardRights(): void
    {
        $client = static::createClient();
        $this->testNonAdminUsers($client,  'comercial@curso.local', 'comercial');
    }

    public function testJefeProyectoDashboardRights(): void
    {
        $client = static::createClient();
        $this->testNonAdminUsers($client,  'jefeproyecto@curso.local', 'jefeproyecto');
    }

    private function getCrawlerDashboardByUser($client, string $mailUser, string $path): Crawler
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        $client->loginUser($userRepository->findOneByEmail($mailUser));
        return $client->request('GET', '/dashboard/'.$path);
    }

    private function testNonAdminUsers($client, string $mailUser, string $roleUser): void
    {
        $otherRoles = array_diff( ['admin', 'comercial', 'empleado', 'jefeproyecto'], [$roleUser] );

        $crawler = $this->getCrawlerDashboardByUser($client, $mailUser, $roleUser);
        $this->assertResponseIsSuccessful();
        $this->assertEquals($crawler->filter('body main h1')->innerText(), self::MESSAGE_BY_USER[$roleUser]);

        foreach($otherRoles as $otherRole){
            $this->getCrawlerDashboardByUser($client, $mailUser, $otherRole);
            $this->assertResponseStatusCodeSame(403);
        }

    }
}
