<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Service;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['user', 'services'])
            ->orderBy('event_date', 'desc')
            ->paginate(10);
        
        return view('events.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::with(['user', 'services', 'gallery'])
            ->findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function create()
    {
        $services = Service::all();
        return view('events.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|max:255',
            'event_date' => 'required|date',
            'attendee_count' => 'required|integer|min:1',
            'services' => 'required|array',
            'services.*' => 'exists:services,service_id'
        ]);

        $event = Event::create([
            'event_name' => $validated['event_name'],
            'event_date' => $validated['event_date'],
            'attendee_count' => $validated['attendee_count'],
            'user_id' => auth()->id(),
            'status' => 'pending'
        ]);

        // Attach services
        foreach($validated['services'] as $serviceId) {
            $service = Service::find($serviceId);
            $event->services()->attach($serviceId, [
                'quantity' => 1,
                'total_price' => $service->price
            ]);
        }

        return redirect()->route('events.show', $event->event_id)
            ->with('success', 'Sự kiện đã được tạo thành công.');
    }

    public function edit($id)
    {
        $event = Event::with('services')->findOrFail($id);
        $services = Service::all();
        return view('events.edit', compact('event', 'services'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'event_name' => 'required|max:255',
            'event_date' => 'required|date',
            'attendee_count' => 'required|integer|min:1',
            'status' => 'required|in:pending,confirmed,completed,canceled',
            'services' => 'required|array',
            'services.*' => 'exists:services,service_id'
        ]);

        $event = Event::findOrFail($id);
        $event->update($validated);

        // Sync services
        $event->services()->sync($validated['services']);

        return redirect()->route('events.show', $event->event_id)
            ->with('success', 'Sự kiện đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Sự kiện đã được xóa thành công.');
    }
} 