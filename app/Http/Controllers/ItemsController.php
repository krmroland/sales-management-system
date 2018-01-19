<?php

namespace App\Http\Controllers;

use App\Item;
use App\Filters\ItemFilters;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ItemFilters $filters)
    {
        if ($request->wantsJson()) {
            return Item::filter($filters)->oldest('names')->limit(15)->oldest('name')->get();
        }

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request, Item $items)
    {
        $items = $items->persist(array_filter($request->all()));

        return response()->json($items);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $item->load(['transactionDetails.transaction']);

        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Item                $item
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, Item $item)
    {
        if ($request->has('isEditingPrices')) {
            $item->adjustVariables(
                $request->only(['quantity', 'buyingPrice', 'sellingPrice'])
            );
        } else {
            $item->update($request->all());
        }

        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        //return $item->adjust()->delete();
    }

    public function search(Request $request)
    {
        if ($request->has('name')) {
            return Item::search($request->name)->limit(5)->get();
        }

        return [];
    }
}
