@extends ('template.master')

@section('content')
<style>
    select {
        width:200px;
    }
</style>
    <div class="row">
    <div class="col-md-9 col-sm-12">
@if(isset($block['id']))
    {!! Form::open(array("url"=>"/blocks/update","class"=>'form-horizontal')) !!}
@else
    {!! Form::open(array("url"=>"/blocks/store","class"=>'form-horizontal')) !!}
@endif
    <ul class="nav nav-tabs" role="tablist" style="margin-bottom:10px;">
        <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basics</a></li>
        <li role="presentation"><a href="#blockchanges" aria-controls="blockchanges" role="tab" data-toggle="tab">Plant/Upgrade Block</a></li>
        <li role="presentation"><a href="#advanced" aria-controls="advanced" role="tab" data-toggle="tab">Advanced</a></li>
        <li role="presentation"><a href="#door" aria-controls="door" role="tab" data-toggle="tab">Door Specific</a></li>
        <li role="presentation"><a href="#plant" aria-controls="door" role="tab" data-toggle="tab">Plant Specific</a></li>
        <li role="presentation"><a href="#effects" aria-controls="effects" role="tab" data-toggle="tab">Effects</a></li>
        <li role="presentation"><a href="#options" aria-controls="options" role="tab" data-toggle="tab">Options</a></li>
        <li role="presentation"><a href="#drops" aria-controls="options" role="tab" data-toggle="tab">Drops</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="basic">

            <div class="form-group">
                <label for="alpha" class="col-sm-2 control-label">Alpha Version</label>
                <div class="col-sm-10">
                    <input id="alpha" data-slider-id='alpha' type="text" data-slider-min="12.4" data-slider-max="20"
                           data-slider-step=".1" data-slider-value="{{ $block->alpha }}"/>
                    A <span id="alphaDisplay">{{ $block->alpha }}</span>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('name', 'Block Name', array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::text('name', $block->name, array('class'=>"col-sm-10")) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Class', "Class", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Class', $properties['Class']['options'], $properties['Class']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Material', "Material", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Material', $properties['Material']['options'], $properties['Material']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Shape', "Shape", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Shape', $properties['Shape']['options'], $properties['Shape']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Mesh', "Mesh", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Mesh', $properties['Mesh']['options'], $properties['Mesh']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Model', "Model", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Model', $properties['Model']['options'], $properties['Model']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('CustomIcon', "Custom Icon", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('CustomIcon', $properties['CustomIcon']['options'], $properties['CustomIcon']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('CustomIconTint', 'Custom Icon Tint', array('class' => 'col-sm-2 control-label')) !!}
                <div class="input-group customIconTint">
                    <input type="text" value="{{ $properties['CustomIconTint']['value'] }}" class="form-control" />
                    <span class="input-group-addon"><i></i></span>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('Texture', 'Texture', array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::text('Texture', $properties['Texture']['value'], array('class'=>"col-sm-10")) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Group', "Block Group", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Group', $properties['Group']['options'], $properties['Group']['value']) !!}
            </div>

            <div class="form-group">
                <label for="Weight" class="col-sm-2 control-label">Forge Weight</label>
                <div class="col-sm-10">
                    <input id="Weight" class='slider' data-slider-id='Weight' type="text" data-slider-min="0"
                           data-slider-max="256" data-slider-step="1" data-slider-value="{{ $properties['Weight']['value'] }}"/>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="blockchanges">
            <div class="form-group">
                {!! Form::label('DowngradeBlock', "Downgrade Block to", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('DowngradeBlock', $blocks, $properties['DowngradeBlock']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('StateChange', "State change (block changes)", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('StateChange', $properties['StateChange']['options'], $properties['StateChange']['value']) !!}
            </div>

            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <div id="none" class='stateOptions' style="
                    @if($properties['StateChange']['value']=='none')
                            display:block;
                    @else
                            display:none;
                    @endif
                            ">

                    </div>

                    <div id="UpgradeRated" class='stateOptions' style="
                    @if($properties['UpgradeRated.ToBlock']['value']!='')
                            display:block;
                    @else
                            display:none;
                    @endif
                            ">
                        <div class="form-group">
                            {!! Form::label('UpgradeRated.BlockCombined', "Block Combined", array('class' => 'col-sm-2 control-label')) !!}
                            {!! Form::select('UpgradeRated.BlockCombined', $properties['UpgradeRated.BlockCombined']['options'], $properties['UpgradeRated.BlockCombined']['value']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('UpgradeRated.ToBlock', "To Block", array('class' => 'col-sm-2 control-label')) !!}
                            {!! Form::select('UpgradeRated.ToBlock', $properties['UpgradeRated.ToBlock']['options'], $properties['UpgradeRated.ToBlock']['value']) !!}
                        </div>
                        <div class="form-group">
                            <label for="UpgradeRated.Rate" class="col-sm-2 control-label">Explosion Entity Radius</label>
                            <div class="col-sm-10">
                                <input id="UpgradeRated.Rate" class='slider' data-slider-id='UpgradeRated.Rate' type="text" data-slider-min="1"
                                       data-slider-max="15" data-slider-step="1" data-slider-value="{{ $properties['UpgradeRated.Rate']['value'] }}"/>
                            </div>
                        </div>

                    </div>

                    <div id="PlantGrowing" class='stateOptions' style="
                    @if($properties['StateChange']['value']=='PlantGrowing')
                            display:block
                    @else
                            display:none;
                    @endif  ">
                        <h4>Plant Growth Options</h4>
                        <div class="form-group">
                            {!! Form::label('PlantGrowingNext', "Next block state", array('class' => 'col-sm-2 control-label')) !!}
                            {!! Form::select('PlantGrowingNext', $blocks, $properties['StateChange']['parameters']['Next']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('PlantGrowingGrowthRate', "Next block state", array('class' => 'col-sm-2 control-label')) !!}
                            {!! Form::number('PlantGrowingGrowthRate', $properties['StateChange']['parameters']['GrowthRate']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('PlantGrowingFertileLevel', "Minimum fertile level", array('class' => 'col-sm-2 control-label')) !!}
                            {!! Form::number('PlantGrowingFertileLevel', $properties['StateChange']['parameters']['FertileLevel']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('PlantGrowingIsRandom', "Is Random", array('class' => 'col-sm-2 control-label')) !!}
                            {!! Form::checkbox('PlantGrowingIsRandom', $properties['StateChange']['parameters']['IsRandom'], false) !!}
                        </div>
                    </div>

                    <div id="UpgradeBlock" class='stateOptions' style="
                    @if($properties['StateChange']['value']=='UpgradeBlock')
                            display:block
                    @else
                            display:none;
                    @endif  ">
                        <h4>Upgrade Block Options</h4>
                        <div class="form-group">
                            {!! Form::label('UpgradeBlockToBlock', "Upgrade to this block", array('class' => 'col-sm-2 control-label')) !!}
                            {!! Form::select('UpgradeBlockToBlock', $blocks, $properties['StateChange']['parameters']['ToBlock']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('UpgradeBlockItem', "Upgrade with", array('class' => 'col-sm-2 control-label')) !!}
                            {!! Form::select('UpgradeBlockItem', $items, $properties['StateChange']['parameters']['Item']) !!}
                        </div>
                        <div class="form-group">
                            <label for="UpgradeBlockItemCount" class="col-sm-2 control-label">Number of items needed for upgrade</label>
                            <div class="col-sm-10">
                                <input id="UpgradeBlockItemCount" class='slider' data-slider-id='UpgradeBlockItemCount' type="text" data-slider-min="0"
                                       data-slider-max="100" data-slider-step="1" data-slider-value="{{ $properties['StateChange']['parameters']['ItemCount'] }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="UpgradeBlockUpgradeHitCount" class="col-sm-2 control-label">Number of hits to apply the items</label>
                            <div class="col-sm-10">
                                <input id="UpgradeBlockUpgradeHitCount" class='slider' data-slider-id='UpgradeBlockUpgradeHitCount' type="text" data-slider-min="1"
                                       data-slider-max="4" data-slider-step="1" data-slider-value="{{ $properties['StateChange']['parameters']['UpgradeHitCount'] }}"/>
                            </div>
                        </div>
                    </div>

                    <div id="Explosion" class='stateOptions' style="
                    @if($properties['StateChange']['value']=='Explosion')
                            display:block
                    @else
                            display:none;
                    @endif  ">
                        <h2>Explode Options</h2>
                        <div class="form-group">
                            {!! Form::label('ExplosionParticleIndex', "Which prefab/particle is used (ex: 4)", array('class' => 'col-sm-2 control-label')) !!}
                            {!! Form::number('ExplosionParticleIndex', $properties['StateChange']['parameters']['ParticleIndex']) !!}
                        </div>
                       <div class="form-group">
                            <label for="ExplosionRadiusBlocks" class="col-sm-2 control-label">Explosion Block Radius</label>
                            <div class="col-sm-10">
                                <input id="ExplosionRadiusBlocks" class='slider' data-slider-id='ExplosionRadiusBlocks' type="text" data-slider-min="0"
                                       data-slider-max="100" data-slider-step="1" data-slider-value="{{ $properties['StateChange']['parameters']['RadiusBlocks'] }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ExplosionBlockDamage" class="col-sm-2 control-label">Explosion Block Damage</label>
                            <div class="col-sm-10">
                                <input id="ExplosionBlockDamage" class='slider' data-slider-id='ExplosionBlockDamage' type="text" data-slider-min="0"
                                       data-slider-max="100" data-slider-step="1" data-slider-value="{{ $properties['StateChange']['parameters']['BlockDamage'] }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ExplosionRadiusEntities" class="col-sm-2 control-label">Explosion Entity Radius</label>
                            <div class="col-sm-10">
                                <input id="ExplosionRadiusEntities" class='slider' data-slider-id='ExplosionRadiusEntities' type="text" data-slider-min="0"
                                       data-slider-max="100" data-slider-step="1" data-slider-value="{{ $properties['StateChange']['parameters']['RadiusEntities'] }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ExplosionEntityDamage" class="col-sm-2 control-label">Explosion Entity Damage</label>
                            <div class="col-sm-10">
                                <input id="ExplosionEntityDamage" class='slider' data-slider-id='ExplosionEntityDamage' type="text" data-slider-min="0"
                                       data-slider-max="100" data-slider-step="1" data-slider-value="{{ $properties['StateChange']['parameters']['EntityDamage'] }}"/>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="advanced">
            <div class="form-group">
                {!! Form::label('Place', "Place", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Place', $properties['Place']['options'], $properties['Place']['value']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Collide', "Collide", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Collide', $properties['Collide']['options'], $properties['Collide']['value'], ['multiple']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('LPHardnessScale', "Hardness Scale", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::number('LPHardnessScale', $properties['LPHardnessScale']['value'], ['LPHardnessScale']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('FuelValue', "Fuel Value", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::number('FuelValue', $properties['FuelValue']['value'], ['FuelValue']) !!}
            </div>

            <div class="form-group">
                <label for="ModelOffset" class="col-sm-2 control-label">Model Offset</label>
                <div class="col-sm-10">
                    <small>Offset of the model in X Y Z</small><br />
                    <input id="ModelOffset_x" class='col-sm-2 slider' data-slider-id='ModelOffset_x' type="text" data-slider-min="-1"
                           data-slider-max="1" data-slider-step="0.1" data-slider-value="{{ $properties['ModelOffset']['value'][0] }}"/>
                    <input id="ModelOffset_y" class='col-sm-2 slider' data-slider-id='ModelOffset_y' type="text" data-slider-min="-1"
                           data-slider-max="1" data-slider-step="0.1" data-slider-value="{{ $properties['ModelOffset']['value'][1] }}"/>
                    <input id="ModelOffset_z" class='col-sm-2 slider' data-slider-id='ModelOffset_z' type="text" data-slider-min="-1"
                           data-slider-max="1" data-slider-step="0.1" data-slider-value="{{ $properties['ModelOffset']['value'][2] }}"/>
                </div>
            </div>
            <div class="form-group">
                <label for="MultiBlockDim" class="col-sm-2 control-label">Multi-Block Dimension</label>
                <div class="col-sm-10">
                    <small>Offset of the model in X Y Z</small><br />
                    <input id="MultiBlockDim_x" class='col-sm-2 slider' data-slider-id='MultiBlockDim_x' type="text" data-slider-min="1"
                           data-slider-max="10" data-slider-step="1" data-slider-value="{{ $properties['MultiBlockDim']['value'][0] }}"/>
                    <input id="MultiBlockDim_y" class='col-sm-2 slider' data-slider-id='MultiBlockDim_y' type="text" data-slider-min="1"
                           data-slider-max="10" data-slider-step="1" data-slider-value="{{ $properties['MultiBlockDim']['value'][1] }}"/>
                    <input id="MultiBlockDim_z" class='col-sm-2 slider' data-slider-id='MultiBlockDim_z' type="text" data-slider-min="1"
                           data-slider-max="10" data-slider-step="1" data-slider-value="{{ $properties['MultiBlockDim']['value'][2] }}"/>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('IsDeveloper', "Is Developer (only used for bedRoll01_2", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::checkbox('IsDeveloper', $properties['IsDeveloper']['value'], false) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Tag', "Tag (door and some trees)", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Tag', $properties['Tag']['options'], $properties['Tag']['value']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('ParticleName', "Particle given off", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('ParticleName', $properties['ParticleName']['options'], $properties['ParticleName']['value']) !!}
            </div>

            <div class="form-group">
                <label for="ParticleOffset" class="col-sm-2 control-label">Multi-Block Dimension</label>
                <div class="col-sm-10">
                    <small>Offset of the model in X Y Z</small><br />
                    <input id="ParticleOffset_x" class='col-sm-2 slider' data-slider-id='ParticleOffset_x' type="text" data-slider-min="-1"
                           data-slider-max="1" data-slider-step=".1" data-slider-value="{{ $properties['ParticleOffset']['value'][0] }}"/>
                    <input id="ParticleOffset_y" class='col-sm-2 slider' data-slider-id='ParticleOffset_y' type="text" data-slider-min="-1"
                           data-slider-max="1" data-slider-step=".1" data-slider-value="{{ $properties['ParticleOffset']['value'][1] }}"/>
                    <input id="ParticleOffset_z" class='col-sm-2 slider' data-slider-id='ParticleOffset_z' type="text" data-slider-min="-1"
                           data-slider-max="1" data-slider-step=".1" data-slider-value="{{ $properties['ParticleOffset']['value'][2] }}"/>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('SiblingBlock', "Sibling Block", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('SiblingBlock', $properties['SiblingBlock']['options'], $properties['SiblingBlock']['value']) !!}
            </div>
            <div class="form-group">
                <label for="SiblingDirection" class="col-sm-2 control-label">Multi-Block Dimension</label>
                <div class="col-sm-10">
                    <small>Offset of the model in X Y Z</small><br />
                    <input id="SiblingDirection_x" class='col-sm-2 slider' data-slider-id='SiblingDirection_x' type="text" data-slider-min="-1"
                           data-slider-max="1" data-slider-step=".1" data-slider-value="{{ $properties['SiblingDirection']['value'][0] }}"/>
                    <input id="SiblingDirection_y" class='col-sm-2 slider' data-slider-id='SiblingDirection_y' type="text" data-slider-min="-1"
                           data-slider-max="1" data-slider-step=".1" data-slider-value="{{ $properties['SiblingDirection']['value'][1] }}"/>
                    <input id="SiblingDirection_z" class='col-sm-2 slider' data-slider-id='SiblingDirection_z' type="text" data-slider-min="-1"
                           data-slider-max="1" data-slider-step=".1" data-slider-value="{{ $properties['SiblingDirection']['value'][2] }}"/>
                </div>
            </div>

            <div class="form-group">
                <label for="ShapeMinBB" class="col-sm-2 control-label">Shape Min BB (used for fences and railings)</label>
                <div class="col-sm-10">
                    <small>Offset of the shape in X Y Z</small><br />
                    <input id="ShapeMinBB_x" class='col-sm-2 slider' data-slider-id='ShapeMinBB_x' type="text" data-slider-min="-1"
                           data-slider-max="1" data-slider-step=".1" data-slider-value="{{ $properties['ShapeMinBB']['value'][0] }}"/>
                    <input id="ShapeMinBB_y" class='col-sm-2 slider' data-slider-id='ShapeMinBB_y' type="text" data-slider-min="-1"
                           data-slider-max="1" data-slider-step=".1" data-slider-value="{{ $properties['ShapeMinBB']['value'][1] }}"/>
                    <input id="ShapeMinBB_z" class='col-sm-2 slider' data-slider-id='ShapeMinBB_z' type="text" data-slider-min="-1"
                           data-slider-max="1" data-slider-step=".1" data-slider-value="{{ $properties['ShapeMinBB']['value'][2] }}"/>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="plant">
            <div class="form-group">
                {!! Form::label('IsPlant', "Is this a plant?", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::checkbox('IsPlant', $properties['IsPlant']['value'], false) !!}
            </div>
            <div class="form-group">
                {!! Form::label('CanDecorateOnSlopes', "Can decorate on slopes", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::checkbox('CanDecorateOnSlopes', $properties['CanDecorateOnSlopes']['value'], false) !!}
            </div>
            <div class="form-group">
                {!! Form::label('FallOver', "Can fall over", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::checkbox('FallOver', $properties['FallOver']['value'], false) !!}
            </div>
            <div class="form-group">
                <label for="UpwardsCount" class="col-sm-2 control-label">Upwards count</label>
                <div class="col-sm-10">
                    <small>Used for trees</small><br />
                    <input id="UpwardsCount" class='slider' data-slider-id='UpwardsCount' type="text" data-slider-min="0"
                           data-slider-max="10" data-slider-step="1" data-slider-value="{{ $properties['UpwardsCount']['value'] }}"/>
                </div>
            </div>

            <div class="form-group">
                <label for="BigDecorationRadius" class="col-sm-2 control-label">Big Decoration Radius</label>
                <div class="col-sm-10">
                    <small>Used for trees</small><br />
                    <input id="BigDecorationRadius" class='slider' data-slider-id='BigDecorationRadius' type="text" data-slider-min="0"
                           data-slider-max="10" data-slider-step="1" data-slider-value="{{ $properties['BigDecorationRadius']['value'] }}"/>
                </div>
            </div>
            <div class="form-group">
                <label for="SmallDecorationRadius" class="col-sm-2 control-label">Small Decoration Radius</label>
                <div class="col-sm-10">
                    <small>Used for shrubs</small><br />
                    <input id="SmallDecorationRadius" class='slider' data-slider-id='SmallDecorationRadius' type="text" data-slider-min="0"
                           data-slider-max="10" data-slider-step="1" data-slider-value="{{ $properties['SmallDecorationRadius']['value'] }}"/>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('GrassBlock1', "Only used for wedge curb with grass", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('GrassBlock1', $properties['GrassBlock1']['options'], $properties['GrassBlock1']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('GrassBlock2', "Only used for wedge curb with grass(2nd)", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('GrassBlock2', $properties['GrassBlock2']['options'], $properties['GrassBlock2']['value']) !!}
            </div>
        </div>


        <div role="tabpanel" class="tab-pane" id="door">
            <h4>Doors</h4>
            <div class="form-group">
                {!! Form::label('OpenSound', "Opening Sound", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('OpenSound', $properties['OpenSound']['options'], $properties['OpenSound']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('CloseSound', "Closing Sound", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('CloseSound', $properties['CloseSound']['options'], $properties['CloseSound']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Mesh-Damage-1', "Mesh-Damage-1", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Mesh-Damage-1', $properties['Mesh-Damage-1']['options'], $properties['Mesh-Damage-1']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Mesh-Damage-2', "Mesh-Damage-2", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Mesh-Damage-2', $properties['Mesh-Damage-2']['options'], $properties['Mesh-Damage-2']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Mesh-Damage-3', "Mesh-Damage-3", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Mesh-Damage-3', $properties['Mesh-Damage-3']['options'], $properties['Mesh-Damage-3']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Mesh-Damage-4', "Mesh-Damage-4", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Mesh-Damage-4', $properties['Mesh-Damage-4']['options'], $properties['Mesh-Damage-4']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Mesh-Damage-5', "Mesh-Damage-5", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('Mesh-Damage-5', $properties['Mesh-Damage-5']['options'], $properties['Mesh-Damage-5']['value']) !!}
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="effects">
            <h4>Effects</h4>
            <div class="form-group">
                {!! Form::label('BuffsWhenWalkedOn', "Buff applied when stepped on", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('BuffsWhenWalkedOn', $properties['BuffsWhenWalkedOn']['options'], $properties['BuffsWhenWalkedOn']['value']) !!}
            </div>
            <div class="form-group">
                <label for="Damage" class="col-sm-2 control-label">Damage Dealt when stepped on</label>
                <div class="col-sm-10">
                    <input id="Damage" class='slider' data-slider-id='Damage' type="text" data-slider-min="0"
                           data-slider-max="100" data-slider-step=".1" data-slider-value="{{ $properties['Damage']['value'] }}"/>
                </div>
            </div>
            <div class="form-group">
                <label for="Damage_received" class="col-sm-2 control-label">Damage received by block when stepped on</label>
                <div class="col-sm-10">
                    <input id="Damage_received" class='slider' data-slider-id='Damage_received' type="text" data-slider-min="0"
                           data-slider-max="100" data-slider-step=".1" data-slider-value="{{ $properties['Damage_received']['value'] }}"/>
                </div>
            </div>
            <div class="form-group">
                <label for="Density" class="col-sm-2 control-label">Density of block in the voxel</label>
                <div class="col-sm-10">
                    <small>Example is gore block getting small in the voxel space.</small><br />
                    <input id="Density" class='slider' data-slider-id='Density' type="text" data-slider-min="0"
                           data-slider-max="1" data-slider-step=".1" data-slider-value="{{ $properties['Density']['value'] }}"/>
                </div>
            </div>
            <div class="form-group">
                <label for="HeatMapStrength" class="col-sm-2 control-label">Heat Map Strength</label>
                <div class="col-sm-10">
                    <small>Amount of heat that is added per tick (I believe)</small><br />
                    <input id="HeatMapStrength" class='slider' data-slider-id='HeatMapStrength' type="text" data-slider-min="0"
                           data-slider-max="100" data-slider-step="1" data-slider-value="{{ $properties['HeatMapStrength']['value'] }}"/>
                </div>
            </div>
            <div class="form-group">
                <label for="HeatMapTime" class="col-sm-2 control-label">Heat Map Time</label>
                <div class="col-sm-10">
                    <small>Amount of time in real time seconds for the heat to dissipate (I believe)</small><br />
                    <input id="HeatMapTime" class='slider' data-slider-id='HeatMapTime' type="text" data-slider-min="0"
                           data-slider-max="3600" data-slider-step="5" data-slider-value="{{ $properties['HeatMapTime']['value'] }}"/>
                </div>
            </div>
            <div class="form-group">
                <label for="HeatMapFrequency" class="col-sm-2 control-label">Heat Map Frequency</label>
                <div class="col-sm-10">
                    <small>How often the heat map strength is added to the heat map value. 1 = 1-2 real time minutes (I believe)</small><br />
                    <input id="HeatMapFrequency" class='slider' data-slider-id='HeatMapFrequency' type="text" data-slider-min="1"
                           data-slider-max="15" data-slider-step="1" data-slider-value="{{ $properties['HeatMapFrequency']['value'] }}"/>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="options">
            <h4>Options</h4>
            <div class="form-group">
                {!! Form::label('IsTerrainDecoration', "Decorate Terrain?", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::checkbox('IsTerrainDecoration', $properties['IsTerrainDecoration']['value'], false) !!}
            </div>
            <div class="form-group">
                {!! Form::label('CanPickup', "Can be picked up", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::checkbox('CanPickup', $properties['CanPickup']['value'], true) !!}
            </div>
            <div class="form-group">
                {!! Form::label('CanMobsSpawnOn', "Can mobs spawn on this block", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::checkbox('CanMobsSpawnOn', $properties['CanMobsSpawnOn']['value'], true) !!}
            </div>
            <div class="form-group">
                {!! Form::label('CanPlayersSpawnOn', "Can players spawn on this block", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::checkbox('CanPlayersSpawnOn', $properties['CanPlayersSpawnOn']['value'], true) !!}
            </div>
            <div class="form-group">
                {!! Form::label('FallDamage', "", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::checkbox('FallDamage', $properties['FallDamage']['value'], true) !!}
            </div>
            <div class="form-group">
                <label for="DropScale" class="col-sm-2 control-label">Drop scale</label>
                <div class="col-sm-10">
                    <small>Believe this is the scaling of the block while it is floating.</small><br />
                    <input id="DropScale" class='slider' data-slider-id='DropScale' type="text" data-slider-min="0"
                           data-slider-max="4" data-slider-step=".1" data-slider-value="{{ $properties['DropScale']['value'] }}"/>
                </div>
            </div>
            <div class="form-group">
                <label for="Light" class="col-sm-2 control-label">Light</label>
                <div class="col-sm-10">
                    <small>Controls brightness of illumination when it's switch on in the prefab.</small><br />
                    <input id="Light" class='slider' data-slider-id='DropScale' type="text" data-slider-min="0"
                           data-slider-max="1" data-slider-step=".1" data-slider-value="{{ $properties['Light']['value'] }}"/>
                </div>
            </div>
            <div class="form-group">
                <label for="MovementFactor" class="col-sm-2 control-label">Light</label>
                <div class="col-sm-10">
                    <small>Controls movement of player/mob through block. Also applied in materiels.xml.</small><br />
                    <input id="MovementFactor" class='slider' data-slider-id='MovementFactor' type="text" data-slider-min="0"
                           data-slider-max="1" data-slider-step=".1" data-slider-value="{{ $properties['MovementFactor']['value'] }}"/>
                </div>
            </div>
            <div class="form-group">
                <label for="Map.Color" class="col-sm-2 control-label">Map Color</label>
                <div class="col-sm-10 input-group mapColor">
                        <input id="Map.Color" readonly type="text" value="{{ $properties['Map.Color']['value'] }}" class="form-control" />
                        <span class="input-group-addon"><i></i></span>

                </div>
            </div>
            <div class="form-group">
                {!! Form::label('LiquidMoving', "LiquidMoving (only water/bucket)", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('LiquidMoving', $properties['LiquidMoving']['options'], $properties['LiquidMoving']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('LiquidStatic', "LiquidStatic (only water/bucket)", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('LiquidStatic', $properties['LiquidStatic']['options'], $properties['LiquidStatic']['value']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('LootList', "List to pull loot from if loot class block", array('class' => 'col-sm-2 control-label')) !!}
                {!! Form::select('LootList', $properties['LootList']['options'], $properties['LootList']['value']) !!}
            </div>
        </div>

    </div>


<!-- this form is for making a block. can have MANY iterations -->


{!! Form::hidden('id', $block->id) !!}
{!! Form::hidden('user_id', $user->id) !!}


{!! Form::close() !!}
    </div>
    <div class="col-md-3 col-sm-12">
     <div class="alert alert-success">
         <h4>Information</h4>
         <ul>
             <li>For items that change over time, 1 'tick' is approximately 1-2 minutes of real-time interval, 15 is the max.</li>
         </ul>
     </div>
    </div>
</div>
@endsection

@section('scripts')
    $(document).ready(function() {
        $("select").select2();
        $("#StateChange").on('change',function(){
            $('.stateOptions').hide();
            $('#'+this.value).show();
        });
        $('.customIconTint').colorpicker();
        $('.mapColor').colorpicker({
            format:'rgb'
        });
        $('.slider').slider({

        });
        $('#alpha').slider().on("slide", function(slideEvt) {
            console.log( slideEvt.value );
            $("#alphaDisplay").html(slideEvt.value);
        });
    });

@endsection
