<?php

namespace App\Tests\Controller;

use App\Entity\Event;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Throwable;

class EventsControllerTest extends WebTestCase
{
    private $client;
    private $em;

    /**
     * This method is called before each test.
     * @throws ToolsException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();

        $this->em = static::$container->get('doctrine')->getManager();

//        $this->em->getConnection()->beginTransaction();
//        $this->em->getConnection()->setAutoCommit(false);

        static $metadata = null;

        if (!$metadata) {
            $metadata = $this->em->getMetadataFactory()->getAllMetadata();
        }

        $schemaTool = new SchemaTool($this->em);
        $schemaTool->dropDatabase();

        if (!empty($metadata)) {
            $schemaTool->createSchema($metadata);
        }
    }

    /** @test */
    public function index_should_list_all_events()
    {
        $event1 = (new Event)->setName('Symfony Conference')->setPrice(0)->setLocation('Paris, FR');
        $event2 = (new Event)->setName('Laravel Conference')->setPrice(25)->setLocation('Quebec, CA');
        $event3 = (new Event)->setName('Django Conference')->setPrice(12)->setLocation('Dakar, SN');

        $this->em->persist($event1);
        $this->em->persist($event2);
        $this->em->persist($event3);
        $this->em->flush();

        $crawler = $this->client->request('GET', '/events');

        $responseContent = $this->client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('3 Events', $responseContent);
        $this->assertStringContainsString($event1->getName(), $responseContent);
        $this->assertStringContainsString($event2->getName(), $responseContent);
        $this->assertStringContainsString($event3->getName(), $responseContent);

    }

    /**
     * This method is called when a test method did not execute successfully.
     *
     * @param Throwable $t
     * @throws Throwable
     */
    protected function onNotSuccessfulTest(Throwable $t): void
    {
        $throwableClass =  get_Class($t);
        dd($this->client->getCrawler()->filter("h1.exception-message")->eq(0)->text());
    }
    
    /**
     * This method is called after each test.
     */
    protected function tearDown(): void
    {
        parent::tearDown();

//        $this->em->rollback();

        $this->em->close();
        $this->em = null; //memory leaks
    }
}
