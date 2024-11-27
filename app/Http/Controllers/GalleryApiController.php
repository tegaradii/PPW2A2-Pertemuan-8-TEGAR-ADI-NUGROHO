<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class GalleryApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/galleries",
     *     summary="Get list of galleries",
     *     tags={"Galleries"},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data gallery",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example="Gallery id"),
     *                 @OA\Property(property="title", type="string", example="Gallery Title"),
     *                 @OA\Property(property="description", type="string", example="Gallery Description"),
     *                 @OA\Property(property="picture", type="string", example="http://example.com/path/to/picture.jpg")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function index()
    {
        $galleries = Post::where('picture', '!=', '')->whereNotNull('picture')->orderBy('created_at', 'desc')->get();

        $data = $galleries->map(function ($gallery) {
            return [
                'id' => $gallery->id,
                'title' => $gallery->title,
                'description' => $gallery->description,
                'picture' => $gallery->picture,
            ];
        });

        return response()->json([
            'message' => 'Berhasil mengambil data gallery',
            'success' => true,
            'data' => $data
        ], 200);
    }
}
