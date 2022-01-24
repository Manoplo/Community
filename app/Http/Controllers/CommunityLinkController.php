<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\CommunityLink;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CommunityLinkForm;
use Illuminate\Support\Facades\Auth;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $links = CommunityLink::where('approved', 1)->latest('updated_at')->paginate(25);
        $channels = Channel::orderBy('title', 'asc')->get();

        return view('community.index', compact('links', 'channels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommunityLinkForm $request)
    {

        /**
         * 
         */
        /**
         * Checkea si el usuario es trusted o no, llamando un método estático creado en el modelo user. 
         */

        $approved = Auth::user()->isTrusted();

        /**
         * Checkeamos si el link ya existe. 
         */



        $alreadySubmitted = CommunityLink::hasAlreadyBeenSubmitted($request->link);

        if ($approved && $alreadySubmitted) {

            return back()->with('warning', 'The link already exists. It´ll be uplisted, but contributor won´t change');
        } else {

            /**
             * Merge añade al request parámetros que no trae, como la id del usuario. 
             */


            $request->merge(['user_id' => Auth::id(), 'approved' => $approved]);
            dd($request);

            CommunityLink::create($request->all());
        }


        if ($approved) return back()->with('success', 'Link created succesfully');

        return back()->with('warning', 'You must be a trusted user for links to autopublish :)');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityLink $communityLink)
    {
        //
    }
}
