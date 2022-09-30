<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Image;

class HomeSliderController extends Controller
{
    public function HomeSlider(){

        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all',compact('homeslide'));

    }//end méthode

    public function UpdateSlider(Request $request){
        //un peu de validation
        $request->validate([
            'title' => 'required',
            'short_title' => 'required',
        ],[
            
            'title.required' => 'Le title est obligatoire !!!',
            'short_title.required' => 'Le short_title est obligatoire !!!',
        ]);

        //c'est l'id que tu as recuperer de ton inputhidden
        $slide_id = $request->id;

        if($request->file('home_slide')){ //SI l'utilisateur à uploder une image 

            //d'abord tu stoque cette image dans une variable $îmage
            $image = $request->file('home_slide');

            //ensuite tu suprimme l'ancienne image
            $del_image = HomeSlide::findOrFail($slide_id)->home_slide;
            unlink($del_image);

            //ensuite tu génère un nom à ton image que tu vas stoque dans une variable $image_gen
            //hexdec(uniqid()) : c'est pour generer un id en hexadecimal qui sera unique au nom de l'image
            //getClientOriginalExtension() : c'est pour avoir l'extension de ton iamage ( .png, .jpg, ...etc )
            $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            //ensuite tu redimensionne ton image ET tu la stoque dans ton fichier public
            Image::make($image)->resize(636,852)->save('upload/home_slide/'.$image_gen);

            //tu ajoute le chemin à ton nom pour qu'il soit dans ta BDD
            $save_url = 'upload/home_slide/'.$image_gen;

            //maintenant tu peux enfin udate ta BDD
            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => $save_url,
            ]);

            
        }
        else{   //SI l'utilisateur ne uploder pas de image !!!
            
            //tu fais tout pareil sauf la partie image t'en a pas besoin

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
            ]);

            
        }

        //enfin tu notifie le changement
        $notification = array(
            'message' => 'Home Slider Updated Successfully', 
            'alert-type' => 'info'
        );

        //et tu charge la meme page
        return redirect()->back()->with($notification);

    }//end méthode

    public function Home(){
        return view('frontend.index');
    }//end méthode
}
