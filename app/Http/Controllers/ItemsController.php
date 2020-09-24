<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $selectedItems = Items::where('selected', true)
            ->orderBy('id', 'desc')
            ->get();

        $notSelectedItems = Items::where('selected', false)
            ->get();

        return view('itemManagement', compact('selectedItems', 'notSelectedItems'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:4|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('alert', $validator->errors()->first());
        }
        Items::create(['name' => $request->get('name')]);
        return redirect()->back()->with('success', 'Item added successfully !');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function selectItem(Request $request)
    {
        $Item = Items::where('id', $request->get('itemId'))->firstOrFail();
        $Item->markAsSelected();
        $Item->save();

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unselectItem(Request $request)
    {
        $Item = Items::where('id', $request->get('itemId'))->firstOrFail();
        $Item->markAsUnSelected();
        $Item->save();

        return redirect()->back();

    }


}
