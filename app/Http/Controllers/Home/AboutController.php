<?php

namespace App\Http\Controllers\Home;
use App\Models\About;
use App\Models\MultiImage;
use Image;

use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function AboutPage(){

        $about = About::find(1);
        return view('admin.about.about_page__all',compact('about'));

    }//end méthode

    public function UpdateAbout(Request $request){

        $request->validate([
            'title' => 'required',
            'short_title' => 'required',
        ],[
            
            'title.required' => 'Le titre est obligatoire !!!',
            'short_title.required' => 'Le short title est obligatoire !!!',
        ]);

        $about_id = $request->id;

        if($request->file('pdf')){
            
            //tu recupere ton pdf via le request dans la var $pdf
            $pdf =$request->file('pdf');

            //tu genere un nom à ton pdf et tu le mets dans la var $name_pdf
            $name_pdf = hexdec(uniqid()).'.'.$pdf->getClientOriginalExtension();

            //tu stock ton pdf dans le dossier publi\CV à l'iterieur de ton storage
            $chemin_pdf = $pdf->storeAs('CV',$name_pdf,'public');

            if($request->file('about_image')){

                $del_image = About::findOrFail($about_id)->about_image;

                unlink($del_image);

                $image = $request->file('about_image');
               
                $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
               
                Image::make($image)->resize(523,605)->save('upload/update_image/'.$image_gen);
               
                $save_url = 'upload/update_image/'.$image_gen;
                
                About::findOrFail($about_id)->update([
                    'title' => $request->title,
                    'short_title' => $request->short_title,
                    'short_description' => $request->short_description,
                    'long_description' => $request->long_description,
                    'about_image' => $save_url,
                    'about_pdf' => $chemin_pdf,
                    
                ]);

            }else{   

                About::findOrFail($about_id)->update([
                    'title' => $request->title,
                    'short_title' => $request->short_title,
                    'short_description' => $request->short_description,
                    'long_description' => $request->long_description,
                    'about_pdf' => $chemin_pdf,
                ]);
            }
        }else{

            if($request->file('about_image')){


                $del_image = About::findOrFail($about_id)->about_image;

                unlink($del_image);
                
                $image = $request->file('about_image');
               
                $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
               
                Image::make($image)->resize(523,605)->save('upload/update_image/'.$image_gen);
               
                $save_url = 'upload/update_image/'.$image_gen;
                
                About::findOrFail($about_id)->update([
                    'title' => $request->title,
                    'short_title' => $request->short_title,
                    'short_description' => $request->short_description,
                    'long_description' => $request->long_description,
                    'about_image' => $save_url,
                ]);

            }else{   

                About::findOrFail($about_id)->update([
                    'title' => $request->title,
                    'short_title' => $request->short_title,
                    'short_description' => $request->short_description,
                    'long_description' => $request->long_description,
                ]);
            }
        }
        
        $notification = array(
            'message' => 'About Page Updated Successfully', 
            'alert-type' => 'info'
        );
    
        return redirect()->back()->with($notification);

        

    }//end méthode

    public function DownloadCV(){
        $cv = About::find(1);
        return Storage::download('public/'.$cv->about_pdf);
    }

    public function HomeAbout(){
        $aboutpage = About::find(1);
        return view('frontend.about_page',compact('aboutpage'));
    }

    public function AboutMultiImage(){
        return view('admin.about.multi_image');
    }//end méthode

    public function StoreMultiImage(Request $request){
        
        //d'abord tu recupere l'image
        if($images = $request->file('multi_image')){

            $nbr = 0;

            foreach($images as $multi_image){ $nbr++; }

            if(MultiImage::count() + $nbr > 7){
                $notification = array
                (
                    'message' => 'il ne peux y avoir que 7 images maximum', 
                    'alert-type' => 'warning'
                );

                return redirect()->route('all.multi.image')->with($notification);

            }     

            //ensuite tu boucles sur tes images car y'en a plusieurs
            foreach($images as $multi_image){

                //tu genere un nom pour ton image
                $image_gen = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();
            
                //tu ajuste la taille de ton image et tu l'enregistre avec son nom dans ta BDD
                Image::make($multi_image)->resize(220,220)->save('upload/multi_image/'.$image_gen);
            
                //tu enregistre ton image dans ton dossier public
                $save_url = 'upload/multi_image/'.$image_gen;
                
                //petit changement ici on utilise la methode insert et pas update car tu vas inserer plusieurs images et pas modifier
                MultiImage::insert([
                    'multi_image' => $save_url,
                    'created_at'  => Carbon::now(),//noublie pas que pour utiliser ca tu dois --> use Illuminate\Support\Carbon; en haut !!!
                ]);

            }
            $notification = array(
                'message' => 'Your Multi Images Updated Successfully', 
                'alert-type' => 'success'
            );
        }
        else{
            $notification = array(
                'message' => 'Nothing added', 
                'alert-type' => 'info'
            );
        }
        
        return redirect()->route('all.multi.image')->with($notification);

    }//end méthode

    public function AllMultiImage(){
        $AllMultiImage = MultiImage::all();
        return view('admin.about.all_multi_image',compact('AllMultiImage'));
    }//end méthode

    public function EditMultiImage($id){
        $multi_image = MultiImage::findOrFail($id);
        return view('admin.about.edit_multi_image',compact('multi_image'));
    }//end méthode

    public function UpdateMultiImage(Request $request){

        $multi_image_id = $request->id;

        if($image = $request->file('multi_image')){

            $del_image = MultiImage::findOrFail($multi_image_id)->multi_image;

            unlink($del_image);

            $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        
            Image::make($image)->resize(220,220)->save('upload/multi_image/'.$image_gen);
            
            $save_url = 'upload/multi_image/'.$image_gen;
            
            MultiImage::findOrFail($multi_image_id)->update([
                'multi_image' => $save_url,
            ]);

        }

        $notification = array(
            'message' => 'IMAGE Updated Successfully', 
            'alert-type' => 'info'
        );
        return redirect()->route('all.multi.image')->with($notification);
    }//end méthode

    public function DeleteMultiImage($id){

        //d'abord tu vas chercher la ligne specifique dans la BDD
        $multi = MultiImage::findOrFail($id);

        //ensuite tu vas recuperer le nom de ton image et le chemin ou elle est stocker grace à la commande precedente
        $img = $multi->multi_image;

        //ensuite tu vire cette image de ton dossir dans piblic
        unlink($img);

        //enfin tu supprime la ligne de ta BDD
        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'IMAGE Deleted Successfully', 
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
