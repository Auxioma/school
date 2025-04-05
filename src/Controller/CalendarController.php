<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route('/calendar/{year}/{month}', name: 'app_calendar', defaults: ['year' => null, 'month' => null], requirements: ['year' => '\\d+', 'month' => '\\d+'])]
    public function index(?int $year, ?int $month): Response
    {
        $currentDate = new \DateTime();
        $year = $year ?? (int) $currentDate->format('Y');
        $month = $month ?? (int) $currentDate->format('m');
        
        if ($month < 1) {
            $month = 12;
            $year--;
        } elseif ($month > 12) {
            $month = 1;
            $year++;
        }

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $firstDayOfMonth = new \DateTime("$year-$month-01");
        $startWeekday = (int) $firstDayOfMonth->format('N');

        $calendar = [];
        $week = array_fill(0, 7, null);
        
        for ($i = 1, $day = 1 - ($startWeekday - 1); $day <= $daysInMonth; $day++) {
            if ($day > 0) {
                $week[$i % 7] = $day;
            }
            if ($i % 7 == 0 || $day == $daysInMonth) {
                $calendar[] = $week;
                $week = array_fill(0, 7, null);
            }
            $i++;
        }

        return $this->render('calendar/index.html.twig', [
            'year' => $year,
            'month' => $month,
            'calendar' => $calendar,
            'monthNames' => [
                'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
            ],
            'weekDays' => ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim']
        ]);
    }
}
