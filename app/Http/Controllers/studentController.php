<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function showHomePage()
    {
        return view('welcome');
    }

    public function showStudentsList()
    {
        $students = DB::table('students')->get();
        return view('studentsList', ['data' => $students]);
    }

    public function addStudentPage()
    {
        return view('addStudents');
    }

    public function addNewStudent(Request $req)
    {
        $req->validate([
            'image' => 'required|mimes:png,jpg,jpeg|max:3000',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'age' => 'required|integer',
            'address' => 'required|string|max:255',
        ]);
        //using store
        $path = $req->file('image')->store('images','public');

        //using storeAS
        //$fileName = $file->getClientOriginalName();
        //$fileName = time().'_'.$file->getClientOriginalName();
        //$path = $req->image->storeAs('images',$filename,'public');

        $user = DB::table('students')->insert([
            'name' => $req->name,
            'email' => $req->email,
            'age' => $req->age,
            'address' => $req->address,
            'file' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($user) {
            return redirect()->route('ShowStudents')->with('success', 'Inserted successfully');
        } else {
            return redirect()->route('ShowStudents')->with('error', 'Insertion failed');
        }
    }

    public function deleteUser(string $id)
    {
        $user= DB::table('students')->where('id', $id)->first();
        $image_path = public_path("storage/").$user->file;
        if(file_exists($image_path))
        {
            @unlink($image_path);
        }
        $user2 = DB::table('students')->where('id', $id)->delete();

        if ($user2) {
            return redirect()->route('ShowStudents')->with('success', 'Deleted successfully');
        } else {
            return redirect()->route('ShowStudents')->with('error', 'Deletion failed');
        }
    }

    public function updateUserPage(string $id)
    {
        $user = DB::table('students')->where('id', $id)->first();
        return view('updatePage', ['user' => $user]);
    }


    public function updateStudent(Request $req, string $id)
    {
        $user = DB::table('students')->where('id', $id)->first();

        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'age' => 'required|integer',
            'address' => 'required|string|max:255',
            'image' => 'sometimes|mimes:png,jpg,jpeg|max:3000'
        ]);

        $updateData = [
            'name' => $req->name,
            'email' => $req->email,
            'age' => $req->age,
            'address' => $req->address,
            'updated_at' => now(),
        ];

        // Check if an image file is uploaded
        if ($req->hasFile('image')) {
            // Delete the old image
            $image_path = public_path("storage/") . $user->file;
            if (file_exists($image_path)) {
                @unlink($image_path);
            }

            // Store the new image
            $path = $req->file('image')->store('images', 'public');
            $updateData['file'] = $path;
        }

        $user2 = DB::table('students')->where('id', $id)->update($updateData);

        if ($user2) {
            return redirect()->route('ShowStudents')->with('success', 'Updated successfully');
        } else {
            return redirect()->route('ShowStudents')->with('error', 'Update failed');
        }
    }


}
