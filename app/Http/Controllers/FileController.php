<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{



    public function store(FileRequest $request)
    {

        $path = $request->file('avatar')->store('public');

        $user = Auth::user();
        $user->avatar = asset('storage/' . $request->file('avatar')->hashName());
        $user->save();

        return redirect('/community');
    }
}
