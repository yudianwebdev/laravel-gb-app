<?php

namespace App\Http\Controllers;

use App\Models\modelbackground;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ModelBackgroundController extends Controller
{
    //
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
            $img = $request->file('image')->store("post-images", 'public');

            $ads = modelbackground::create([
                "images" => Storage::url($img),
                "name" => $request->name,
                "id_tag" => $request->id_tag,

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
