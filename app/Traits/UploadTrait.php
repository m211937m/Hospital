<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait UploadTrait{

    public function verifyAndStoreImage($requset , $inputname , $foldername , $disk , $imageable_id, $imageable_type){


        if($requset->hasFile($inputname)){

            //check img
            if(!$requset->file($inputname)->isValid()){
                flash('Inavalid Imge')->error()->impoortant();
                return redirect()->back()->withInput();
            }

            $photo = $requset->file($inputname);
            $name = $requset->input('name');
            $filename = $name.'.'. $photo->getClientOriginalExtension();

            //insert img
            $Image = new Image();
            $Image->filename = $filename;
            $Image->imageable_id = $imageable_id;
            $Image->imageable_type = $imageable_type;
            $Image->save();
            return $requset->file($inputname)->storeAs($foldername,$filename,$disk);

        }

        return null;
    }
    public function verifyAndStoreImageForeach($varforesch , $foldername , $disk , $imageable_id, $imageable_type){

        //insert img
        $Image = new Image();
        $Image->filename = $varforesch->getClientOriginalName();
        $Image->imageable_id = $imageable_id;
        $Image->imageable_type = $imageable_type;
        $Image->save();
        return $varforesch->storeAs($foldername,$varforesch->getClientOriginalName(),$disk);
    }

    public function delete_attachment($disk ,$path ,$id ){

        Storage::disk($disk)->delete($path);
        Image::where('imageable_id', $id)->delete();

    }
}

