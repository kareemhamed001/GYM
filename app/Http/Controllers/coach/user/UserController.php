<?php

namespace App\Http\Controllers\coach\user;

use App\classes\user\UserClass;
use App\Http\Controllers\Controller;
use App\Models\coach;
use App\Models\User;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = 2;
        $users = User::where('role_as', 2)->paginate();
        return view('coach.users.index', compact('users', 'role'));
    }

    function coaches()
    {
        $role = 1;
        $users = User::where('role_as', 1)->paginate();
        return view('coach.users.index', compact('users', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = 2;
        return view('coach.users.create', compact('role'));
    }

    public function createCoach()
    {
        $role = 1;
        return view('coach.users.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        return view('coach.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    function profile(){
        $user=Auth::user();
        return view('auth.profile',compact('user'));
    }

    public function update(Request $request)
    {
        try {

            if ($request->user()) {


                $validator = Validator::make($request->all(), [
                    'name' => 'string|between:2,50',
                    'phone_number' => 'string|starts_with:01|max_digits:11',
                    'country' => 'string',
                    'address' => 'string',
                    'age' => 'integer',
                    'gender' => 'digits_between:0,1',
                    'profile_image' => 'image',
                    'coach_nick_name' => 'nullable|string|between:2,50',
                    'coach_phone_number' => ['nullable','string','starts_with:01','max_digits:11',Rule::unique('coaches','phone_number')],
                    'coach_phone_email' => ['nullable','string','email',Rule::unique('coaches','email')],
                    'coach_description' => 'nullable|string|max:500',
                    'coach_experience' => 'nullable|numeric',
                    'coach_intro_video' => 'nullable|mimes:mp4',
                ]);
                if ($validator->fails()) {
                    return $this->apiResponse(null, $validator->errors(), 400);
                }

                $user = User::find($request->user()->id);


                if ($user) {
                    if ($request->profile_image) {
                        $path = $this->replaceFile($user->profile_image, $request->profile_image, 'images/users/profile_images');
                        $user->profile_image = $path;
                    }

                    if ($request->name) {
                        $user->name = $request->name;
                    }
                    if ($request->country) {
                        $user->country = $request->country;
                    }
                    if ($request->phone_number) {
                        $user->phone_number = $request->phone_number;
                    }
                    if ($request->age) {
                        $user->age = $request->age;
                    }
                    if ($request->password) {
                        $user->password=Hash::make($request->password);
                    }
                    if ($request->gender) {
                        $user->gender = $request->gender;
                    }
                    if ($request->address) {
                        $user->address = $request->address;
                    }
                    if ($user->role_as==1){
                        $coach=coach::where('user_id',$user->id)->first()?? coach::create(['user_id'=>$user->id]);

                        if ($request->coach_nick_name) {
                            $coach->nick_name = $request->coach_nick_name;
                        }
                        if ($request->coach_description) {
                            $coach->description = $request->coach_description;
                        }
                        if ($request->coach_experience) {
                            $coach->experience = $request->coach_experience;
                        }
                        if ($request->coach_intro_video) {
                            $path=$this->replaceFile($coach->intro_video,$request->intro_video,'video/coaches/introVideos');
                            $coach->intro_video = $path;
                        }
                        if ($request->coach_phone_email) {
                            $coach->email = $request->coach_phone_email;
                        }
                        if ($request->coach_phone_number) {
                            $coach->phone_number = $request->coach_phone_number;
                        }
                        $coach->save();
                    }

                    $user->save();

                    return $this->apiResponse($user, 'Success', 200);
                }
                return $this->apiResponse('', 'No user with this id', 200);
            }
            return $this->apiResponse('', 'User Not Authorized', 200);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
