<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        $notification = array(
            'message' => 'Successfully logout', 
            'alert-type' => 'success'
        );

        
        return redirect('/login')->with($notification);;
    }//end methode

    public function profile(){

        //ici on recpere l'id de l'utilisateur actuel
        $id = Auth::user()->id;

        //on utilise la variable $id pour retrouver l'utilisateur actuel et stocker ses données dans la variable $data
        $adminData = User::find($id);

        //tu retourne vers ta vue en l'accompagnant de ta data 
        return view('admin.admin_profile_view',compact('adminData'));
        
    }//end methode

    public function editProfile(){

        //ici on recpere l'id de l'utilisateur actuel
        $id = Auth::user()->id;

        //on utilise la variable $id pour retrouver l'utilisateur actuel et stocker ses données dans la variable $data
        $editData = User::find($id);

        //tu retourne vers ta vue en l'accompagnant de ta data 
        return view('admin.admin_profile_edit',compact('editData'));
        
    }//end methode

    public function storProfile(Request $request){      //n'oublie pas dentrer en parametre 'Request $request' car tu utilise une methode POST

        //ici on recpere l'id de l'utilisateur actuel
        $id = Auth::user()->id;

        //on utilise la variable $id pour retrouver l'utilisateur actuel et stocker ses données dans la variable $data
        $data = User::find($id);

        /*
            tu remplace les champs de ta BDD sachant que :
            $data ---> c'est les champs de ta BDD
            $request ---> c'est les champs que tu as recuperer de ton formulaire grace à l'attribut 'name'
        */
        $data->name = $request->name;       //ca aussi ca marche ---> $data['name'] = $request['name'];
        $data->username = $request->username;
        $data->email = $request->email;

        if($request->file('profile_image')){
        /*
            cette condition signifie --> SI et seulement SI l'utilisateur passe une image tu continue
            pk faire cette condition?? --> car la méthode "getClientOriginalName()" que tu utilisera en bas n'accepte pas de valeur NULL donc t'es obligé !!!
        */

            //tu recupere ton image et tu la stock dans la variable $file
            $file = $request->file('profile_image');

            //tu cree une variable $filename qui va contenir le NOM de ton image
            $filename = date('YmdHi').$file->getClientOriginalName();

            //tu deplace ton image vers ton dossier d'upload ici c'est "upload/admin_images" et tu la renomme avec $filename
            $file->move(public_path('upload/admin_images'),$filename);

            //enfin tu sauvgarde le NOM de ton image dans ta BDD
            $data['profile_image'] = $filename;     //cà aussi c'est juste ---> $data->profile_image = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully', 
            'alert-type' => 'info'
        );

        return redirect()->route('admin.profile')->with($notification);
        
        
    }//end methode

    public function ChangePassword(){
        return view('admin.admin_change_password');
    }//end methode

    public function UpdatePassword(Request $request){

        //faisons un peu de validation
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required|same:newpassword',   //et tu colles bien tout sinon ca te fais de jolies erreurs
        ]);

        //on recupere le mot de passe de l'utilisateur celui qui est haché et dans la BDD puis on le stock dans la variable $hachedPassword 
        $hashedPassword = Auth::user()->password;

        //tu compares entre ce mor de passe precis de l'utilisateur avec ce qu'il as entrer dans l'input 'oldpassword' sachant que tu dois hacher ce dernier aussi pour pouvoir comparer grace à la méthode Hach::check
        if(Hash::check($request->oldpassword,$hashedPassword)){

            //tu cherche l'utilisateur en question grace à son "id"
            $users = User::find(Auth::id());//  "Auth::user()->id"  la meme chose que    "Auth::id()"

            //tu remplace le mot de passe de l'utilisateur trouvé par le nouveau mot de passe qu'il a rentrer mais n'oublie pas de le hacher grace à la méthode "bcrypt()"
            $users->password = bcrypt($request->newpassword);

            //maintenant tu sauvgarde
            $users->save();

            //on affiche un petit message flash pour montrer le changement
            session()->flash('message','Password Updated Succesfully');

            //ce redirect()->back(); signifie simplement que tu vas rafrechir la page
            return redirect()->back();
        }
        else{
            session()->flash('message','Not a same password !!!!!');
            return redirect()->back();
        }
            
    }//end methode
}
