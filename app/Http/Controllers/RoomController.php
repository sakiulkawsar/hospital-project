<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $rooms = room::latest()->get();
        return view('admin.room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.room.create');
     {
        $request->validate([
            'room_number'  => 'required|string|max:255',
            'room_type' => 'required|string|max:20',
            'department'        => 'required|string|max:255',
            'available'      => 'required|string|max:255',
           
        ]);

        Room::create($request->all());

        return redirect()
            ->route('room.index')
            ->with('success', 'room added successfully');
    }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
        'room_number'  => 'required|string|max:255',
        'room_type'    => 'required|string|max:20',
        'department'   => 'required|string|max:255',
        'available'    => 'required|boolean',
    ]);

    Room::create($request->all());

    return redirect()
        ->route('room.index')
        ->with('success', 'Room added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('admin.room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
        'room_number' => 'required',
        'room_type' => 'required',
        'department' => 'required',
        'available' => 'required|boolean',
    ]);

    $room->update($request->all());

    return redirect()->route('room.index')
        ->with('success', 'Room updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
         $room->delete();

        return redirect()
            ->route('room.index')
            ->with('success', 'Room deleted successfully');
    }
}
