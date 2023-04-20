<?php

namespace App\Http\Controllers\api\user;


use App\classes\user\UserClass;
use App\Http\Controllers\Controller;
use App\Models\user;
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

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function index(){
        try {

            $users=UserClass::getAll();
            return $this->apiResponse($users,'success',200);
        }catch (\Exception $e){
            return $this->apiResponse('',$e->getMessage(),400);
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
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,50',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'phone_number' => 'required|string|unique:users|starts_with:01|max_digits:11',
            'country' => 'required|string',
            'age' => 'required|integer',
            'gender' => 'required|digits_between:0,1',
            'address' => 'nullable|string',
            'profile_image' => 'required|image',
            'role_as' => ['required', 'integer', Rule::in([0, 1, 2])],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $image = $request->file('profile_image');
        $path = $image->store('images/users/profileImages', ['disk' => 'public']);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'country' => $request->country,
            'address' => $request->address,
            'age' => $request->age,
            'gender' => $request->gender,
            'role_as' => $request->gender,
            'profile_image' => 'storage/' . $path,
        ]);
        return response()->json([
            'data' => $user,
            'message' => 'User successfully registered',
        ], 200);
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

    function myOrders(){
        try {

            $user=User::find(auth()->user()->id);
            if ($user){
                return $this->apiResponse($user->purchases, 'success', 200);
            }else{
                return $this->apiResponse('', 'No user with this id', 400);
            }
        }catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
    function myCart(){
        try {

            $user=User::find(auth()->user()->id);
            if ($user){
                return $this->apiResponse($user->cart, 'success', 200);
            }else{
                return $this->apiResponse('', 'No user with this id', 400);
            }
        }catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
    function myWishList(){
        try {

            $user=User::find(auth()->user()->id);
            if ($user){
                return $this->apiResponse($user->wishList, 'success', 200);
            }else{
                return $this->apiResponse('', 'No user with this id', 400);
            }
        }catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
    function myPlans(){
        try {

            $user=User::find(auth()->user()->id);
            if ($user){
                return $this->apiResponse($user->subscriptions, 'success', 200);
            }else{
                return $this->apiResponse('', 'No user with this id', 400);
            }
        }catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
    function coach(){
        try {

            $user=User::with('coach')->find(auth()->user()->id);
            if ($user){
                return $this->apiResponse($user, 'success', 200);
            }else{
                return $this->apiResponse('', 'No user with this id', 400);
            }
        }catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
}
