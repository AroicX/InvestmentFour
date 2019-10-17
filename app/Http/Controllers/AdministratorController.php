<?php

namespace App\Http\Controllers;

use App\Blog;
use Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Facades\Purifier;

class AdministratorController extends Controller
{

	public function Up()
	{
		\Artisan::call('up');

		$notification = array('message' => 'Site is up','alert' => 'success' );
			return redirect()->back()->with($notification);
	}
	public function Down()
	{
		\Artisan::call('down');

		$notification = array('message' => 'Site is down','alert' => 'danger' );
			return redirect()->back()->with($notification);
	}
	
	public function CheckForMaintance()
	{
		// $check = file_exists('./storage/framework/down');
		$check = Storage::exists('/framework/down');
		return response()->json($check);
	}

    public function createBlog(Request $request)
    {
		 if ($request->image) {    
		       $image = $request->file('image');
			   $filename = time(). '.' . $image->getClientOriginalExtension();
			   $blog = new Blog;
			   $blog->application_id = 1;
			   $blog->title = $request->title;
			   $blog->image = $filename;
			   $blog->content = Purifier::clean($request->content);
			   $blog->save();
			   if($blog){
				    $image->move('storage/blog', $filename);
			   }
				$notification = array('message' => $request->title.' has been added','alert' => 'success' );
				return redirect()->back()->with($notification);

		    //    return redirect()->back();
		      
	  
	     }else{
			$notification = array('message' => 'Please add an image to contiune','alert' => 'warning' );
			return redirect()->back()->with($notification);
	     }

            
       // return Purifier::clean($request->all());
	
	}

	public function updateBlog(Request $request)
	{
	
		$id = $request->id;

		if ($request->image) {    

			$image = $request->file('image');
			$filename = time(). '.' . $image->getClientOriginalExtension();
			

			$data = array(
				'title' => $request->title,
				'content' => Purifier::clean($request->content),
				'image' => $filename,
			);

			$posting = Blog::where('id','=',$id)->update($data);

			if($posting){
				$image->move('storage/blog', $filename);
		   }

			$notification = array('message' => $request->title.' has been updated ','alert' => 'success' );
			return redirect()->back()->with($notification);
			
   
	  }else{
		 
		$data = array(
			'title' => $request->title,
			'content' => Purifier::clean($request->content),
		);

		$posting = Blog::where('id','=',$id)->update($data);

		if($posting){
			$notification = array('message' => $request->title.' has been updated ','alert' => 'success' );
			return redirect()->back()->with($notification);
	   }

		
		
	  }

	
	}
	
	public function PostBlog()
	{
		$posts = Blog::where('active', '=',1)->get();
		$drafts = Blog::where('active', '=',0)->get();

		return view('admin.blog.manage',compact('posts','drafts'));
	}

	public function editPost($id = null)
	{
		$post = Blog::where('id','=',$id)->first();
	
		return view('admin.blog.edit',compact('post'));
		
		
		
	}

	public function draftPost($id = null)
	{

		$post = Blog::where('id','=',$id)->first();
		$blog = Blog::where('id','=',$id)->update(['active' => 0]);
		if($blog){
			$notification = array('message' => $post->title.' has been drafted ...','alert' => 'success' );
			return redirect()->back()->with($notification);
		}else{
			$notification = array('message' =>  'Server Error','alert' => 'danger' );
			return redirect()->back()->with($notification);
		}
	}

	public function deletePost($id = null)
	{
		$blog = Blog::where('id','=',$id)->delete();
		if($blog){
			$notification = array('message' => 'Deleted Successfully ...','alert' => 'success' );
			return redirect()->back()->with($notification);
		}else{
			$notification = array('message' =>  'Server Error','alert' => 'danger' );
			return redirect()->back()->with($notification);
		}
		
	}
	
	
}