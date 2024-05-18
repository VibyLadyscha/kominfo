<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PostHistory;
use App\Models\Post;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $user = User::find($id);
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // read data untuk validasi user
        $user = User::find($id);

        // validasi form
        $this->validate($request, [
            'username' => 'nullable|min:6|unique:users,username,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // jika user input image
        if ($request->hasFile('profile_picture')) {
            $image = $request->profile_picture;
            $new_image = time() . $image->getClientOriginalName();
            $user->profile_picture = 'public/uploads/profiles/' . $new_image;

            // memindahkan image ke folder public/uploads/profiles
            $image->move('public/uploads/profiles/', $new_image);
        }

        // jika user memilih checkbox remove image
        if ($request->remove_image) {
            //hapus image dari folder
            Storage::delete($user->profile_picture);

            $user->profile_picture = null;
        }

        $user->update([
            'username' => $request->username,
            'profile_picture' => $user->profile_picture,
        ]);

        // jika tidak ada perubahan pada profile (tidak ada input apapun dan tidak menceklis checkbox)
        if (!$request->username && !$request->hasFile('profile_picture') && !$request->remove_image) {
            return redirect()->route('profile.show', Auth::user()->id)->with('warning', 'No changes were made');
        }

        return redirect()->route('profile.show', Auth::user()->id)->with('success', 'Profile updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // validasi user dan post history
        $user = User::find($id);
        $post_histories = PostHistory::find($user->id);

        // hapus post yang terkait dengan post_history ini
        foreach ($post_histories as $post_history) {
            $posts = Post::where('user_id', $user->id)->where('post_history_id', $post_history->id)->delete();
        }

        // hapus image dari folder
        Storage::delete($user->profile_picture);

        // hapus komentar user
        $user->comments()->delete();

        // // hapus posts yang terkait dengan post_history ini
        // $posts = Post::where('user_id', $user->id)->where('post_histories_id', $post_histories->id)->delete();

        // kemudian hapus post_history ini
        $post_histories->delete();
        // // MASIH ERROR CUYYY

        // hapus user
        $user->delete();

        return redirect()->route('/login')->with('success', 'Account deleted successfully');
    }
}
