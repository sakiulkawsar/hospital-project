<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
       public function index()
    {
        $equipments = Equipment::latest()->get();
        return view('admin.equipments.index', compact('equipments'));
    }

    public function create()
    {
        return view('admin.equipments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity_in_stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['item_name','category','quantity_in_stock']);

        if ($request->hasFile('image')) {
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/equipments'), $fileName);
            $data['image'] = $fileName;
        }

        Equipment::create($data);

        return redirect()->route('equipment.index')->with('success','Equipment added successfully');
    }

    public function edit(Equipment $equipment)
    {
        return view('admin.equipments.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity_in_stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['item_name','category','quantity_in_stock']);

        if ($request->hasFile('image')) {
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/equipments'), $fileName);
            $data['image'] = $fileName;
        }

        $equipment->update($data);

        return redirect()->route('equipment.index')->with('success','Equipment updated successfully');
    }

    public function destroy(Equipment $equipment)
    {
        // Delete image if exists
        if ($equipment->image && file_exists(public_path('uploads/equipments/'.$equipment->image))) {
            unlink(public_path('uploads/equipments/'.$equipment->image));
        }

        $equipment->delete();

        return redirect()->route('equipment.index')->with('success','Equipment deleted successfully');
    }
}
