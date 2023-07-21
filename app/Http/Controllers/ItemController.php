<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Item::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create New Item
        $newItem = new Item;

        // Set the name of the newly created item
        $newItem->name = $request->item['name'];

        // Save the item
        $newItem->save();

        return $newItem;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the existing item
        $existingItem = Item::find($id);

        if($existingItem)
        {
            // Update completed if there's an item
            $existingItem->completed = $request->item['completed'] ? true : false;

            // Updated completed_at column if there's is an item
            $existingItem->completed_at = $request->item['completed'] ? Carbon::now() : null;

            // Save existing item
            $existingItem->save();

            return $existingItem;
        }

        return "Item not found";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the existing item
        $existingItem = Item::find($id);

        // Delete item if exists
        if($existingItem)
        {
            $existingItem->delete();
            return "Item successfully deleted";
        }

        return 'Item not available';
    }
}
