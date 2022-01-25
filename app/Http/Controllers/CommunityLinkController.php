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
    public function index(Channel $channel = null)
    {
        // Si el channel no es null
        if ($channel) {
            // Traemos los links cuyo channel id esté vinculado con el channel id de la request y que estén aprobados. 
            $links = CommunityLink::where(['channel_id' => $channel->id, 'approved' => true])->latest()->paginate(25);
        } else {
            // Si no, los links que estén aprobados. 
            $links = CommunityLink::where('approved', 1)->latest('updated_at')->paginate(25);
        }
        // Los canales los traemos todos. 
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

        // Checkeamos si el user tiene el campo trusted a true
        $approved = Auth::user()->isTrusted();

        // Checkeamos si el link existe ya en la base de datos
        $link = new CommunityLink();
        $alreadySubmitted = $link->hasAlreadyBeenSubmitted($request->link);


        // Si el usuario es trusted y la variable alreadySubmitted nos ha devuelto un true (con lo que el link ya existía y le ha actualizado los timestamps)
        if ($approved && $alreadySubmitted) {
            // Volvemos advirtiendo al usuario que el link ya existe y que lo hemos puesto arriba. 
            return back()->with('warning', 'The link already exists. It´ll be uplisted, but contributor won´t change');
        } else {

            // Mergeamos el request con el usuario autenticado y le pasamos el approved, sea true o false
            $request->merge(['user_id' => Auth::id(), 'approved' => $approved]);

            // Guardamos el request en la base de datos
            CommunityLink::create($request->all());
        }

        // Si approved nos devolvío true, volvemos con el mensaje de éxito
        if ($approved) return back()->with('success', 'Link created succesfully');
        // Si no, volvemos con el mensaje de que el link está pendiente de aprobación
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
