<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route('/calendar/{year}', name: 'app_calendar', defaults: ['year' => null], requirements: ['year' => '\\d+'])]
    public function index(?int $year): Response
    {
        $now = new \DateTime();
        $currentYear = (int) $now->format('Y');
        $currentMonth = (int) $now->format('n');

        // Si aucun paramètre n'est passé, on prend l'année en cours
        $year = $year ?? $currentYear;

        $monthNames = [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ];

        $weekDays = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];

        $yearCalendar = [];

        // Afficher les 12 mois à partir du mois courant
        for ($i = 0; $i < 12; $i++) {
            $month = (($currentMonth - 1 + $i) % 12) + 1;
            $monthYear = $year;

            // Si on dépasse décembre, on passe à l'année suivante
            if ($currentMonth + $i > 12) {
                $monthYear++;
            }

            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $monthYear);
            $firstDayOfMonth = new \DateTime("$monthYear-$month-01");
            $startWeekday = (int) $firstDayOfMonth->format('N'); // 1 (Lun) à 7 (Dim)

            $calendar = [];
            $week = array_fill(0, 7, null);
            $dayCounter = 1;

            // Remplissage du premier week
            for ($k = $startWeekday - 1; $k < 7 && $dayCounter <= $daysInMonth; $k++) {
                $week[$k] = $dayCounter++;
            }
            $calendar[] = $week;

            // Semaine suivantes
            while ($dayCounter <= $daysInMonth) {
                $week = array_fill(0, 7, null);
                for ($k = 0; $k < 7 && $dayCounter <= $daysInMonth; $k++) {
                    $week[$k] = $dayCounter++;
                }
                $calendar[] = $week;
            }

            $yearCalendar[] = [
                'month' => $month,
                'year' => $monthYear,
                'name' => $monthNames[$month - 1],
                'days' => $calendar
            ];
        }

        return $this->render('calendar/index.html.twig', [
            'year' => $year,
            'calendar' => $yearCalendar,
            'weekDays' => $weekDays,
            'currentMonth' => $currentMonth
        ]);
    }
}
