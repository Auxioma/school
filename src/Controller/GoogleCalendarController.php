<?php
// src/Controller/GoogleCalendarController.php
namespace App\Controller;

use App\Service\GoogleCalendarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GoogleCalendarController extends AbstractController
{
#[Route('/google/calendar/{year<\d{4}>?}', name: 'google_calendar')]
    public function index(
        GoogleCalendarService $calendarService,
        SessionInterface      $session,
        ?int                  $year = null,
    ): Response {
        /* 1. Année ciblée */
        $year ??= (int) (new \DateTimeImmutable())->format('Y');

        /* 2. Auth Google */
        if (!$session->has('access_token')) {
            return $this->redirectToRoute('google_auth');
        }
        $calendarService->setAccessToken($session->get('access_token'));
        if ($calendarService->isAccessTokenExpired()) {
            return $this->redirectToRoute('google_auth');
        }

        /* 3. Évènements de l’année */
        $eventsRaw = $calendarService->getEventsBetween(
            new \DateTimeImmutable("$year-01-01T00:00:00"),
            new \DateTimeImmutable("$year-12-31T23:59:59")
        ); 

        /* 4. Conversion FullCalendar : */
        $displayEvents = [];
        $busyIndex     = []; // pour éviter les doublons de journées

        foreach ($eventsRaw as $event) {
            /** @var \Google\Service\Calendar\Event $event */
            $summary = $event->getSummary() ?: '(Sans titre)';

            $startStr = $event->getStart()->getDateTime() ?? $event->getStart()->getDate();
            $endStr   = $event->getEnd()->getDateTime()   ?? $event->getEnd()->getDate();

            $start = new \DateTimeImmutable($startStr);
            $end   = new \DateTimeImmutable($endStr);

            $isAllDay = $event->getStart()->getDate() !== null;

            // Évènement "normal" (titre + horaire)
            $displayEvents[] = [
                'title'  => $summary,
                'start'  => $start->format(\DateTime::RFC3339_EXTENDED),
                'end'    => $end->format(\DateTime::RFC3339_EXTENDED),
                'allDay' => $isAllDay,
            ];

            // Marque la journée comme occupée
            $busyIndex[$start->format('Y-m-d')] = true;
        }

        /* 5. Évènements "de fond" (cases bleues) pour chaque date occupée */
        $backgroundEvents = [];
        foreach (array_keys($busyIndex) as $dateKey) {
            $backgroundEvents[] = [
                'start'   => $dateKey,
                'allDay'  => true,
                'display' => 'background',
                'color'   => '#0d6efd',   // bleu Bootstrap
            ];
        }

        /* 6. Fusion + JSON */
        $eventsForFullcalendar = array_merge($displayEvents, $backgroundEvents);

        return $this->render('calendar/index.html.twig', [
            'year'       => $year,
            'eventsJson' => json_encode($eventsForFullcalendar, JSON_UNESCAPED_UNICODE),
        ]);
    }

    #[Route('/google/auth', name: 'google_auth')]
    public function auth(GoogleCalendarService $calendarService): Response
    {
        // Redirige simplement vers l’URL OAuth générée
        return $this->redirect($calendarService->getAuthUrl());
    }

    #[Route('/google/callback', name: 'google_callback')]
    public function callback(
        Request $request,
        GoogleCalendarService $calendarService,
        SessionInterface $session
    ): Response {
        $code = $request->query->get('code');
        if (!$code) {
            return $this->json(['error' => 'Missing authorization code'], Response::HTTP_BAD_REQUEST);
        }

        // Échange code ↔ token + sauvegarde en session
        $accessToken = $calendarService->fetchAccessToken($code);
        $session->set('access_token', $accessToken);

        return $this->redirectToRoute('google_calendar');
    }
}

