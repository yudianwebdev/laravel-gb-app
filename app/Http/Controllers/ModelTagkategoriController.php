<?php

namespace App\Http\Controllers;

use App\Models\modeltagkategori;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ModelTagkategoriController extends Controller
{
    //
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $vallidator = Validator::make($request->all(), [
            'name_tag' => "required",
        ]);
        if ($vallidator->fails()) {
            $res = [
                'code' => 422,
                'massage' => "error validation",
                'data' => $vallidator->errors(),
            ];
            return response()->json($res, Response::HTTP_UNPROCESSABLE_ENTITY);
            # code...
        }
        try {
            $ads = modeltagkategori::create([
                "name_tag" => $request->name_tag,

            ]);
            return response()->json($ads, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            //throw $th;
            return response()->json([
                'massege' => "Failed" . $e->errorInfo
            ]);
        }
    }
}
