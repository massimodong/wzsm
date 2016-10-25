<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use Auth;

use App\Image;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
	    $images = Auth::user()->images;

	    return view('image.show',[
	    	'images' => $images,
	    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $this->validate($request,[
	    	'file' => 'required|image',
	    ]);

	    $filePath=$request->file('file')->getRealPath();
	    $extension = $request->file('file')->guessExtension();

	    $name=((string)time()).((string)rand(0,1000000000)).'.'.$extension;

	    $image = $request->user()->images()->create([
			    'name' => $name,
	    ]);

	    Storage::disk('images')->put(
			    $image->getPath(),
			    file_get_contents($filePath)
			    );
	    return response()->json(['location' => $image->getUrl()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    $image = Image::findOrFail($id);
	    $this->authorize('update',$image);

	    Storage::disk('images')->delete($image->getPath());

	    $image->delete();

	    return back();
    }
}
