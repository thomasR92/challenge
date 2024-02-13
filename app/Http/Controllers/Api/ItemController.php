<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
       return response()->json([
        'status' => true,
        'items' => $items
      
]);  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreItemRequest $request)
    {
        $item = Item::create($request->all());
   
       return response()->json([
           'status' => true,
           'message' => "item Created successfully!",
           'item' => $item
       ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $id = $request->input('id');
        $id = ($id == -1) ? 0 : $id;
       $item = Item::create($request->all());
   
       return response()->json([
           'status' => true,
           'message' => "item Created successfully!",
           'item' => $item
       ], 200);
    }
    /**
     * Display the specified resource.
     */
        public function show($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        return response()->json(['item' => $item], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
    
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
    
        $requestData = $request->all();
    
        if (isset($requestData['buy_price'])) {
            $buy_priceChange = $requestData['buy_price'];
    
            if ($item->buy_price + $buy_priceChange < 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid buy_price. The resulting quantity would be negative.',
                ], 400);
            }
    
            $item->update(['buy_price' => $item->buy_price + $buy_priceChange]);
            unset($requestData['buy_price']); 
        }
    
        $item->update($requestData);
    
        return response()->json([
            'message' => 'Item updated successfully',
            'item' => $item,
        ], 200);
    }
    
    

        public function destroy($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Item deleted successfully'], 200);
    }
}

 