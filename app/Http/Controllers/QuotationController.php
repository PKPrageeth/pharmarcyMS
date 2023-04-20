<?php

namespace App\Http\Controllers;

use App\Models\prescription;
use App\Models\quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function QuotationSendPage(Request $request, $id)
    {

        $pres = prescription::find($id);

        return view('Backend.quotation')->with('pres', $pres);


    }

    public function AddDrugs(Request $request)
    {

        $userid = $request->user()->id;
        $id = $request->id;
        $drug = $request->drug;
        $qty = $request->qty;
        $price = $request->price;

        $quotation = new quotation();
        $quotation->drug = $drug;
        $quotation->qty = $qty;
        $quotation->amount = $price;
        $quotation->prescription = $id;
        $quotation->user = $userid;
        $quotation->save();


        return 'success';

    }

    public function ListDrugs(Request $request)
    {

        $id = $request->id;
        $pres = prescription::find($id);
        $quots = quotation::where('prescription', $id)->get();


        $str = '<table class="table">';
        $str .= '<thead>';
        $str .= '<tr>';
        $str .= '<th>Drug</th> ';
        $str .= '<th>Quantity</th> ';
        $str .= '<th>Amount</th> ';
        if ($pres->status == 'pending') {
            $str .= '<th>Action</th> ';
        }
        $str .= '</tr>';
        $str .= '</thead>';
        $str .= '<tbody>';
        foreach ($quots as $quot) {
            $str .= '<tr>';
            $str .= '<td>';
            $str .= $quot->drug;
            $str .= '</td>';
            $str .= '<td>';
            $str .= $quot->amount . "*" . $quot->qty;
            $str .= '</td>';
            $str .= '<td>';
            $str .= $quot->amount * $quot->qty;
            $str .= '</td>';
            if ($pres->status == 'pending') {
                $str .= '<td>';

                $str .= '<a onclick="removeDrug(' . $quot->id . ',' . $id . ')" class="btn btn-danger"  style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">remove</a>';

                $str .= '</td>';
            }
            $str .= '</tr>';

        }


        $str .= '</tbody>';

        $str .= '</table>';


        return $str;

    }

    public function RemoveDrugs(Request $request)
    {

        $quotation = quotation::where("prescription", $request->quoid)->where('id', $request->id)->first();
        $quotation->delete();


    }

    public function SubmitQuotation(Request $request)
    {

        $pres = prescription::find($request->id);
        $pres->status = "complete";
        $pres->save();
        return redirect(route('admin.list.prescription.page'));

    }

    public function ApproveOrRejectQuotation(Request $request)
    {

        $id = $request->id;

        $pres = prescription::find($id);

        if ($request->approve) {
            $pres->status = 'approve';
        } else {
            $pres->status = 'reject';
        }
        $pres->save();

        return redirect(route('list.prescription.page'));
    }
    public function ApproveList(Request $request){



            $userid = $request->user()->id;

            $list = prescription::where('status','approve')->get();

            return view('Backend.list')->with('list',$list);




    }
    public function RejectedList(Request $request){



        $userid = $request->user()->id;

        $list = prescription::where('status','rejected')->get();

        return view('Backend.list')->with('list',$list);




    }
    public function QuotationList(Request $request){


        $userid = $request->user()->id;

        $list = prescription::whereIn('status',['complete','reject','approve'])->where('user',$userid)->get();

        return view('Frontend.list')->with('list',$list);




    }


}
