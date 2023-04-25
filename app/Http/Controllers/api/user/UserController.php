<?php

namespace App\Http\Controllers\api\user;


use App\classes\user\UserClass;
use App\Http\Controllers\Controller;
use App\Models\coach;
use App\Models\user;
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
        $this->middleware('auth:api', ['except' => ['login', 'register', 'deleteArrayOfUsers']]);
        $this->storeRules =
            [
                'profile_image' => ['required', 'image'],
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'phone_number' => ['required', 'string', 'unique:users', 'starts_with:01', 'max_digits:11'],
                'country' => ['required', 'string'],
                'age' => ['required', 'integer'],
                'gender' => ['required', Rule::in([0, 1])],
                'address' => ['required', 'string'],
                'role_as' => ['required', 'integer', Rule::in([0, 1, 2])]
            ];
    }


    public function index()
    {
        try {

            $users = UserClass::getAll();
            return $this->apiResponse($users, 'success', 200);
        } catch (\Exception $e) {
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
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
                    'coach_intro_video' => ['required', 'mimes:mp4'],
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
            return $this->apiResponse('', $e->getMessage(), 400);
        }

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
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

            $validator = Validator::make($request->all(), [
                'name' => 'string|between:2,50',
                'email' => 'string|email|max:100|unique:users',
                'phone_number' => 'string|unique:users|starts_with:01|max_digits:11',
                'country' => 'string',
                'address' => 'string',
                'age' => 'integer',
                'gender' => 'digits_between:0,1',
                'profile_image' => 'image',
                'role_as' => ['integer', Rule::in([0, 1, 2])],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $user = UserClass::get(auth()->user()?->id);


            if ($user) {
                if ($request->profile_image) {
                    $path = $this->replaceFile($user->profile_image, $request->profile_image, 'images/users/profile_images');
                }

                if ($request->name) {
                    $user->name = $request->name;
                }
                if ($request->country) {
                    $user->country = $request->country;
                }
                if ($request->email) {
                    $user->email = $request->email;
                }
                if ($request->phone_number) {
                    $user->phone_number = $request->phone_number;
                }
                if ($request->age) {
                    $user->age = $request->age;
                }
                if ($request->profile_image) {
                    $user->profile_image = $path;
                }
                if ($request->gender) {
                    $user->gender = $request->gender;
                }
                if ($request->age) {
                    $user->role_as = $request->role_as;
                }
                if ($request->address) {
                    $user->address = $request->address;
                }

                $user->save();

                return $this->apiResponse($user, 'success', 200);
            }
            return $this->apiResponse('', 'No user with this id', 200);
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

            $user = UserClass::get(auth()->user()?->id);

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

    function myPlans()
    {
        try {

            $user = User::find(auth()->user()->id);
            if ($user) {
                return $this->apiResponse($user->subscriptions, 'success', 200);
            } else {
                return $this->apiResponse('', 'No user with this id', 400);
            }
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

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
