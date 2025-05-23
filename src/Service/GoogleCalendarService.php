<?php
// src/Service/GoogleCalendarService.php
namespace App\Service;

use Google\Service\Calendar;
use Google\Service\Calendar\Event;

class GoogleCalendarService
{
    private \Google\Client $client;
    private Calendar $googleCalendar;
    public const CALENDAR_ID = 'auxioma.g@gmail.com';

    public function __construct(GoogleClientFactory $clientFactory)      // ✅ un seul argument
    {
        $this->client         = $clientFactory->createClient();          // client OAuth
        $this->googleCalendar = new Calendar($this->client);             // SDK Calendar
    }

    /** URL de consentement Google */
    public function getAuthUrl(): string
    {
        return $this->client->createAuthUrl();
    }

    /** Échange code ↔ token */
    public function fetchAccessToken(string $code): array
    {
        return $this->client->fetchAccessTokenWithAuthCode($code);
    }

    /** Injecte (ou remplace) un token en mémoire */
    public function setAccessToken(array $token): void
    {
        $this->client->setAccessToken($token);
    }

    public function isAccessTokenExpired(): bool
    {
        return $this->client->isAccessTokenExpired();
    }

    /** 5 prochains événements du calendrier principal */
    public function getUpcomingEvents(): array
    {
        $events = $this->googleCalendar->events->listEvents(
            self::CALENDAR_ID,
            [
                'maxResults'   => 5,
                'orderBy'      => 'startTime',
                'singleEvents' => true,
                'timeMin'      => (new \DateTimeImmutable())->format(\DateTime::RFC3339),
            ]
        );

        return $events->getItems();
    }

    /**
     * Retourne tous les évènements entre deux dates (inclus).
     *
     * @return Event[]
     */
    public function getEventsBetween(
        \DateTimeInterface $start,
        \DateTimeInterface $end
    ): array {
        $params = [
            'timeMin'      => $start->format(\DateTime::RFC3339_EXTENDED),
            'timeMax'      => $end->format(\DateTime::RFC3339_EXTENDED),
            'singleEvents' => true,
            'orderBy'      => 'startTime',
            'maxResults'   => 2500, // quota Google
        ];

        $list = $this->googleCalendar
            ->events
            ->listEvents(self::CALENDAR_ID, $params);

        return $list->getItems(); // tableau d'Event
    }
}
