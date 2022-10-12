<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->all(["search", "trashed"]);
        return Inertia::render("User/Index", [
            "filters" => $filters,
            "users" => User::orderByName()
                ->filter($filters)
                ->get()
                ->transform(
                    fn(User $user) => [
                        "id" => $user->id,
                        "name" => $user->name,
                        "email" => $user->email,
                        "deleted_at" => $user->deleted_at,
                        "photo" => $user->photo_path
                            ? route("image", [
                                "path" => $user->photo_path,
                                "w" => 48,
                                "h" => 48,
                                "fit" => "crop",
                            ])
                            : null,
                    ]
                ),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("User/Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "first_name" => ["required", "max:25"],
            "last_name" => ["required", "max:25"],
            "email" => ["required", "max:50", "email", Rule::unique("users")],
            "password" => ["required", "max:255"],
            "photo" => ["nullable", "array", "max:1"],
            "photo.*.file" => ["required", "image"],
        ]);
        User::create([
            "first_name" => $validated["first_name"],
            "last_name" => $validated["last_name"],
            "email" => $validated["email"],
            "password" => $validated["password"],
            "photo_path" => Arr::get($validated, "photo.0.file", null)?->store(
                "users"
            ),
        ]);
        return Redirect::route("users.index")->with("success", "User created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
