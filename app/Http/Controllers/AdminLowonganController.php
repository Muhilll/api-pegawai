<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminLowonganController extends Controller
{
    public function getLowongan(){
        try{
            $dataLowongan = Lowongan::all();
            return response()->json([
                'success' => true,
                'message' => 'SSuccesfull to get data lowongan',
                'data' => $dataLowongan
            ]);
        } catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed: ' . $e,
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function addLowongan(Request $request){
        try{
            $request->validate([
                'nama' => 'required',
                'perusahaan' => 'required',
                'lokasi' => 'required',
                'periode' => 'required',
                'deskripsi' => 'required',
                'kualifikasi' => 'required',
            ]);

            Lowongan::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Successfull',
            ], Response::HTTP_CREATED);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed: ' . $e,
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function editLowongan(Request $request){
        try{
            $request->validate([
                'id' => 'required',
                'nama' => 'required',
                'perusahaan' => 'required',
                'lokasi' => 'required',
                'periode' => 'required',
                'deskripsi' => 'required',
                'kualifikasi' => 'required',
            ]);

            $dataLowongan = Lowongan::find($request->id);

            if($dataLowongan){
                
                $dataLowongan->nama = $request->nama;
                $dataLowongan->perusahaan = $request->perusahaan;
                $dataLowongan->lokasi = $request->lokasi;
                $dataLowongan->periode = $request->periode;
                $dataLowongan->deskripsi = $request->deskripsi;
                $dataLowongan->kualifikasi = $request->kualifikasi;
                $dataLowongan->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Successfull',
                ], Response::HTTP_CREATED);
            } 

            return response()->json([
                'success' => false,
                'message' => 'Lowongan not found with id: '+$request->id,
            ], Response::HTTP_BAD_REQUEST);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed: ' . $e,
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function hapusLowongan(Request $request){
        try{
            $request->validate([
                'id' => 'required',
            ]);

            $dataLowongan = Lowongan::find($request->id);
            if($dataLowongan){
                $dataLowongan->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Successfull',
                ], Response::HTTP_CREATED);
            } 

            return response()->json([
                'success' => false,
                'message' => 'Lowongan not found with id: '+$request->id,
            ], Response::HTTP_BAD_REQUEST);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed: ' . $e,
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
