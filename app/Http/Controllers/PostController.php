<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller

{

    public function __construct()
{
    $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index','show']]);
    $this->middleware('permission:post-create', ['only' => ['create','store']]);
    $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:post-delete', ['only' => ['destroy']]);
}


  public function index(Request $request)
  {
      if ($request->has('search')) {
          $posts = Post::where('title', 'like', '%' . $request->search . '%')
                       ->orWhere('description', 'like', '%' . $request->search . '%')
                       ->latest()
                       ->paginate(10);
      } else {
          $posts = Post::latest()->paginate(10);
      }
  
      return view('posts.index', compact('posts'));
  }

public function create()

{

$user = auth()->user();

return view('posts.create', compact('user'));

}

public function store(Request $request)

{

$user = auth()->user();

$request->validate([

'title' => 'required',

'description' => 'required',

'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

]);

$imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();

// Skip creating the intermediate folder structure

Storage::disk('public')->putFileAs('post_images', $request->file('image'), $imageName);

$input = $request->except('image');

$input['image_path'] = public_path('post_images') . '/' . $imageName;

$input['user_id'] = $user->id;

Post::create($input);

return redirect()->route('posts.index')

->with('success', 'Post created successfully');

}

public function show(Post $post)
{
  $user = User::find($post->user_id);
  $createdAt = $post->created_at;

  // Replace '/post_images' with the actual path to your image folder
  $imagePath = public_path('/post_images/' . $post->image_path);

  // Extract the filename from the image path
  $filename = basename($imagePath);

  // Generate the image URL using the filename
  $imageUrl = asset('/storage/post_images/' . $filename);

  // Return the image URL to the blade view
  return view('posts.show', compact('post', 'user', 'imageUrl', 'createdAt'));
}


public function edit(Post $post)

{

$user = User::find($post->user_id);

return view('posts.edit', compact('post', 'user'));

}

public function update(Request $request, Post $post)

{

$request->validate([

'title' => 'required',

'description' => 'required',

'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

]);

if ($request->hasFile('image')) {

$oldImagePath = $post->image_path;

// Skip creating the intermediate folder structure

Storage::disk('public')->putFileAs('post_images', $request->file('image'), $imageName);

Storage::disk('public')->delete($oldImagePath);

} else {

$imageName = $post->image_path;

}

$input = $request->except('image');

$input['image_path'] = $imageName;

$post->update($input);

return redirect()->route('posts.index')

->with('success', 'Post updated successfully');

}

public function destroy(Post $post)
{
    $oldImagePath = $post->image_path;

    if ($oldImagePath) {
        Storage::disk('public')->delete($oldImagePath);
    }

    $post->delete();

    return redirect()->route('posts.index')
        ->with('success', 'Post deleted successfully');
}


}
