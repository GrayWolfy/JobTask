<?php

namespace Tests\Unit;

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\CreatesApplication;
use Tests\TestCase;

class MessageControllerOkTest extends TestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function testCreation()
    {
        $response= $this->postJson('api/message/create', [
            'name' => 'Semen',
            'phone' => '89898359350',
            'message' => 'OMG',
        ]);

        $response->assertOk();
    }

    public function testIndex()
    {
        $this->createAuthenticatedUser();

        /** @var ContactMessage $message */
        $message = ContactMessage::factory()->create();

        $response= $this->getJson('api/message/index');

        $response->assertOk();

        $response->assertJsonPath('data.0.phone', $message->phone);
        $response->assertJsonPath('data.0.name', $message->name);
        $response->assertJsonPath('data.0.message', $message->message);
    }

    public function testGetRead()
    {
        $this->createAuthenticatedUser();

        /** @var ContactMessage $messageRead */
        $messageRead = ContactMessage::factory()->create(['read' => 1]);

        /** @var ContactMessage $messageNotRead */
        $messageNotRead = ContactMessage::factory()->create();

        $response= $this->getJson('api/message/getRead?read=' . 0);

        $response->assertJsonPath('data.0.phone', $messageNotRead->phone);
        $response->assertJsonPath('data.0.name', $messageNotRead->name);
        $response->assertJsonPath('data.0.message', $messageNotRead->message);

        $response->assertOk();

        $response= $this->getJson('api/message/getRead?read=' . 1);

        $response->assertJsonPath('data.0.phone', $messageRead->phone);
        $response->assertJsonPath('data.0.name', $messageRead->name);
        $response->assertJsonPath('data.0.message', $messageRead->message);
        $response->assertOk();
    }

    public function testGetDeleted()
    {
        $this->createAuthenticatedUser();

        /** @var ContactMessage $messageDeleted */
        $messageDeleted = ContactMessage::factory()->create(['deleted_at' => '2022-11-20 12:48:31']);

        $response= $this->getJson('api/message/getDeleted');

        $response->assertJsonPath('data.0.phone', $messageDeleted->phone);
        $response->assertJsonPath('data.0.name', $messageDeleted->name);
        $response->assertJsonPath('data.0.message', $messageDeleted->message);
        $response->assertJsonPath('data.0.deleted_at', $messageDeleted->deleted_at);

        $response->assertOk();
    }

    public function testGetByPhoneDigits()
    {
        $this->createAuthenticatedUser();

        /** @var ContactMessage $message */
        $message = ContactMessage::factory()->create();

        $response = $this->getJson('api/message/getByPhoneNumber?phoneDigits=989');

        $response->assertJsonPath('data.0.phone', $message->phone);
        $response->assertJsonPath('data.0.name', $message->name);
        $response->assertJsonPath('data.0.message', $message->message);

        $response->assertOk();
    }

    public function testUpdate()
    {
        $this->createAuthenticatedUser();

        /** @var ContactMessage $message */
        $message = ContactMessage::factory()->create();

        $response = $this->putJson('api/message/update/1', ['name' => 'Illidan']);

        $response->assertJsonPath('phone', $message->phone);
        $response->assertJsonPath('name', 'Illidan');
        $response->assertJsonPath('message', $message->message);

        $response->assertOk();
    }

    public function testSetRead()
    {
        $this->createAuthenticatedUser();

        /** @var ContactMessage $message */
        $message = ContactMessage::factory()->create();

        $response = $this->putJson('api/message/setRead/1');

        $response->assertJsonPath('phone', $message->phone);
        $response->assertJsonPath('name', $message->name);
        $response->assertJsonPath('message', $message->message);
        $response->assertJsonPath('read', true);

        $response->assertOk();
    }

    public function testRestore()
    {
        $this->createAuthenticatedUser();

        /** @var ContactMessage $message */
        $message = ContactMessage::factory()->create(['deleted_at' => '2022-11-20 12:48:31']);

        $response = $this->putJson('api/message/restore/1');

        $response->assertJsonPath('phone', $message->phone);
        $response->assertJsonPath('name', $message->name);
        $response->assertJsonPath('message', $message->message);
        $response->assertJsonPath('deleted_at', null);

        $response->assertOk();
    }

    public function testDeletedAt()
    {
        $this->createAuthenticatedUser();

        /** @var ContactMessage $message */
        $message = ContactMessage::factory()->create();

        $response = $this->deleteJson('api/message/delete/1');

        $response->assertJsonPath('phone', $message->phone);
        $response->assertJsonPath('name', $message->name);
        $response->assertJsonPath('message', $message->message);


        $this->assertNotNull(json_decode($response->getContent(), true)['deleted_at']);

        $response->assertOk();
    }
}
