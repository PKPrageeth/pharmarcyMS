<?php

namespace App\Http\Controllers;

use App\Models\prescription;
use App\Models\quotation;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{


    public function prescription()
    {

        return view('Frontend.uploadprescription');

    }

    public function UploadPrescription(Request $request)
    {

        $request->validate([
            'note' => 'required',
            'delivery_address' => 'required',
            'delivery_time' => 'required    ',
            'images.*' => [
                'required',
                'image',
            ],
        ]);
        $images = [];
        $i=0;
        foreach ($request->file('images') as $image) {
            $fileName = "prescription_" . time() . $i++ . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $fileName);
            $images[] = "/images/".$fileName;

        }

        $prescription = new prescription();
        $prescription->note = $request->note;
        $prescription->delivery_address = $request->delivery_address;
        $prescription->delivery_time = $request->delivery_time;
        $prescription->images = json_encode($images);
        $prescription->user = $request->user()->id;

        $prescription->save();

        return redirect('user/list/prescription');

    }

    public function prescriptionsList(Request $request)
    {

        $userid = $request->user()->id;

        $list = prescription::where('user', $userid)->get();

        return view('Frontend.list')->with('list',$list);


    }
    public function prescriptionsAllList(Request $request)
    {

        $userid = $request->user()->id;

        $list = prescription::get();

        return view('Backend.list')->with('list',$list);


    }


    public function prescriptionsView(Request $request,$id){
        $userid = $request->user()->id;

        $pres = prescription::where('user', $userid)->find($id);
        $quots = quotation::where('prescription', $id)->get();

        return view('Frontend.viewprescription')->with('pres',$pres)->with('drugs',$quots);

    }


}
