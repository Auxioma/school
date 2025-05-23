<?php

namespace App\Service;

use Google\Client;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class GoogleClientFactory
{
    public function __construct(
        #[Autowire('%env(GOOGLE_CLIENT_ID)%')]
        private string $clientId,

        #[Autowire('%env(GOOGLE_CLIENT_SECRET)%')]
        private string $clientSecret,

        #[Autowire('%env(resolve:GOOGLE_REDIRECT_URI)%')]
        private string $redirectUri,

        #[Autowire('%kernel.project_dir%/config/google/cal.json')]
        private string $authConfig,
    ) {}

        public function createClient(): Client
    {
        $client = new Client();
        $client->setClientId($this->clientId);
        $client->setClientSecret($this->clientSecret);
        $client->setRedirectUri($this->redirectUri);
        $client->setAuthConfig($this->authConfig);
        $client->addScope('https://www.googleapis.com/auth/calendar.readonly');
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        return $client;
    }
}

