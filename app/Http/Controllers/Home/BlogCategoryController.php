<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;

class BlogCategoryController extends Controller
{
    public function AllCategory(){

        $bloc_category = BlogCategory::latest()->get();

        return view('admin.bloc_category.bloc_category_all',compact('bloc_category'));

    }//end methode

    public function AddCategory(){
        return view('admin.bloc_category.bloc_category_add');
        
    }//end methode


    public function StorCategory(Request $request){

        //faisons un peu de validation
        $request->validate([
            'blog_category' => 'required',
            
        ],[
            //ici tu customize tes messages de validations ??
            'blog_category.required' => 'veillez preciser le nom de votre category SVP !!',
        ]);

        
                
        BlogCategory::insert([
            'blog_category' => $request->blog_category,
        ]);        
            
        $notification = array(
            'message' => 'Your Category Added Successfully', 
            'alert-type' => 'success'
        );
       
        return redirect()->route('all.category')->with($notification);
        
    }//end methode

    public function EditCategory($id){
        $blog_category = BlogCategory::findOrFail($id);
        return view('admin.bloc_category.edit_bloc_category',compact('blog_category'));
    }//end methode

    public function UpdateCategory(Request $request){

        
        $request->validate([
            'blog_category' => 'required',
            
        ],[
            
            'blog_category.required' => 'veillez preciser le nom de votre category SVP !!',
        ]);

        $blog_category_id = $request->id;

        BlogCategory::findOrFail($blog_category_id)->update([
            'blog_category' => $request->blog_category,
            
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully', 
            'alert-type' => 'info'
        );
        return redirect()->route('all.category')->with($notification);
    }//end methode

    public function DeleteCategory($id){

        $blogs = Blog::latest()->get();

        $categorie_id = BlogCategory::findOrFail($id)->id;

        foreach($blogs as $blog){

            if($blog->blog_category_id == $categorie_id){

                $notification = array(
                    'message' => 'suprimez dabord les blogs liés à cette catégorie !!!!', 
                    'alert-type' => 'warning'
                    );
                return redirect()->back()->with($notification);
            }
        }

        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
            
        
    }//end methode
}
