<?php

use App\Models\book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->group(function () {
        // Route::get('/', function (Request $request) {
        //     return $request->user();  // /user
        // });
        Route::get('/checkdata', function (Request $request) {
            return $request->user();  // /user/checkdata
        });

        Route::get('/databuku', function () {
            return book::all();
        });

        Route::get('/databuku/{id}', function ($id) {
            $buku = book::find($id);
            if (!$buku) {
                return response()->json(['message' => 'Buku not found'], 404);
            }
            return response()->json($buku);
        });

        Route::post('/updatebuku/{id}', function ($id, Request $request) {
            $buku = book::find($id);

            if (!$buku) {
                return response()->json(['message' => 'Buku not found'], 404);
            }

            $buku->content = $request->content;
            $buku->visuals = $request->visuals;
            $buku->book_cover = $request->book_cover;
            $buku->layout_formating = $request->layout_formating;
            $buku->genres = $request->genres;
            $buku->physical_attributes = $request->physical_attributes;
            $buku->interactive_elements = $request->interactive_elements;
            $buku->save();

            return response()->json(['message' => 'Buku Updated'], 200);
        });

        Route::post('/insertbuku', function (Request $request) {
            $buku = new book();
            $buku->content = $request->content;
            $buku->visuals = $request->visuals;
            $buku->book_cover = $request->book_cover;
            $buku->layout_formating = $request->layout_formating;
            $buku->genres = $request->genres;
            $buku->physical_attributes = $request->physical_attributes;
            $buku->interactive_elements = $request->interactive_elements;
            $buku->save();

            return response()->json(['message' => 'Buku Inserted'], 200);
        });

        Route::post('/deletebuku/{id}', function ($id) {
            $buku = book::find($id);

            if (!$buku) {
                return response()->json(['message' => 'Buku not found'], 404);
            }

            $buku->delete();

            return response()->json(['message' => 'Delete Buku Berhasil']);
        });
    });
});



Route::post('/login', function (Request $request) {
    // Validate the request inputs
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Find the user by email
    $user = User::where('email', $request->email)->first();

    // Check if user exists and password is correct
    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401); // Always return JSON
    }

    // Generate a new API token for the user
    $token = $user->createToken('api-token')->plainTextToken;

    // Return JSON response with token
    return response()->json([
        'message' => 'Login successful',
        'token' => $token
    ]);
});


Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Logged out'], 200);
})->middleware('auth:sanctum');


Route::post('/register', function (Request $request) {
    $user = new User();

    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    return response()->json(['message' => 'Register Success'], 200);
});
