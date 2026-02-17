<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CalendarController extends Controller
{
    public function index(): View
    {
        return view('calendar.index');
    }

    public function events(Request $request): JsonResponse
    {
        $start = $request->get('start');
        $end = $request->get('end');

        $events = Event::query()
            ->where('start', '<', $end)
            ->where(function ($query) use ($start) {
                $query->where('end', '>', $start)
                    ->orWhereNull('end');
            })
            ->get()
            ->map(fn (Event $event) => [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start->toIso8601String(),
                'end' => $event->end?->toIso8601String(),
                'allDay' => $event->all_day,
                'backgroundColor' => $event->color,
            ]);

        return response()->json($events);
    }
}
