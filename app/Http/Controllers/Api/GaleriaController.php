<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GaleriaController extends Controller
{
    public function index()
    {
        $data = DB::select("CALL sp_galerias(5, NULL)");
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $ruta = $this->guardarImagenBase64($request->imagen);

        DB::statement("CALL sp_galerias(1, ?)", [
            json_encode([
                'nombrefoto'   => $ruta,
                'peso'         => $request->peso,
                'idtipoimagen' => $request->idtipoimagen,
                'titulo'       => $request->titulo,
                'parrafo'      => $request->parrafo,
            ])
        ]);

        return response()->json(['ok' => true]);
    }

    public function update(Request $request)
    {
        $ruta = $request->imagen
            ? $this->guardarImagenBase64($request->imagen)
            : $request->nombrefoto;

        DB::statement("CALL sp_galerias(2, ?)", [
            json_encode([
                'idgaleria'    => $request->idgaleria,
                'nombrefoto'   => $ruta,
                'peso'         => $request->peso,
                'idtipoimagen' => $request->idtipoimagen,
                'titulo'       => $request->titulo,
                'parrafo'      => $request->parrafo,
            ])
        ]);

        return response()->json(['ok' => true]);
    }

    private function guardarImagenBase64($base64)
    {
        $data = explode(',', $base64);
        $imagen = base64_decode($data[1]);

        $nombre = 'galeria_' . time() . '.jpg';
        $ruta = "galerias/$nombre";

        Storage::disk('public')->put($ruta, $imagen);

        return $ruta; // SOLO RUTA
    }
}
