<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class PostsController extends Controller
{
    public $apiUrl;

    public function __construct() {
        $this->apiUrl=env('API_URL');
    }

    public function index():View
    {
        return View("posts.users");
    }

    public function getUsersPosts(Request $request):JsonResponse
    {
        if ($request->ajax()) {
            $response = Http::get($this->apiUrl."users");
            $data = $response->json();
            $dataTableData = collect($data)->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'username' => $item['username'],
                    'email' => $item['email'],
                    'address' => $item['address'],
                    'phone' => $item['phone'],
                    'website' => $item['website'],
                    'company' => $item['company']
                ];
            });
            return Datatables::of($dataTableData)->make(true);
        }
    }

    public function getPosts(int $userId)
    {
        $response = Http::get($this->apiUrl."users/{$userId}/posts");
        $posts = $response->json();
        $response = Http::get($this->apiUrl."users/$userId");
        $user = $response->json();
        return View('posts.posts',compact(['posts','user']));
    }
}
