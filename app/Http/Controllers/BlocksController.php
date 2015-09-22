<?php

namespace App\Http\Controllers;

use App\BlockProperties;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Block;
use App\Material;
use App\Item;

class BlocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $blocks=Block::get();

        return view('pages.blocks',compact('blocks','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        $block=array();
        return view('forms.block',compact('block','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //store the new block
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
        $user = Auth::user();
        $block=Block::findOrNew($id);
        foreach(Material::get(array('name'))->toArray() as $mat)
        {
           $materials[$mat['name']]=$mat['name'];
        }
        $blocks=array(0=>'None');
        foreach(Block::select('name')->orderBy('name', 'ASC')->get()->toArray() as $pointer)
        {
            $blocks[$pointer['name']]=$pointer['name'];
        }
        $items=array(0=>'None');
        foreach(Item::select('name')->orderBy('name', 'ASC')->get()->toArray() as $pointer)
        {
            $items[$pointer['name']]=$pointer['name'];
        }

        $shapes = array(0=>'None');
        foreach(BlockProperties::select('value')->where('key','Shape')->groupBy('value')->get()->toArray() as $pointer)
        {
            $shapes[$pointer['value']]=$pointer['value'];
        }
        $models = array(0=>'None');
        foreach(BlockProperties::select('value')->where('key','Model')->groupBy('value')->get()->toArray() as $pointer)
        {
            $models[$pointer['value']]=$pointer['value'];
        }
        $meshes = array(0=>'None');
        foreach(BlockProperties::select('value')->where('key','Mesh')->groupBy('value')->get()->toArray() as $pointer)
        {
            $meshes[$pointer['value']]=$pointer['value'];
        }
        $groups = array(0=>'None');
        foreach(BlockProperties::select('value')->where('key','Group')->groupBy('value')->get()->toArray() as $pointer)
        {
            $groups[$pointer['value']]=$pointer['value'];
        }
        $classes = array(0=>'None');
        foreach(BlockProperties::select('value')->where('key','Class')->groupBy('value')->get()->toArray() as $pointer)
        {
            $classes[$pointer['value']]=$pointer['value'];
        }
        $droppables = array(0=>'None');
        foreach(Block::get(array('name'))->toArray() as $pointer)
        {
            $droppables[$pointer['name']]=$pointer['name'];
        }
        foreach(Item::get(array('name'))->toArray() as $pointer)
        {
            $droppables[$pointer['name']]=$pointer['name'];
        }
        $placements = array(0=>'None');
        foreach(BlockProperties::select('value')->where('key','Place')->groupBy('value')->get()->toArray() as $pointer)
        {
            $placements[$pointer['value']]=$pointer['value'];
        }
        $collisions=array('bullet'=>'bullet',
                          'melee'=>'melee',
                          'movement'=>'movement',
                          'rocket'=>'rocket',
                          'sight'=>'sight'
        );
        $sounds=array(0=>"No sound");
        $buffs=array(0=>"No buff");
        $loot=array(0=>"No loot table");
        $tags=array(0=>"No tags",
                    'Door'=>"Door",
                    'Gore'=>"Gore",
                    'TreeTrunk'=>"TreeTrunk",
                    'Window'=>"Window"
            );
        $meshDamages=array(0=>"None",
                           "Door/Door_DMG0"=>"Door/Door_DMG0",
                           "Door/Door_DMG1"=>"Door/Door_DMG1",
                           "Door/Door_DMG2"=>"Door/Door_DMG2",
                           "Door/Door_DMG3"=>"Door/Door_DMG3",
                           "Door/Door_DMG4"=>"Door/Door_DMG4",
                           "Door/Hatch_DMG0"=>"Door/Hatch_DMG0",
                           "Door/Hatch_DMG1"=>"Door/Hatch_DMG1",
                           "Door/Hatch_DMG2"=>"Door/Hatch_DMG2",
                           "Door/Hatch_DMG3"=>"Door/Hatch_DMG3",
                           "Door/Hatch_DMG4"=>"Door/Hatch_DMG4"
                            );
        $particleNames=array(0=>"None",
                            "campfire"=>"campfire",
                            "candle_flame"=>"candle_flame",
                            "candleWall_flame"=>"candleWall_flame",
                            "ember_pile"=>"ember_pile",
                            "forge"=>"hotembers",
                            "hotembers"=>"hotembers",
                            "sandstorm"=>"sandstorm",
                            "smokestorm"=>"smokestorm",
                            "snowstorm1"=>"snowstorm1",
                            "torch_wall"=>"torch_wall",
        );
        $particleOnDeath=array(
                           0 => "None",
                           "treeGib_birch" => "treeGib_birch",
                           "treeGib_burnt" => "treeGib_burnt"
        );
        $properties=array(
            'BigDecorationRadius'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'BuffsWhenWalkedOn'=>array(
                'type'=>'select',
                'options'=>$buffs,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'CanDecorateOnSlopes'=>array(
                'type'=>'checkbox',
                'options'=>'',
                'value'=>true,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'CanMobsSpawnOn'=>array(
                'type'=>'checkbox',
                'options'=>'',
                'value'=>true,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'CanPickup'=>array(
                'type'=>'checkbox',
                'options'=>'',
                'value'=>false,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'CanPlayersSpawnOn'=>array(
                'type'=>'checkbox',
                'options'=>'',
                'value'=>true,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Class'=>array(
                'type'=>'select',
                'options'=>$classes,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'CloseSound'=>array(
                'type'=>'select',
                'options'=>$sounds,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Collide'=>array(
                'type'=>'selectmulti',
                'options'=>$collisions,
                'value'=>'',
                'attribute'=>'property',
                'parameters'=>''
            ),
            'CustomIcon'=>array(
                'type'=>'select',
                'options'=>$blocks,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'CustomIconTint'=>array(
                'type'=>'text',
                'options'=>'',
                'value'=>'000000',
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Damage'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Damage_received'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Density'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>1,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'DowngradeBlock'=>array(
                'type'=>'select',
                'options'=>$blocks,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'DropScale'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>2,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'FallDamage'=>array(
                'type'=>'checkbox',
                'options'=>'',
                'value'=>true,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'FallOver'=>array(
                'type'=>'checkbox',
                'options'=>'',
                'value'=>false,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'FuelValue'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'GrassBlock1'=>array(
                'type'=>'select',
                'options'=>$blocks,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'GrassBlock2'=>array(
                'type'=>'select',
                'options'=>$blocks,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Group'=>array(
                'type'=>'select',
                'options'=>$groups,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'HeatMapFrequency'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'HeatMapStrength'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'HeatMapTime'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'IsDeveloper'=>array(
                'type'=>'checkbox',
                'options'=>'',
                'value'=>false,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'IsPlant'=>array(
                'type'=>'checkbox',
                'options'=>'',
                'value'=>false,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'IsTerrainDecoration'=>array(
                'type'=>'checkbox',
                'options'=>'',
                'value'=>true,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Light'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'LiquidMoving'=>array(
                'type'=>'number',
                'options'=>array(0=>"N/A",'waterMoving'=>'waterMoving','waterMovingBucket'=>'waterMovingBucket'),
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'LiquidStatic'=>array(
                'type'=>'number',
                'options'=>array(0=>"N/A",'water'=>'water','waterStaticBucket'=>'waterStaticBucket'),
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'LootList'=>array(
                'type'=>'select',
                'options'=>$loot,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'LPHardnessScale'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Map.Color'=>array(
                'type'=>'text',
                'options'=>'',
                'value'=>'',
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Material'=>array(
                'type'=>'select',
                'options'=>$materials,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Mesh'=>array(
                'type'=>'select',
                'options'=>$meshes,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Mesh-Damage-1'=>array(
                'type'=>'select',
                'options'=>$meshDamages,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Mesh-Damage-2'=>array(
                'type'=>'select',
                'options'=>$meshDamages,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Mesh-Damage-3'=>array(
                'type'=>'select',
                'options'=>$meshDamages,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Mesh-Damage-4'=>array(
                'type'=>'select',
                'options'=>$meshDamages,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Mesh-Damage-5'=>array(
                'type'=>'select',
                'options'=>$meshDamages,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Model'=>array(
                'type'=>'select',
                'options'=>$models,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'ModelOffset'=>array(
                'type'=>'text',
                'options'=>'',
                'value'=>array(0,0,0),
                'attribute'=>'property',
                'parameters'=>''
            ),
            'MovementFactor'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>1,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'MultiBlockDim'=>array(
                'type'=>'text',
                'options'=>'',
                'value'=>array(1,1,1),
                'attribute'=>'property',
                'parameters'=>''
            ),
            'OpenSound'=>array(
                'type'=>'select',
                'options'=>$sounds,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'ParticleName'=>array(
                'type'=>'select',
                'options'=>$particleNames,
                'value'=>'none',
                'attribute'=>'property',
                'parameters'=>''
            ),
            'ParticleOffset'=>array(
                'type'=>'text',
                'options'=>'',
                'value'=>array(0,0,0),
                'attribute'=>'property',
                'parameters'=>''
            ),
            'ParticleOnDeath'=>array(
                'type'=>'select',
                'options'=>$particleOnDeath,
                'value'=>'none',
                'attribute'=>'property',
                'parameters'=>''
            ),
            'PickupTarget'=>array(
                'type'=>'select',
                'options'=>array_merge($blocks,$items),
                'value'=>'none',
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Place'=>array(
                'type'=>'select',
                'options'=>$placements,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'PlaceAltBlockValue'=>array(
                'type'=>'selectmulti',
                'options'=>$blocks,
                'value'=>'none',
                'attribute'=>'property',
                'parameters'=>''
            ),
            'PlaceEverywhere'=>array(
                'type'=>'checkbox',
                'options'=>'',
                'value'=>false,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Shape'=>array(
                'type'=>'select',
                'options'=>$shapes,
                'value'=>'0',
                'attribute'=>'property',
                'parameters'=>''
            ),
            'ShapeMinBB'=>array(
                'type'=>'text',
                'options'=>'',
                'value'=>array(0,0,0),
                'attribute'=>'property',
                'parameters'=>''
            ),
            'SiblingBlock'=>array(
                'type'=>'select',
                'options'=>$blocks,
                'value'=>'0',
                'attribute'=>'property',
                'parameters'=>''
            ),
            'SiblingDirection'=>array(
                'type'=>'text',
                'options'=>'',
                'value'=>array(0,0,0),
                'attribute'=>'property',
                'parameters'=>''
            ),
            'SmallDecorationRadius'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'StateChange'=>array(
                'type'=>'select',
                'options'=>array('none'=>"Does not change",'PlantGrowing'=>'Grows like a plant','UpgradeBlock'=>'Upgradable Block','UpgradeRated'=>'Changes like concrete','Explosion'=>'Make it explodable (Gas pumps)'),
                'value'=>'none',
                'attribute'=>'class',
                'parameters'=>''
            ),
            'Tag'=>array(
                'type'=>'select',
                'options'=>$tags,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Texture'=>array(
                'type'=>'text',
                'options'=>'',
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'UpwardsCount'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'UpgradeRated.BlockCombined'=>array(
                'type'=>'select',
                'options'=>$blocks,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'UpgradeRated.Rate'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>15,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'UpgradeRated.ToBlock'=>array(
                'type'=>'select',
                'options'=>$blocks,
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),
            'Weight'=>array(
                'type'=>'number',
                'options'=>'',
                'value'=>0,
                'attribute'=>'property',
                'parameters'=>''
            ),


        );
        foreach($properties as $key=>$prop)
        {
            foreach($block->properties as $bprop)
            {
                $parameters=array(
                    'ToBlock'=>0,
                    'Item'=>0,
                    'ItemCount'=>0,
                    'UpgradeHitCount'=>0,
                    'Next'=>0,
                    'GrowthRate'=>0,
                    'FertileLevel'=>0,
                    'IsRandom'=>false,
                    'LightLevelStay'=>0,
                    'GrowIfAnythinOnTop'=>false,
                    'IsGrowOnTopEnabled'=>false,
                    'GrowOnTop'=>false,
                    'GrowthRate'=>false,
                    'ParticleIndex'=>0,
                    'RadiusBlocks'=>0,
                    'BlockDamage'=>0,
                    'RadiusEntities'=>0,
                    'EntityDamage'=>0
                );
                if($bprop->attribute=='class' && in_array($bprop->value,array('UpgradeBlock','PlantGrowing','Explosion')))
                {
                    /* parameters in format Key&Value|Key&Value */

                    if($bprop->parameters!='')
                    {
                        $param=explode("|",$bprop->parameters);
                        foreach($param as $p)
                        {
                            $t=explode("&",$p);
                            $parameters[$t[0]]=$t[1];
                        }
                    }
                    $properties['StateChange']['value']=$bprop->value;
                    $properties['StateChange']['attribute']=$bprop->attribute;
                    $properties['StateChange']['parameters']=$parameters;
                } else {
                    if($bprop->key == $key)
                    {
                        if($bprop->parameters!=''){
                            $param=explode("|",$bprop->parameters);
                            foreach($param as $p)
                            {
                                $t=explode("&",$p);
                                $parameters[$t[0]]=$t[1];
                            }
                        }
                        /* handle breaking up things like multi-dim, model offset, etc into pieces */
                        $value=$bprop->value;
                        if($key=='ModelOffset' || $key=='MultiBlockDim' || $key=='SiblingDirection' || $key=='ParticleOffset' || $key=='ShapeMinBB')
                        {
                            $value=explode(",",$value);
                        }
                        $properties[$key]['value']=$value;
                        $properties[$key]['attribute']=$bprop->attribute;
                        $properties[$key]['parameters']=$parameters;
                    }
                }
            }
        }
        if($properties['StateChange']['value']=='none')
        {
            $properties['StateChange']['parameters']=$parameters;
        }
        return view('forms.block',compact('block','user','properties','materials','blocks','items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
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
}
