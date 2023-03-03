<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public function uploadImage($fieldname, $directory)
    {
        $imageName =  uniqid() .'_'. request()->file($fieldname)->getClientOriginalName();
        request()->file($fieldname)->storeAs("public/$directory", $imageName);
        return $imageName;
    }

    public function updateImage($fieldname, $directory, $oldImage)
    {
        request()->validate([
            $fieldname => 'image|mimes:jpg,png,jpeg'
        ]);
        Storage::delete("public/$directory/$oldImage");
        $imageName = uniqid().'_'.request()->file($fieldname)->getClientOriginalName();
        request()->file($fieldname)->storeAs("public/$directory", $imageName);
        return $imageName;
    }

    public function deleteImage($model, $id, $directory)
    {
        $model = $model::findOrFail($id);
        Storage::delete("public/$directory/$model->image");
        $model->delete();
    }

// Upload document
    public function uploadDoc($fieldname, $directory)
    {
        $docName =  uniqid() .'_'. request()->file($fieldname)->getClientOriginalName();
        request()->file($fieldname)->storeAs("public/$directory", $docName);
        return $docName;
    }

    public function updateDoc($fieldname, $directory, $oldDoc)
    {
        request()->validate([
            $fieldname => 'application|mimes:pdf,doc,xls,xlsx'
        ]);
        Storage::delete("public/$directory/$oldDoc");
        $docName = uniqid().'_'.request()->file($fieldname)->getClientOriginalName();
        request()->file($fieldname)->storeAs("public/$directory", $docName);
        return $docName;
    }

    public function deleteDoc($model, $id, $directory)
    {
        $model = $model::findOrFail($id);
        Storage::delete("public/$directory/$model->document");
        $model->delete();
    }
}