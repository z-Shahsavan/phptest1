<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Statistics extends Controller
{
    /**
     * @param string $candidate
     * @param int $count
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function printGuessStatistics($candidate, $count) {
        if ($count == 0 || $count=='') {
            $number = "no";
            $verb = "are";
            $pluralModifier = "s";
        } elseif ($count == 1) {
            $number = "1";
            $verb = "is";
            $pluralModifier = "";
        } else {
            $number = $count;
            $verb = "are";
            $pluralModifier = "s";
        }
        $sentdata=array('result'=>"There ".$verb." ". $number." ". $candidate."".$pluralModifier);
        return view('statistics',$sentdata);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public  function validateData(Request $request){
        $val=\Validator::make($request->all(),['str'=>'required','number'=>'required','number'=>'numeric']);
        if($val->fails()){return redirect()->back();}
        $candidate=$request['str'];
        $count=$request['number'];
        return redirect('/phptest/'.$candidate.'/'.$count);
    }

}


