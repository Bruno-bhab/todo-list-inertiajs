<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::select('id', 'title', 'link_name')
            ->orderBy('created_at','desc')
            ->where('user_id', auth()->user()->id)
            ->get();
        return Inertia::render('link/list', [
            'links'=> $links,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        if ($link->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para editar este link.');
        }

        return Inertia::render('link/edit', [
            'link' => $link,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return back()->with('success','Deleted');
    }

    public function loadLinkPage(string $link_name)
    {
        if (!is_string($link_name) || empty($link_name)) {
            abort(400, "Invalid link name");
        }

        $link = Link::with("linkItems")->where("link_name",$link_name)->first();
        return Inertia::render('link/loadLink', [
            'link' => $link,
        ]);
    }
}
