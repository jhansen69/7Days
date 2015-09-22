@extends ('template.master')

@section('content')
    <div class="well" style="padding:40px;width:60%;margin:40px auto;">
    {!! Form::open(array('url'=>'import','files'=>true, 'class' =>'form form-horizontal')) !!}
    <div class="form-group">
        <label for="type">Core XML File Type</label>
        <select class="form-control" id="type" name="type">
            <option value="materials">Materials</option>
            <option value="blocks">Blocks</option>
            <option value="items">Items</option>
            <option value="recipes">Recipes</option>
            <option value="buffs">Buffs</option>
            <option value="biomes">Biomes</option>
        </select>
    </div>
    <div class="form-group">
        <label for="xmlfile">Select File</label>
        <input type="file" class="form-control" id="xmlfile" name="xmlfile" placeholder="">
    </div>
    <div class="form-group">
        <label for="alpha">What Version of the game?</label>
        <input type="number" class="form-control" id="alpha" name="alpha" placeholder="12.4" min="0" step="any">
    </div>
    <input type="hidden" name="userid" value="{!! Auth::user()->id !!}" />
    <button type="submit" class="btn btn-default">Upload File</button>
    {!! Form::close() !!}
    </div>
@endsection
