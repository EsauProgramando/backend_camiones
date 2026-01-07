<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MaterialesController extends Controller
{

    public function index()
    {
        $data = DB::select("CALL sp_materiales(5, NULL)");
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $ruta = $this->guardarImagenBase64($request->imagen);

        DB::statement("CALL sp_materiales(1, ?)", [
            json_encode([
                'nombrefoto'   => $ruta,
                'titulo'         => $request->titulo,
                'nombrematerial' => $request->nombrematerial,
                'descripcion1'       => $request->descripcion1,
                'descripcion2'      => $request->descripcion2,
            ])
        ]);

        return response()->json(['ok' => true]);
    }

    public function update(Request $request)
    {
        // 🔹 Si viene imagen nueva
        if ($request->imagen) {

            // 1️⃣ Borrar imagen anterior si existe
            if ($request->nombrefoto && Storage::disk('public')->exists($request->nombrefoto)) {
                Storage::disk('public')->delete($request->nombrefoto);
            }

            // 2️⃣ Guardar nueva imagen
            $ruta = $this->guardarImagenBase64($request->imagen);

        } else {
            // 🔹 Mantener imagen actual
            $ruta = $request->nombrefoto;
        }

        DB::statement("CALL sp_materiales(2, ?)", [
            json_encode([
                'idmateriales'    => $request->idmateriales,
                'nombrefoto'   => $ruta,
                'titulo'         => $request->titulo,
                'nombrematerial' => $request->nombrematerial,
                'descripcion1'       => $request->descripcion1,
                'descripcion2'      => $request->descripcion2,
            ])
        ]);

        return response()->json(['ok' => true]);
    }


    private function guardarImagenBase64($base64)
    {
        $data = explode(',', $base64);
        $imagen = base64_decode($data[1]);

        $nombre = 'materiales_' . time() . '.jpg';
        $ruta = "materiales/$nombre";

        Storage::disk('public')->put($ruta, $imagen);

        return $ruta; // SOLO RUTA
    }

    public function destroy(Request $request)
    {
        if ($request->nombrefoto && Storage::disk('public')->exists($request->nombrefoto)) {
            Storage::disk('public')->delete($request->nombrefoto);
        }

        DB::statement("CALL sp_materiales(3, ?)", [
            json_encode(['idmateriales' => $request->idmateriales])
        ]);

        return response()->json(['ok' => true]);
    }
    public function obtenermaterial($idmateriales)
    {
        $data = DB::select(
            "CALL sp_materiales(6, ?)",
            [ json_encode(['idmateriales' => $idmateriales]) ]
        );

        // Retornar un solo registro (siempre viene como array)
        return response()->json($data[0] ?? null);
    }

}
