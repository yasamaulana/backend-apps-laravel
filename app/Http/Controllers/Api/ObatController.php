<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ObatResource;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Obat::query();

        if ($search) {
            $query->where('nama_obat', 'like', "%$search%")
                ->orWhere('kode_obat', 'like', "%$search%");
        }

        return ObatResource::collection($query->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_obat' => 'required|unique:obats|max:255',
            'kode_obat' => 'required|unique:obats|max:50',
            'jenis_obat' => 'required|max:50',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $obat = Obat::create($validated);

        return new ObatResource($obat);
    }

    /**
     * Display the specified resource.
     */
    public function show(Obat $obat)
    {
        return new ObatResource($obat);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_obat' => "required|unique:obats,nama_obat,$id",
            'kode_obat' => "required|unique:obats,kode_obat,$id",
            'jenis_obat' => 'required',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $obat->update($validated);

        return new ObatResource($obat);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return response()->json(['message' => 'Obat berhasil terhapus']);
    }
}