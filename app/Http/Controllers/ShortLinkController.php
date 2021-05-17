<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shortLinks = ShortLink::own()->latest()->get();
   
        return view('shortenLink', compact('shortLinks'));
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $code = substr(
                preg_replace("/[^A-Za-z]/", '',
                    base64_encode(
                        openssl_random_pseudo_bytes(5 * 2)
                )), 0, 5);

        $inputs = [
            'link'          => $request->link,
            'code'          => $code,
            'created_by'    => Auth::id()
        ];

        Validator::make($inputs, [
           'link'       => 'required|url',
           'code'       => 'required|unique:short_links,code|max:5',
           'created_by' => 'required'
        ])->validate();
       
        ShortLink::create($inputs);
  
        return  redirect()
                    ->route('shortener.index')
                    ->with('success', 'Shorten Link Generated Successfully!');
    }
   
    
    /**
     * Visit the link.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {   
        $find = ShortLink::where('code', $code)->first();
        if(!$find) {
            abort(404);
        }

        return redirect($find->link);
    }

    /**
     * Destroy the link.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = ShortLink::own()->where('id', $id)->first();
        if(!$link) {
            abort(401);
        }
        $link->delete();
        return redirect()
        ->route('shortener.index')
        ->with('success', 'Shorten Link Deleted Successfully!');
    }

    

}
