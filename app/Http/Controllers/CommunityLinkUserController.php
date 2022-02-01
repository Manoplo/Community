<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use App\Models\CommunityLinkUser;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class CommunityLinkUserController extends Controller
{

    public function store(CommunityLink $link_id)
    {




        CommunityLinkUser::firstOrNew([
            'user_id' => Auth::id(),
            'community_link_id' => $link_id->id,
        ])->toggle();


        /*  // Comprueba si existe un registro con los campos pasados en el array. Si existe lo devuelve, si no lo crea. 
        $vote = CommunityLinkUser::firstOrNew(['user_id' => Auth::id(), 'community_link_id' => $link_id->id]);


        // Si me ha devuelto un objeto en lugar de crearlo, tendre una id,  en cuyo caso elimino el registro. 
        if ($vote->id) {

            $vote->delete();

            // De lo contrario (si no existe), me habrá devuelto el objeto creado y tendré que insertarlo. 
        } else {

            $vote->save();
        } */

        return back();
    }
}
