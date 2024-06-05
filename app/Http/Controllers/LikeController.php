<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likePublicacion($publicacionId)
    {
        $like = Like::create([
            'ID_usuario' => Auth::id(),
            'ID_publicacion' => $publicacionId
        ]);

        return redirect()->back();
    }

    public function likeComentario($comentarioId)
    {
        $like = Like::create([
            'ID_usuario' => Auth::id(),
            'ID_comentario' => $comentarioId,
        ]);

        return redirect()->back();
    }

    public function unlikePublicacion($publicacionId)
    {
        Like::where('ID_usuario', Auth::id())->where('ID_publicacion', $publicacionId)->delete();

        return redirect()->back();
    }

    public function unlikeComentario($comentarioId)
    {
        Like::where('ID_usuario', Auth::id())->where('ID_comentario', $comentarioId)->delete();

        return redirect()->back();
    }
}
