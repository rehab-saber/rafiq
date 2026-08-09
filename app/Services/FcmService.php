<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FcmService
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(
                storage_path(
                    'app/firebase/firebase-service-account.json'
                )
            );

        $this->messaging = $factory->createMessaging();
    }

    public function send(
        string $token,
        string $title,
        string $body,
        array $data = []
    ) {
        return $this->messaging->send([
            'token' => $token,

            'notification' => [
                'title' => $title,
                'body' => $body,
            ],

            'data' => array_map(
                'strval',
                $data
            ),
        ]);
    }
}