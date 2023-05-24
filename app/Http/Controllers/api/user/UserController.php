<?php

namespace App\Http\Controllers\api\user;


use App\classes\user\UserClass;
use App\Http\Controllers\Controller;
use App\Models\coach;
use App\Models\User;
use App\Models\video;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    private $storeRules;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login', 'register']]);
        $this->storeRules =
            [
                'profile_image' => ['required', 'image'],
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'unique:users'],
                'password' => ['required', 'string', 'min:8','confirmed'],
                'phone_number' => ['required', 'string', 'unique:users', 'starts_with:01', 'max_digits:11'],
                'country' => ['required', 'string'],
                'age' => ['required', 'integer'],
                'gender' => ['required', Rule::in([0, 1])],
                'address' => ['required', 'string'],
                'role_as' => ['required', 'integer', Rule::in([1, 2])]
            ];
    }


    public function users($pagination=null)
    {

        try {
            $user=User::find(auth()->user()->id);
            if ($user->role_as==1){
                $users = User::all();
                return $this->apiResponse($users, 'success', 200);
            }
            return $this->apiResponse('', 'you are not authorized to access this data', 400);

        } catch (\Exception $e) {
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        $token = auth()->guard('api')->attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     * @throws ValidationException
     */
    public function register(Request $request)
    {


        try {
            $validator = Validator::make($request->all(), $this->storeRules);
            if ($validator->fails()) {
                return $this->apiResponse('', $validator->errors(), 400);
            }


            $image = $request->file('profile_image');
            $path = $image->store('images/users/profileImages', ['disk' => 'public']);

            if (intval($request->role_as) == 1) {

                $validator1 = Validator::make($request->all(), [
                    'coach_nick_name' => ['required', 'string', 'max:100'],
                    'coach_email' => ['required', 'string', 'email',Rule::unique('coaches','email')],
                    'coach_description' => ['required', 'string', 'max:500'],
                    'coach_phone_number' => ['required', 'numeric', 'starts_with:01',Rule::unique('coaches','phone_number')],
                    'coach_experience' => ['required', 'numeric'],
                    'coach_intro_video' => ['required', 'mimes:mp4,m4v'],
                ]);
                if ($validator1->fails()) {
                    return $this->apiResponse('', $validator1->errors(), 400);
                }
            }

            $user = User::create([
                'address' => $request->address,
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'country' => $request->country,
                'age' => $request->age,
                'gender' => $request->gender,
                'role_as' => $request->role_as,
                'profile_image' => 'storage/' . $path,
            ]);


                if (intval($request->role_as) == 1) {
                    $path=$this->storeFile($request->coach_intro_video,'images/coaches/introVideos');
                    $coach = coach::create([
                        'nick_name' => $request->coach_nick_name,
                        'email' => $request->coach_email,
                        'description' => $request->coach_description,
                        'phone_number' => $request->coach_phone_number,
                        'experience' => $request->coach_experience,
                        'intro_video' => $path,
                        'user_id' => $user->id
                    ]);
                    return $this->apiResponse(['user'=>$user,'coach'=>$coach], 'User successfully registered', 200);
                }

            return $this->apiResponse($user, 'User successfully registered', 200);
        } catch (\Exception $e) {
            return $this->apiResponse('', $e->getTrace(), 400);
        }

    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        $user=auth()->user();
        $user=User::with('coach')->where('id',$user->id)->get();
        return response()->json($user);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 * 24,
            'user' => auth()->user()
        ]);
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

    public function changePassword(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'old_password' => 'string|min:8',
                'new_password' => 'string|min:8|confirmed',

            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $user = User::find(auth()->user()->id);

            if ($user) {
                if (Hash::check($request->old_password, $user->password)) {

                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return $this->apiResponse($user, 'success', 200);
                } else {
                    return $this->apiResponse(null, 'The old password is not correct', 400);
                }
            }
            return $this->apiResponse('', 'No user with this id', 400);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    function myOrders()
    {
        try {

            $user = User::find(auth()->user()->id);
            if ($user) {
                return $this->apiResponse($user->purchases, 'success', 200);
            } else {
                return $this->apiResponse('', 'No user with this id', 400);
            }
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    function myCart()
    {
        try {

            $user = User::find(auth()->user()->id);
            if ($user) {
                return $this->apiResponse($user->cart, 'success', 200);
            } else {
                return $this->apiResponse('', 'No user with this id', 400);
            }
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    function myWishList()
    {
        try {

            $user = User::find(auth()->user()->id);
            if ($user) {
                return $this->apiResponse($user->wishList, 'success', 200);
            } else {
                return $this->apiResponse('', 'No user with this id', 400);
            }
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

//    function myPlans()
//    {
//        try {
//
//            $user = User::find(auth()->user()->id);
//            if ($user) {
//                return $this->apiResponse($user->subscriptions, 'success', 200);
//            } else {
//                return $this->apiResponse('', 'No user with this id', 400);
//            }
//        } catch (\Exception $e) {
//            return $this->apiResponse($e->getMessage(), 'error', 400);
//        }
//    }

    function coach()
    {
        try {

            $user = User::with('coach')->find(auth()->user()->id);
            if ($user) {
                return $this->apiResponse($user, 'success', 200);
            } else {
                return $this->apiResponse('', 'No user with this id', 400);
            }
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function deleteArrayOfUsers(Request $request)
    {
        try {
            $validator = validator::make($request->all(), [
                'users' => ['required', 'array'],
            ]);

            if ($validator->fails()) {
                return response()->json(['data' => null, 'message' => $validator->errors()], 400);
            }
            if (!is_array($request->users)) {
                return response()->json(['data' => null, 'message' => 'users must be in array'], 200);
            }
            $cover_images_pathes = User::query()->whereIn('id', $request->users)->pluck('profile_image');


            $this->deleteCollectionOfFiles($cover_images_pathes);
            User::whereIn('id', $request->users)->delete();
            return $this->apiResponse('', 'success', 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
