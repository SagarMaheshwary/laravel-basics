<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ProfileController
    |--------------------------------------------------------------------------
    | This controller will be responsible for updating user profile.
    |
    */


    /**
     * PHP magic method that runs when the
     * class instance is created.
     * 
     * @return void
     */
    public function __construct(){

        /**
         * Only authenticated users may access 
         * all the methods.
         */
        $this->middleware('auth');
        
    }


    /**
     * Show the profile update form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('user.profile');
    }

    /**
     * Update user profile.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

        //validation
        $rules = [
            'name'     => 'required|string|min:3|max:191',
            'email'    => 'required|email|min:3|max:191',
            'password' => 'nullable|string|min:5|max:191',
            'image'    => 'nullable|image|max:1999', //formats: jpeg, png, bmp, gif, svg
        ];
        $request->validate($rules);

        //Update the user.
        $user = Auth::user(); //we want to update the authenticated user.
        $user->name = $request->name;
        $user->email = $request->email;
        
        //check for file.
        if($request->hasFile('image')){
            //upload the image.
            $image = $this->uploadImage($request);

            //delete the previous image.
            Storage::delete("public/pics/{$user->image}");
            
            //this column has a default value so don't to set it empty.
            $user->image = $image;
        }
        
        //if password field is left empty then don't update the password.
        if($request->password){
            $user->password = Hash::make($request->password); //set the hashed password.
        }

        $user->save();

        return redirect()
            ->route('profile.index')
            ->with('status','Your profile has been updated!');
    }

    /**
     * Upload the user profile image and return the uploaded
     * image name.
     * 
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    private function uploadImage(Request $request){
        //get the filename with extension
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
        //get just extension
        $extension = $request->file('image')->getClientOriginalExtension();
        //filename to store
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        //upload the image
        $request->file('image')->storeAs('public/pics',$filenameToStore);

        return $filenameToStore;
    }
}
