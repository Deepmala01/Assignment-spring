<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use App\Http\Resources\JSusers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Jobs\generateQrCode;
use App\Models\Address;
use App\Http\Resources\JSaddress;
use App\Http\Resources\JSaddressCollection;


class UsersController extends Controller
{
    public function index()
    {
        $user = users::all();
        if($user){
            return JSusers::collection($user);
        } else {
            return response()->json(['message' => 'No Record found'], 200);
        }
    }


    public function store(Request $request )
    {
        $user = new users();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'points' => 'required|integer|min:0',
            'address' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'All fields are required',
            ], 422);
        }
        $user = users::create([
            'name' => $request->name,
            'age' => $request->age,
            'points' => $request->points,
            'address' => $request->address,
        ]);
       generateQrCode::dispatch($user);
        return response()->json(['message'=>'user created successfully.','data' => new JSusers($user)], 200);
    }



    
    public function show($id)
    { 
        if(users::where('id', $id)->exists()){
            $user = users::find($id);
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
      }



    public function update(Request $request, $id)
    {
        $user = new users();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'points' => 'required|integer|min:0',
            'address' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'All fields are required',
            ], 200);
        }
        
        if(users::where('id', $id)->exists()){
        $user = users::find($id);
        $user->update([
            'name' => $request->name,
            'age' => $request->age,
            'points' => $request->points,
            'address' => $request->address,
        ]);
        return response()->json(['message'=>'user updated successfully.','data' => new JSusers($user)], 200);
        }  else {
            return response()->json(['message' => 'User not found'], 404);
        }
     
    }



    public function destroy($id)
    {

        if(users::where('id', $id)->exists()){
        $user = users::find($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }  else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }



    public function getUsersGroupedByPoint(): JsonResponse
    {
        $users = users::select('points', DB::raw('CAST(AVG(age) AS UNSIGNED) as average_age'), DB::raw('GROUP_CONCAT(name) as names'))
            ->groupBy('points')
            ->get();

        $result = [];
        foreach ($users as $user) {
            $result[$user->points] = [
                'names' => explode(',', $user->names),
                'average_age' => $user->average_age,
            ];
        }

        return response()->json($result);
    }





    
}
