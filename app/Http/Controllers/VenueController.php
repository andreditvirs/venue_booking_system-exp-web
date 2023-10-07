<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VenueController extends Controller
{
    public function index()
    {
        $data = Venue::all()->toArray();
        if($data){
            return response()->json(array_reverse($data), 200);
        }
        return response()->json([], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'alamat' => 'required',
            'file_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        DB::beginTransaction();
        try{
            $venue = new Venue();
            $venue->nama = $request->nama;
            $venue->kategori = $request->kategori;
            $venue->alamat = $request->alamat;
            
            if ($image = $request->file('file_image')) {
                $destinationPath = 'image/';
                $venueImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $venueImage);
                $venue->file_image = "$venueImage";
            }
            $venue->save();
            DB::commit();
            return response()->json([
                "status" => "ok",
                "message" => "Data venue berhasil ditambahkan",
                "data" => $venue
            ], 200);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $venue = Venue::find($id);
            if($venue){ $venue->delete(); }
            DB::commit();
            return response()->json([
                "status" => "ok",
                "message" => "Data venue berhasil dihapus",
                "data" => $venue
            ], 200);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }
}
