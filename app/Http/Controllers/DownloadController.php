<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Block;
class DownloadController extends Controller
{
    //
    public function index()
    {
        return view('pages.download');
    }

    public function handler($type)
    {
        //download
        $blocks=Block::get();
        $content='<?xml version="1.0" encoding="utf-8"?>
<blocks>
';
        foreach($blocks as $block)
        {
            $content.="    <block id=\"".$block->pimp_id."\" name=\"".$block->name."\">\n";

            // now get the properties
            foreach($block->properties as $property)
            {
                if($property->attribute=='property') {
                    $content.="      <property ";
                    $content .= "name=\"" . $property->key . "\" value=\"" . $property->value . "\" ";
                    if($property->parameters!='')
                    {
                        $params=implode("\" ",explode("|",$property->parameters));
                        $params=str_replace("=","=\"",$params);
                        $content.=$params."\" ";
                    }
                    $content.="/>\n";
                } elseif($property->attribute=='class')
                {
                    $content.="      <property class=\"".$property->value."\">\n";
                    if($property->parameters!='')
                    {
                        $subprop=explode("|",$property->parameters);
                        foreach($subprop as $p)
                        {
                            $parts=explode("&",$p);
                            $content.="         <property name=\"$parts[0]\" value=\"$parts[1]\" />\n";
                        }
                    }
                    $content.="      </property>\n";
                } else {
                    $content.="      <drop ";
                    $content.="event=\"".$property->key."\" ";
                    if($property->value!=''){$content.="name=\"".$property->value."\" ";}
                    if($property->parameters!='')
                    {
                        $params=implode("\" ",explode("|",$property->parameters));
                        $params=str_replace("=","=\"",$params);
                        $content.=$params."\" ";
                    }
                    $content.="/>\n";
                }


            }

            $content.="    </block>\n";
        }
        $content.="</blocks>";
        $fileName = "blocks.xml";
        $headers = ['Content-Type: text/plain; charset=utf-8',
            'Content-Disposition'=>sprintf('attachment; filename="%s"', $fileName)];
        return Response::make($content, 200, $headers);
    }
}
