<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommunityLinkForm;
use App\Models\CommunityLink;
use App\Queries\CommunityLinkQuery;
use Illuminate\Http\Request;

class CommunityLinkController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $clq = new CommunityLinkQuery();
        if ($request->has('search')) {
            $links = $clq->search($request->get('search'));
        } else if ($request->exists('popular')) {
            $links = $clq->getMostPopular();
        } else {

            $links = $clq->getAll();
        }

        return response()->json(['Links' => $links], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommunityLinkForm $request)
    {
        $approved = $request->user_id->isTrusted();

        $link = new CommunityLink();
        $alreadyExists = $link->hasAlreadyBeenSubmitted($request->link);

        if ($alreadyExists) {
            return response()->json(['message' => 'Link already exists'], 422);
        } else if ($approved) {
            CommunityLink::create($request->all());
            return response()->json(['message' => 'Link created'], 201);
        } else {
            return response()->json(['message' => 'You don´t have permission to publish links'], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityLink $communityLink)
    {
        return response()->json(['Link' => $communityLink], 200);
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
        $communityLink->title = $request->title;
        $communityLink->link = $request->link;
        $communityLink->channel_id = $request->channel_id;

        $communityLink->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityLink $communityLink)
    {
        $communityLink->delete();
    }
}
