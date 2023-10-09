<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherCreateRequest;
use App\Models\Vourcher;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\VoucherResource;
use App\Http\Requests\VoucherUpdateRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VoucherController extends Controller
{
    public function create(VoucherCreateRequest $request)
    {
        try {
            $data = $request->validated();
            // Simpan data ke database
            $contact = new Vourcher($data);
            $contact->save();
    
            // Kembalikan respons sukses
            return response()->json(['data' => $contact], 201);
    
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kirim respons kesalahan
            return response()->json(['message' => 'Gagal membuat blog', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(int $id, VoucherUpdateRequest $request): VoucherResource
{
    $voucher = Vourcher::find($id);
    if (!$voucher) {
        throw new HttpResponseException(response()->json([
            'errors' => [
                "message" => [
                    "not found"
                ]
            ]
        ])->setStatusCode(404));
    }

    $data = $request->validated();
    $voucher->fill($data);
    $voucher->save();

    return new VoucherResource($voucher);
}

    public function delete(int $id): JsonResponse
    {
        $blog = Vourcher::find($id);

        if (!$blog) {
            throw new HttpResponseException(
                response()->json(['message' => 'Not found'], 404)
            );
        }

        try {
            // Hapus blog
            $blog->delete();

            return response()->json([
                'data' => true,
                'message' => 'Blog deleted successfully'
            ])->setStatusCode(200);

        } catch (\Exception $e) {
            throw new HttpResponseException(
                response()->json(['message' => 'Error deleting blog', 'error' => $e->getMessage()], 500)
            );
        }
    }
}
