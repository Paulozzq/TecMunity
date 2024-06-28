<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikeGrupo;

class LikeGrupoController extends Controller
{
    public function likePublicacion($publicacionId)
    {
        $like = LikeGrupo::create([
            'ID_usuario' => Auth::id(),
            'ID_publicacion_grupo' => $publicacionId
        ]);

        return redirect()->back();
    }

    public function likeComentario($comentarioId)
    {
        $like = Like::create([
            'ID_usuario' => Auth::id(),
            'ID_comentario_grupo' => $comentarioId,
        ]);

        return redirect()->back();
    }

    public function unlikePublicacion($publicacionId)
    {
        Like::where('ID_usuario', Auth::id())->where('ID_publicacion_grupo', $publicacionId)->delete();

        return redirect()->back();
    }

    public function unlikeComentario($comentarioId)
    {
        Like::where('ID_usuario', Auth::id())->where('ID_comentario_grupo', $comentarioId)->delete();

        return redirect()->back();
    }
}