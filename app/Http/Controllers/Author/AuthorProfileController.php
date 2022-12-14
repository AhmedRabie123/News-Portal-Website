<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Author;
use Hash;
use Auth;

class AuthorProfileController extends Controller
{
    public function author_edit_profile()
    {
        return view('Author.profile');
    }

    public function author_profile_submit(Request $request)
    {

        $author_data = Author::where('email', Auth::guard('author')->user()->email)->first();

        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('authors')->ignore($author_data->id)
            ]

        ]);

        if ($request->password != '') {
            $request->validate([
                'password' => 'required',
                'retype_password' => 'required|same:password'
            ]);

            $author_data->password = Hash::make($request->password);
        }


        if ($request->hasFile('photo')) {

            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);


            if (file_exists(public_path('uploads/' . $author_data->photo)) && $author_data->photo != NULL) {
                unlink(public_path('uploads/' . $author_data->photo));
            }

            // if ($author_data->photo != NULL) {
            //     unlink(public_path('uploads/' . $author_data->photo));
            // }


            $now = time();
            $ext = $request->file('photo')->extension();
            $final_name = 'author_photo_' . $now . '.' . $ext;
            $request->file('photo')->move(public_path('uploads/'), $final_name);

            $author_data->photo = $final_name;
        }

        $author_data->name = $request->name;
        $author_data->email = $request->email;
        $author_data->token = '';
        $author_data->update();


        return redirect()->route('author_home')->with('success', 'Information Is Updated Successfully.');
    }
}
