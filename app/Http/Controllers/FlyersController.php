<?php

namespace App\Http\Controllers;

use Auth;
use App\Flyer;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Traits\AuthorizesUsers;

use App\Http\Requests;

class FlyersController extends Controller
{

    // Add Trait for usage
    use AuthorizesUsers;

    public function __construct()
    {
        $this->middleware('auth', ['except'=>'show']);
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        #flash('Hello World!', 'How are you??');
        #flash()->overlay('Hello', 'world!!', 'error');
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\FlyerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\FlyerRequest $request)
    {
        // after validation
        $request->input('user_id',$this->user->id);
        #return (print_r(['<pre>', $request]));
        \App\Flyer::create($request->all());

        //session()->flash('flash message', 'flyer created succcsfully created');
        flash('Bravo', 'Flyer successfuly created');
        // flash messge
        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  string $zip postal code
     * @param  string $street the street
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
        #$street = str_replace('-', ' ', $street);
        #die("fuck - $zip - $street");
        #$flyer = Flyer::locatedAt($zip, $street)->first();
        $flyer = Flyer::locatedAt($zip, $street);

        return view('pages/flyer', compact('flyer'));
    }


    /**
     * Display the specified resource.
     *
     * @param  string $zip postal code
     * @param  string $street the street
     * @return \Illuminate\Http\Response
     */
    public function addPhoto($zip, $street, Request $request)
    {

        $this->validate($request, [
            'photo'=>'required|mimes:jpg,jpeg,png,bmp'
        ]);

        /*Refactor
        $file = $request->file('photo');
        $name = time() . $file->getClientOriginalName();
        #dd([$name, $file]);
        $file->move('flyers/photos', $name);
        Refactor*/
        //$file = Photo::fromForm($request->file('photo')) ;

        $file = $this->makePhoto($request->file('photo'));

        # save flyer name in db for links
        #$flyer = Flyer::locatedAt($zip, $street)->first();

        /*Refatocr
        $flyer = Flyer::locatedAt($zip, $street);
        $flyer->photos()->create(['path'=>"/flyers/photos/$name"]);
        Refactor*/
        #$flyer = Flyer::locatedAt($zip, $street);
        /**Refactor if($flyer->user_id !== \Auth::id())  # if is not the owner of the flyer*/
        /** refactor if(!$flyer->ownedBy($this->user))  # refactored placed in \Controller\Auth::user())) */
        if( ! $this->userCreatedFlyer($request))
        {
            #print_r([$flyer->user_id, \auth::id()]);
            return $this->unauthorized($request);
        }
         Flyer::locatedAt($zip, $street)->addPhoto($file);

        return 'Done';

    }



    public function makePhoto(UploadedFile $file)
    {
        #return Photo::fromForm($file)->store($file);
        return (new Photo)->named($file->getClientOriginalName())
            ->move($file);
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
        //
    }
}
