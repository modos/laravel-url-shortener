<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function index(){
        $shortLinks = ShortLink::latest()->get()->sort();

        return view('shortenLink', compact('shortLinks'));
    }

    public function store(Request $request){
        $request->validate([
            'link' => 'required|url'
        ]);

        $input['link'] = $request->link;
        $input['code'] = Str::random(6);

        ShortLink::Create($input);

        return redirect('generate-shorten-link')->with('success', 'your link generated successfully');

    }

    public function shortenLink($code){
        $find = ShortLink::where('code', $code)->first();

        return redirect($find->link);
    }
}
