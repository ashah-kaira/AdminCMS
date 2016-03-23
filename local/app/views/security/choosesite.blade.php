<?php $value = Session::get('UserSite');?>
@extends('layouts.choosesitemaster')
@section('Title','ChooseSite')

@stop
@section('css')
@stop
@section('content')
    <main id="main" role="main">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">

            <div class="row" align="center" style="padding: 15px;">

                <?php if(isset($value)){
                foreach($value as $user){?>
                <a href="<?php echo URL::to('/').'/dashboard/'.$user->EncryptSiteID;?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat red">
                            <div class="visual">
                                <i class="fa fa-comments"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span data-counter="counterup" data-value="1349"></span>
                                </div>
                                <div class="desc"><?php echo $user->SiteName ;?></div>
                            </div>

                        </div>
                    </div>
                 </a>
                <?php } }?>
            </div>

        </div>
        <!-- END CONTENT BODY -->
    </main>
@stop

@section('script')
@stop