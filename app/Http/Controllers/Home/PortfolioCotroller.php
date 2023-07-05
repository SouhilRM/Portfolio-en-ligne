<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class PortfolioCotroller extends Controller
{
    public function AllPortfolio(){

        /*
            dans les controller precedent tel que about on se contenter de renvoyer que la premiere ligne comme data --> $about = About::find(1); car il n'y avait qu'une seule ligne dans la BDD 
            mais avec le controleur Portfolio on aura plusieurs controleur et pas seulement qu'un seul donc on recupere toutes la data -->  $portfolio = Portfolio::latest()->get();
        */
        $portfolio = Portfolio::latest()->get();

        return view('admin.portfolio.portfolio_all',compact('portfolio'));

    }//end methode

    public function AddPortfolio(){
        return view('admin.portfolio.portfolio_add');
        
    }//end methode

    public function StorPortfolio(Request $request){

        //faisons un peu de validation
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
        ],[
            //ici tu customize tes messages de validations ??
            'name.required' => 'Le nom du Portfolio est obligatoire !!!',
            'title.required' => 'Le titre du Portfolio est obligatoire !!!',
            'description.required' => 'La description du Portfolio est obligatoire !!!',
            'image.required' => 'Limage du Portfolio est obligatoire !!!'
        ]);

        $images = $request->file('image');
            
        $image_name = hexdec(uniqid()).'.'.$images->getClientOriginalExtension();    

        Image::make($images)->resize(1020,616)->save('upload/portfolio_image/'.$image_name);
                
        $save_url = 'upload/portfolio_image/'.$image_name;    
                
        Portfolio::insert([
            'portfolio_name' => $request->name,
            'portfolio_title' => $request->title,
            'portfolio_description' => $request->description,
            'portfolio_image' => $save_url,
            'created_at'  => Carbon::now(),
        ]);        
            
        $notification = array(
            'message' => 'Your Portfolio Added Successfully', 
            'alert-type' => 'success'
        );
       
        return redirect()->route('all.portfolio')->with($notification);
        
    }//end methode

    public function EditPortfolio($id){
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolio.edit_portfolio',compact('portfolio'));
    }//end methode

    public function UpdatePortfolio(Request $request){

        //noublie pas de refaire la validation
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
        ],[
            //ici tu customize tes messages de validations ??
            'name.required' => 'Le nom du Portfolio est obligatoire !!!',
            'title.required' => 'Le titre du Portfolio est obligatoire !!!',
            'description.required' => 'La description du Portfolio est obligatoire !!!',
        ]);

        $portfolio_id = $request->id;

        $image = $request->file('image');

        if($image){

            $del_image = Portfolio::findOrFail($portfolio_id)->portfolio_image;

            unlink($del_image);

            $name_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    
            Image::make($image)->resize(1020,616)->save('upload/portfolio_image/'.$name_image);
            
            $save_url = 'upload/portfolio_image/'.$name_image;
            
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->name,
                'portfolio_title' => $request->title,
                'portfolio_description' => $request->description,
                'portfolio_image' => $save_url,
            ]);
        }

        else{

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->name,
                'portfolio_title' => $request->title,
                'portfolio_description' => $request->description,
            ]);
        }

        $notification = array(
            'message' => 'PORTFOLIO Updated Successfully', 
            'alert-type' => 'info'
        );
        return redirect()->route('all.portfolio')->with($notification);
    }//end methode

    public function DeletePortfolio($id){

        //d'abord tu vas chercher la ligne specifique dans la BDD
        $portfolio = Portfolio::findOrFail($id);

        //ensuite tu vas recuperer le nom de ton image et le chemin ou elle est stocker grace à la commande precedente
        $img = $portfolio->portfolio_image;

        //ensuite tu vire cette image de ton dossir dans piblic
        unlink($img);

        //enfin tu supprime la ligne de ta BDD
        Portfolio::findOrFail($id)->delete();

        $notification = array(
            'message' => 'PORTFOLIO Deleted Successfully', 
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }//end methode

    public function DetailsPortfolio($id){

        $portfolio = Portfolio::findOrFail($id);
        return view('frontend.portfolio_details',compact('portfolio'));

    }//end methode

    public function HomePortfolio(){
        $portfolio = Portfolio::latest()->paginate(4);
        return view('frontend.portfolio',compact('portfolio'));
    }
}
