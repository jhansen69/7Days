<?php
/**
 * Created by PhpStorm.
 * User: jhansen
 * Date: 8/7/2015
 * Time: 1:41 PM
 */

namespace app\Library;

use App\Block;
use App\BlockProperties;
use App\Material;
use App\Item;
use App\ItemProperties;

class Importer
{
    public function parseRecipe($recipes,$userid,$alpha)
    {
        $processed=0;
        foreach($recipes['recipe'] as $item)
        {
            $data=$item['@attributes'];
            if($data['name']!='') {
                if(isset($data['craft_area'])){$area=$data['craft_area'];}else{$area='';}
                if(isset($data['craft_tool'])){$tool=$data['craft_tool'];}else{$tool='';}
                if(isset($data['craft_exp_gain'])){$craftxp=$data['craft_exp_gain'];}else{$craftxp=2;}
                if(isset($data['learn_exp_gain'])){$learnxp=$data['learn_exp_gain'];}else{$learnxp=20;}
                $record=array('name'=>$data['name'],
                    'count'=>$data['count'],
                    'craft_xp'=>$craftxp,
                    'learn_xp'=>$learnxp,
                    'craft_area'=>$area,
                    'craft_tool'=>$tool,
                    'craft_time'=>$data['craft_time'],
                    'scrapable'=>$data['scrapable'],
                    'user_id'=> $userid,
                    'alpha'=> $alpha,
                    'core'=>1);
                \App\Recipe::create($record);

                $processed++;
            }
        }
        return "Imported $processed recipes";
    }

    public function parseBlocks($blocks,$userid,$alpha,$core=0,$modid=0)
    {
        //purge all existing blocks that are core and of this alpha version

        Block::where(array('user_id'=>1,'alpha'=>12.4))->delete();

        //dd($blocks);
        $processed = 0;
        foreach ($blocks['block'] as $item) {
            $block = new \App\Block;
            $block->name = $item['@attributes']['name'];
            if($core)
            {
                $block->user_id=1;
                $block->mod_id=1;
                $block->core=1;
                $block->pimp_id=$item['@attributes']['id'];
            } else {
                $block->user_id=$userid;
                $block->mod_id=$modid;
                $block->core=0;
                $block->pimp_id=0;
            }
            $block->alpha=$alpha;
            $block->save();

            $currentid = $item['@attributes']['id'];
            if (isset($item['property'])) {
                foreach ($item['property'] as $prop) {
                    if (isset($prop['@attributes'])) {
                        $attribs = $prop['@attributes'];
                        $properties='';
                        $parameters='';
                        $attribute='property';
                        foreach ($attribs as $key => $value) {
                            if($key=='name')
                            {
                                $propname=$value;
                            }else if($key=='value')
                            {
                                $propvalue=$value;
                            }else if($key=='class')
                            {
                                $attribute='class';
                                $propname='class';
                                $propvalue=$value;
                            } else {
                                $parameters=$parameters."$key=$value|";
                            }
                            if ($key == 'value' && $value == 'PlantGrowing') {
                                $plantblock = true;
                            } else {
                                $plantblock = false;
                            }
                            if ($value == 'UpgradeBlock') {
                                $properties="UB";
                                foreach ($prop['property'] as $subprop) {
                                    foreach ($subprop['@attributes'] as $ukey => $uvalue) {
                                        if($ukey=='name')
                                        {
                                            $subname=$uvalue;
                                        }
                                        if($ukey=='value')
                                        {
                                            $subvalue=$uvalue;
                                        }

                                    }
                                    $parameters=$parameters."$subname&$subvalue|";
                                }
                            }
                            if ($value == 'Explosion') {
                                $properties="EX";
                                foreach ($prop['property'] as $subprop) {
                                    foreach ($subprop['@attributes'] as $ukey => $uvalue) {
                                        if($ukey=='name')
                                        {
                                            $subname=$uvalue;
                                        }
                                        if($ukey=='value')
                                        {
                                            $subvalue=$uvalue;
                                        }

                                    }
                                    $parameters=$parameters."$subname&$subvalue|";
                                }
                            }
                            if ($value == 'PlantGrowing' && !$plantblock) {
                                $properties="PG";
                                foreach ($prop['property'] as $subprop) {
                                    foreach ($subprop['@attributes'] as $gkey => $gvalue) {
                                        if($gkey=='name')
                                        {
                                            $subname=$gvalue;
                                        }
                                        if($gkey=='value')
                                        {
                                            $subvalue=$gvalue;
                                        }

                                    }
                                    $parameters=$parameters."$subname&$subvalue|";
                                }
                            }

                        }
                        $prop=new \App\BlockProperties;
                        $prop->block_id=$block->id;
                        $prop->attribute=$attribute;
                        $prop->key=$propname;
                        $prop->key=$propname;
                        $prop->value=$propvalue;
                        $prop->properties=rtrim($properties,"|");
                        $prop->parameters=rtrim($parameters,"|");
                        $prop->save();
                    }
                }

            }
            if (isset($item['drop'])) {
               foreach ($item['drop'] as $property) {
                    $parameters='';
                    $okToSave=false;
                    $propname='';
                    $propvalue='';
                    foreach ($property as $key => $value) {
                        if (is_array($value)) {
                            $parameters='';
                            foreach ($value as $skey => $svalue) {
                                if ($skey == 'event') {
                                    $propname = $svalue;
                                } else if ($skey == 'name') {
                                    $propvalue = $svalue;
                                } else {
                                    $parameters = $parameters . "$skey=$svalue|";
                                }
                            }
                            $prop = new \App\BlockProperties;
                            $prop->block_id = $block->id;
                            $prop->attribute = 'drop';
                            $prop->key = $propname;
                            $prop->value = $propvalue;
                            $prop->parameters = rtrim($parameters, "|");
                            $prop->save();
                        } else {
                            $okToSave=true;
                            if ($key == 'event') {
                                $propname = $value;
                            } else if ($key == 'name') {
                                $propvalue = $value;
                            } else {
                                $parameters = $parameters . "$key=$value|";
                            }
                        }
                    }
                    if($okToSave) {
                        $prop = new \App\BlockProperties;
                        $prop->block_id = $block->id;
                        $prop->attribute = 'drop';
                        $prop->key = $propname;
                        $prop->value = $propvalue;
                        $prop->parameters = rtrim($parameters, "|");
                        $prop->save();
                    }

                }

            }
        }
    }



    public function parseItems($items,$userid,$alpha,$core=0,$modid=0)
    {
        //purge all existing blocks that are core and of this alpha version

        Item::where(array('user_id'=>1,'alpha'=>12.4))->delete();

        //dd($blocks);
        $processed = 0;
        foreach ($items['item'] as $item) {
            $block = new \App\Item;
            $block->name = $item['@attributes']['name'];
            if($core)
            {
                $block->user_id=1;
                $block->mod_id=1;
                $block->core=1;
                $block->pimp_id=$item['@attributes']['id'];
            } else {
                $block->user_id=$userid;
                $block->mod_id=$modid;
                $block->core=0;
                $block->pimp_id=0;
            }
            $block->alpha=$alpha;
            $block->save();

            $currentid = $item['@attributes']['id'];
            if (isset($item['property'])) {
                foreach ($item['property'] as $prop) {
                    if (isset($prop['@attributes'])) {
                        $attribs = $prop['@attributes'];
                        $properties='';
                        $parameters='';
                        $attribute='property';
                        foreach ($attribs as $key => $value) {
                            if($key=='name')
                            {
                                $propname=$value;
                            }else if($key=='value')
                            {
                                $propvalue=$value;
                            }else if($key=='class')
                            {
                                $attribute='class';
                                $propname='class';
                                $propvalue=$value;
                            } else {
                                $parameters=$parameters."$key=$value|";
                            }
                            if ($key == 'value' && $value == 'PlantGrowing') {
                                $plantblock = true;
                            } else {
                                $plantblock = false;
                            }

                        }
                        $prop=new \App\ItemProperties;
                        $prop->item_id=$block->id;
                        $prop->attribute=$attribute;
                        $prop->key=$propname;
                        $prop->key=$propname;
                        $prop->value=$propvalue;
                        $prop->properties=rtrim($properties,"|");
                        $prop->parameters=rtrim($parameters,"|");
                        $prop->save();
                    }
                }

            }

        }
    }

    public function parseMaterial($content,$userid,$alpha,$core=0)
    {
        /*
         * always purge all existing core materials first
         *
         */
        Material::truncate();

        $processed=0;
        foreach($content['material'] as $item)
        {
            $name=$item['@attributes']['id'];
            if($name!='') {
                $record=array("name"=>$name);
                foreach($item['property'] as $prop)
                {
                    $prop=$prop['@attributes'];
                    $record[$prop['name']]=$prop['value'];
                }
                $record=array_merge($record,array(
                        'user_id'=>$userid,
                        'core'=>1,
                        'mod_id'=>1,
                        'alpha'=>$alpha)
                );
                Material::create($record);

                $processed++;
            }
        }
    }
}