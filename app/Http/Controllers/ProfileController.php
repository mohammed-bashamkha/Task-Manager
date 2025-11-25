<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {
        $profile = Auth::user()->profile;
        return response()->json($profile, 200);
    }
    public function store(StoreProfileRequest $request) {
        $user_id = Auth::user()->id;
        $validateData = $request->validated();
        $validateData['user_id'] = $user_id;
        $profile = Profile::create($validateData);
        if($request->hasFile('image')) {
            $path = $request->file('image')->store('MyPhoto','public');
            $validateData['image'] = $path;
        }
        return response()->json([
            'message' => 'Profile Created Successfully',
            'profile' => $profile
        ], 201);
    }
    public function show($id) {
        $profile = Profile::where('user_id',$id)->firstOrFail();
        return response()->json($profile, 200,);
    }

    public function update(UpdateProfileRequest $request,$id) {
        $profile = Profile::where('user_id',$id)->firstOrFail();
        $profile->update($request->validated());
        return response()->json($profile, 202);
    }
    public function destroy($id) {
        $profile = Profile::where('user_id',$id)->firstOrFail();
        $profile->delete();
        return response()->json("Task With ID ($id) Deleted Seccssfuly", 200);
    }
}
