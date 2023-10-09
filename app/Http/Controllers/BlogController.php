<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\BlogUpdate;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class BlogController extends Controller
{

    public function showAll(): JsonResponse
    {
        $perPage = 3;
        $data = Blog::paginate($perPage);

        if ($data->isEmpty()) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($data, 200);
    }

    public function create(BlogRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $gambarName = time() . '.' . $gambar->getClientOriginalExtension();

                $gambar->move(public_path('uploads'), $gambarName);
                $data['gambar'] = $gambarName;
            }
            $contact = new Blog($data);
            $contact->save();

            return (new BlogResource($contact))->response()->setStatusCode(201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal membuat blog', 'error' => $e->getMessage()], 500);
        }
    }

    public function getById(int $id): BlogResource
    {
        $blog = Blog::where('id', $id)->first();
        if (!$blog) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        return new BlogResource($blog);
    }

    public function update(int $id, BlogUpdate $request): BlogResource
    {
        $blog = Blog::findOrFail($id);
        if (!$blog) {
            throw new HttpResponseException(
                response()->json(['message' => 'Not found'], 404)
            );
        }

        try {
            $data = $request->validated();

            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if (!empty($blog->gambar)) {
                    Storage::delete('uploads/' . $blog->gambar);
                }

                $gambar = $request->file('gambar');
                $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
                $gambar->move(public_path('uploads'), $gambarName);
                $data['gambar'] = $gambarName;
            }

            $blog->fill($data);
            $blog->save();

            return new BlogResource($blog);

        } catch (ValidationException $e) {
            throw new HttpResponseException(
                response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422)
            );
        } catch (\Exception $e) {
            throw new HttpResponseException(
                response()->json(['message' => 'Error updating blog', 'error' => $e->getMessage()], 500)
            );
        }
    }

    public function delete(int $id): JsonResponse
    {
        $blog = Blog::findOrFail($id);

        if (!$blog) {
            throw new HttpResponseException(
                response()->json(['message' => 'Not found'], 404)
            );
        }

        try {
            if (!empty($blog->gambar)) {
                Storage::delete('uploads/' . $blog->gambar);
            }
            $blog->delete();
            Log::info('Blog deleted', ['blog_id' => $id]);

            return response()->json([
                'data' => true,
                'message' => 'Blog deleted successfully'
            ])->setStatusCode(200);

        } catch (\Exception $e) {
            Log::error('Error deleting blog', ['blog_id' => $id, 'error' => $e->getMessage()]);
            throw new HttpResponseException(
                response()->json(['message' => 'Error deleting blog', 'error' => $e->getMessage()], 500)
            );
        }
    }

    public function search(Request $request): BlogCollection
    {
        $searchTerm = $request->input('title');
        $blog = Blog::where('title', $searchTerm)->first();
        if (!$blog) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $blogs = Blog::where('title', 'like', '%' . $searchTerm . '%')->get();
        return new BlogCollection($blogs);
    }
}