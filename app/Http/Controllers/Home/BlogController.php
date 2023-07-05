<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function AllBlog(){

        $blog = Blog::latest()->get();

        return view('admin.blog.blog_all',compact('blog'));

    }//end methode

    public function AddBlog(){

        //ici on envoie tous la data de blog_category avec ordre croissant selon la categoty
        $category = BlogCategory::orderBy('blog_category','ASC')->get();

        //et on la fait passer par un compact comme dhab
        return view('admin.blog.blog_add',compact('category'));
        
    }//end methode

    
    public function StorBlog(Request $request){

        
        $request->validate([
            'title' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'image' => 'required',
            'category_id' => [
                'required',
                Rule::notIn(['Choose one Category']),//npublie pas de lajouter en haut --> use Illuminate\Validation\Rule;
            ],
        ],[
            'tags.required' => 'Le tag du Portfolio est obligatoire !!!',
            'title.required' => 'Le titre du Portfolio est obligatoire !!!',
            'description.required' => 'La description du Portfolio est obligatoire !!!',
            'image.required' => 'Limage du Portfolio est obligatoire !!!',
        ]);

        $images = $request->file('image');
            
        $image_name = hexdec(uniqid()).'.'.$images->getClientOriginalExtension();    

        Image::make($images)->resize(850,430)->save('upload/blog_image/'.$image_name);        
                
        $save_url = 'upload/blog_image/'.$image_name;    
                
        Blog::insert([
            'blog_title' => $request->title,
            'blog_tags' => $request->tags,
            'blog_category_id' => $request->category_id,
            'blog_description' => $request->description,
            'blog_image' => $save_url,
            'created_at'  => Carbon::now(),
        ]);        
            
        $notification = array(
            'message' => 'Your BLOG Added Successfully', 
            'alert-type' => 'success'
        );
       
        return redirect()->route('all.blog')->with($notification);
        
    }//end methode

    public function EditBlog($id){

        $category = BlogCategory::orderBy('blog_category','ASC')->get();
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit_blog',compact('blog','category'));
    }//end methode

    public function UpdateBlog(Request $request){

        //noublie pas de refaire la validation
        $request->validate([
            'title' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ],[
            
            'tags.required' => 'Le tag du Portfolio est obligatoire !!!',
            'title.required' => 'Le titre du Portfolio est obligatoire !!!',
            'description.required' => 'La description du Portfolio est obligatoire !!!',
        ]);

        $blog_id = $request->id;

        $image = $request->file('image');

        if($image){

            $del_image = Blog::findOrFail($blog_id)->blog_image;

            unlink($del_image);

            $name_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    
            Image::make($image)->resize(850,430)->save('upload/blog_image/'.$name_image);
            
            $save_url = 'upload/blog_image/'.$name_image;
            
            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->category_id,
                'blog_title' => $request->title,
                'blog_tags' => $request->tags,
                'blog_description' => $request->description,
                'blog_image' => $save_url,
            ]);
        }
        else{

            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->category_id,
                'blog_title' => $request->title,
                'blog_tags' => $request->tags,
                'blog_description' => $request->description,
            ]);

        }

        $notification = array(
            'message' => 'BLOG Updated Successfully', 
            'alert-type' => 'info'
        );
        
        return redirect()->route('all.blog')->with($notification);
    }//end methode

    public function DeleteBlog($id){

        
        $blog = Blog::findOrFail($id);
       
        $img = $blog->blog_image;

        unlink($img);
        
        Blog::findOrFail($id)->delete();

        $notification = array(
            'message' => 'BLOG Deleted Successfully', 
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }//end methode

    public function DetailsBlog($id){

        //->limit(5) pour limiter lafficage des blogs aux 5 derniers c'est tout
        $all_blog = Blog::latest()->limit(4)->get();

        $blog = Blog::findOrFail($id);

        $category = BlogCategory::orderBy('blog_category','ASC')->get();

        return view('frontend.blog_details',compact('blog','all_blog','category'));
    }//end methode

    public function CategoryBlog($id){
        
        //tu ne retourne que les blog avec la categorie demandé par lutilisateur càd il faut que les 2 id matchent entre eux avec la pagination qui va avec bien sur
        $blog_post = Blog::where('blog_category_id',$id)->orderBy('id','DESC')->paginate(3);

        $category = BlogCategory::orderBy('blog_category','ASC')->get();

        $all_blog = Blog::latest()->limit(5)->get();

        //la var $category_name est faite pour etre utiliser pour pouoir afficher le nom de la category actuelle et vu que la category matches avec le blog c'est pour ca qu'on utilise le $id du blog car c'st les memes !!
        //est ce qu'on pouvait faire autrement genre utiliser la variable $blog_post qui contient la condition adéquate ?? je ne sais pas peutetre a voir dans le futur
        $category_name = BlogCategory::findOrFail($id);

        return view('frontend.cat_blog_details',compact('blog_post','category','all_blog','category_name'));

    }//end methode

    public function HomeBlog(){

        //pour recuperer tous les blogs mais seulement 3 par paginations
        $blog = Blog::latest()->paginate(3);

        //pour afficher les 5 derniers blogs à droite
        $all_blog = Blog::latest()->limit(5)->get();

        //pour afficher les categories à droite
        $category = BlogCategory::orderBy('blog_category','ASC')->get();

        return view('frontend.blogs',compact('blog','all_blog','category'));

    }//end methode

    public function SearchBlog(Request $request){
        $title = $request->search;
        $blog = Blog::where('blog_title','LIKE','%'.$title.'%')->orderBy('id','DESC')->paginate(3);

        $all_blog = Blog::latest()->limit(5)->get();
        $category = BlogCategory::orderBy('blog_category','ASC')->get();

        return view('frontend.blogs',compact('blog','all_blog','category'));
    }//end methode
}
