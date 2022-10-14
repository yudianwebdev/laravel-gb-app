<?php

namespace App\Http\Controllers;

use App\Models\modelbackground;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class ModelBackgroundController extends Controller
{
    //

    public function show($keyword)
    {
        //
        // dd("tes");
        $data_tag
            = modelbackground::whereRaw('json_contains(id_tag, \'[ ' . $keyword . ']\')')->get();

        $res = [
            'massage' => 'Data Ditemukan',
            'Data' => $data_tag
        ];
        return response()->json($res, Response::HTTP_OK);
    }

    public function imgPost(Request $request)
    {
        $vallidator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            //code...

            // $imageName = time().'.'.$request->image->extension();  
            // $imgloc ='api.ambyarfood.com'.'/images/'.$imageName;

            // $request->image->move(public_path('images'), $imageName);
            // dd($request->all());
            $img = $request->file('image')->store("post-images", 'public');
            $ads = modelbackground::create([
                "images" => Storage::url($img),
                "name" => $request->name,
                "id_tag" => json_decode($request->id_tag, true),

            ]);
            return response()->json($ads, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            //throw $th;
            return response()->json([
                'massege' => "Failed" . $e->errorInfo
            ]);
        }

        /* Store $imageName name in DATABASE from HERE */

        // return back()
        //     ->with('success','You have successfully upload image.')
        //     ->with('image',$imageName); 

    }
}
