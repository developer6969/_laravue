<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use App\User; 
use Validator;

class UserController extends Controller
{

    public $successStatus = 200;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }



    /** 
     * Login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }


    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], $this-> successStatus); 
    }

    /** 
     * Details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isStaff')) {
            // The current user can update the post...
            return User::latest()->paginate(10);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validateNewData();
        return User::create([
            'name' => $request['name'],
            'mobile' => $request['mobile'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type' => $request['type'],
            'bio' => $request['bio'],
            'photo' => $request['photo'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function fetchProfile() {
        return auth('api')->user();
    }

     public function updateProfile(Request $request) {
        // Fetch existing user object from db
        $user = auth('api')->user();
        
        // Validate form data AUTHENTICATION
        $this->validateUpdatedData($user);

        // Assert whether user changed photo
        $currentPhoto = $user->photo;
        if($request->photo != $currentPhoto){
            // Extract file extension
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            // Convert Base64 to image
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            // Update photo name in request
            $request->merge(['photo' => $name]);
            // Delete old photo
            $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }

        // Request password field is EMPTY
        if(empty($request->password)){
            $request->merge(['password' => $user->password]);
        } else { // User CHANGED PASSWORD
            $this->validatePassword();
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        // Write to DATABASE
        $user->update($request->all());
        // Return success message
        return ['message' => "Success"];
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
        $user = User::findOrFail($id);
        $this->validateUpdatedData($user);
        $user->update($request->all());
        return ['message' => 'User Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        $user->delete();
        return ['message' => 'User Deleted'];
    }

    protected function validateNewData() 
    {
        return request()->validate([
            'name' => 'required|string|max:191',
            'mobile' => 'required|digits:10',
            'email' => 'bail|required|unique:users|max:255|email',
            'password' => 'required|string|min:8',
            'type' => 'required|string|max:50',
            'bio' => 'string|max:255',
        ]);
    }

    // $user->id , this will allow current user with same emailid to update
    protected function validateUpdatedData($user) 
    {
        return request()->validate([
            'name' => 'required|string|max:191',
            'mobile' => 'required|digits:10',
            'email' => 'bail|required|max:255|email|unique:users,email,'.$user->id,
            'bio' => 'sometimes|required|string|max:255',
            'photo' => 'string|sometimes',
        ]);
    }

    protected function validatePassword() 
    {
        return request()->validate([
            'password' => 'sometimes|required|min:8'
        ]);
    }

    public function search(){
        if ($search = \Request::get('q')) {
            $users = User::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%")
                        ->orWhere('email','LIKE',"%$search%");
            })->paginate(5);
        }else{
            $users = User::latest()->paginate(5);
        }
        return $users;
    }
}