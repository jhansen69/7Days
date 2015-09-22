<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Nathanmac\Utilities\Parser\Parser;
use Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Input;
use App\Library\Importer;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return view('pages.import');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('pages.import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $file = Request::file('xmlfile');
        $type=Input::get('type');
        $userid=Input::get('userid');
        $alpha=Input::get('alpha');
        $extension = $file->getClientOriginalExtension();
        $oname=$file->getClientOriginalName();

        Storage::disk('local')->put("uploads/".$file->getClientOriginalName(), File::get($file));

        $parser = new Parser();
        $contents = Storage::get("uploads/".$file->getClientOriginalName());
        $rawxml = $parser->xml($contents);

        $importer=new Importer;

        if($type=='recipes'){ $importer->parseRecipe($rawxml,$userid,$alpha,1);}
        if($type=='blocks'){ $importer->parseBlocks($rawxml,$userid,$alpha,1);}
        if($type=='materials'){ $importer->parseMaterial($rawxml,$userid,$alpha,1);}
        if($type=='items'){ $importer->parseItems($rawxml,$userid,$alpha,1);}
        //Flash::success('You successfully imported a '.$type.' xml file for 7 Days to Die Alpha '.$alpha.'!');
        return view('pages.import');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        return 'in show method';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }





    function handleMaterials($materials,$userid,$alpha)
    {

        flash()->success('Successfully imported '.$processed.' materials.');

    }

}
