<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class UserController extends Controller
{

    public function index()
    {

        $result = QueryBuilder::for(User::class)->allowedFilters(['First_name', AllowedFilter::scope('between')])->paginate(10)->appends(request()->query());

        foreach ($result as $user) {
            $user->profile;
        }

        return response()->json([
            'users' => $result
        ], 200);
    }

    public function store(Request $request)
    {
        $user = request()->validate(
            [
                'First_name' => 'required',
                'Last_name' => 'required',
                'Description' =>  'required',
            ],
            [
                'First_name.required' => 'First name is required',
                'Last_name.required' => 'Last name is required',
                'Description.required' =>  'Description is required',
            ]
        );

        $profile = new Profile();
        $profile->Ima_profile = $request['Ima_profile'] ? $request['Ima_profile'] : env('APP_URL') . '/' . ('defaultprofileimg.jpeg');

        $user = User::create([
            'First_name' => $request['First_name'],
            'Last_name' => $request['Last_name'],
            'Description' => $request['Description'],
        ]);

        $user->profile()->save($profile);
        $user->profile;

        return response()->json([
            'message' => 'new user created',
            'new_users' => $user
        ], 201);
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        $user->First_name = $request->input('First_name');
        $user->Last_name = $request->input('Last_name');
        $user->Description = $request->input('Description');

        $user->save();

        return response()->json([
            'message' => 'user edited',
            'edited_user' => $user
        ], 202);
    }

    public function softDeleted(Request $request, $id)
    {
        $user = User::find($id);

        $user->delete();

        return response()->json([
            'message' => 'user deleted',
            'deleted_user' => $user
        ], 203);
    }
}
