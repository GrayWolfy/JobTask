<?php

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\CreatesApplication;
use Tests\TestCase;

class MessageControllerFailTest extends TestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function testfailCreation()
    {
        $response= $this->postJson('api/message/create', [
            'name' => 'S',
            'phone' => '898983593508846514984516161',
            'message' => 'o',
        ]);

        $response->assertUnprocessable();
    }

    public function testFailGetRead()
    {
        $this->createAuthenticatedUser();

        $response= $this->getJson('api/message/getRead?read=' . 36);

        $response->assertUnprocessable();
    }

    public function testFailGetByPhoneDigits()
    {
        $this->createAuthenticatedUser();

        $response = $this->getJson('api/message/getByPhoneNumber?phoneDigits=abcd');

        $response->assertUnprocessable();
    }

    public function testFailUpdate()
    {
        $this->createAuthenticatedUser();

        /** @var ContactMessage $message */
        $message = ContactMessage::factory()->create();

        $response = $this->putJson('api/message/update/1', ['name' => 'o']);

        $response->assertUnprocessable();
    }

    public function testFailSetRead()
    {
        $this->createAuthenticatedUser();

        ContactMessage::factory()->create();

        $response = $this->putJson('api/message/setRead/36');

        $response->assertNotFound();
    }

    public function testFailRestore()
    {
        $this->createAuthenticatedUser();

        ContactMessage::factory()->create(['deleted_at' => '2022-11-20 12:48:31']);

        $response = $this->putJson('api/message/restore/36');

        $response->assertNotFound();
    }

    public function testFailDeletedAt()
    {
        $this->createAuthenticatedUser();

        ContactMessage::factory()->create();

        $response = $this->deleteJson('api/message/delete/45');

        $response->assertNotFound();
    }
}
