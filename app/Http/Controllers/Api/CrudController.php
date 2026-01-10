<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    private array $procedures = [
        'tipocontenido' => 'sp_tipocontenido',
        'contenido'     => 'sp_contenido',
        'tipoimagen'    => 'sp_tipoimagen',
        'galerias'      => 'sp_galerias',
        'mensajes'      => 'sp_mensajes',
        'empresa'       => 'sp_empresa',
        'comentarios'   => 'sp_comentarios',
        'materiales'   => 'sp_materiales',
    ];

    public function execute(Request $request)
{
    $tabla = $request->tabla;
    $op    = $request->op;
    $data  = $request->data ?? [];

    if (!isset($this->procedures[$tabla])) {
        return response()->json(['error' => 'Tabla no permitida'], 400);
    }

    $sp = $this->procedures[$tabla];

    if (in_array($op, [5, 7])) {
        $result = DB::select(
            "CALL {$sp}(?, ?)",
            [$op, json_encode($data)]
        );

        return response()->json($result);
    }

    // 👉 INSERT / UPDATE / ACTIVATE / DEACTIVATE
    DB::statement(
        "CALL {$sp}(?, ?)",
        [$op, json_encode($data)]
    );

    return response()->json(['ok' => true]);
}


}
