@extends('layouts.master')

@section('title', 'Inicial')

@section('content')
	   <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix" id="indicators">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">VERIFICATIONS</div>
                            <div class="number" >@{{verify_count}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">FAIL SITES</div>
                            <div class="number ">@{{verify_fails}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">ALERT DELIVERED</div>
                            <div class="number">@{{alerts}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">TEAM</div>
                            <div class="number">@{{person}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>CPU USAGE (%)</h2>
                            <div class="pull-right">
                                <div class="switch panel-switch-btn">
                                    <span class="m-r-10 font-12">REAL TIME</span>
                                    <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="real_time_chart" class="dashboard-flot-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
           
            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" id="last_verifications">
                    <div class="card">
                        <div class="header">
                            <h2>LAST VERIFICATIONS <small v-show="is_refreshing" >Updating...</small></h2>

                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a v-on:click="refresh">Refresh</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Site</th>
                                            <th>Status</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="verify in verifies">
                                            <td>@{{ verify.id}}</td>
                                            <td>@{{ verify.site.label}}</td>
                                            <td><span class="label" :class="[ (verify.status == '404' || verify == '0') ? 'bg-red' : 'bg-green']" >@{{verify.status}}</span></td>
                                            <td>@{{verify.verification_at}}</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->

                  <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" id="recent_fails">
                    <div class="card">
                        <div class="header">
                            <h2>RECENT FAILS <small v-show="is_refreshing">Updating...</small></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a v-on:click="refresh">Refresh</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Site</th>
                                            <th>Error</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="fail in fails">
                                            <td>@{{ fail.id}}</td>
                                            <td>@{{ fail.site.label}}</td>
                                            <td><span class="label bg-red">@{{fail.status}}</span></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>
        </div>
@stop

@section('css')

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
@stop

@section('js')
    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="plugins/chartjs/Chart.bundle.js"></script>
    
    <script>

        var REFRESH_INTERVAL = 1000 * 10; 
        
        new Vue({
            el: '#last_verifications', 

            data:{
                verifies: [], 
                is_refreshing: false
            }, 

            mounted: function(){
              this.refresh(); 
              this.interval(); 
            }, 

            methods:{
                refresh: function(){
                    var self = this; 

                    this.is_refreshing = true; 

                    $.post('/h/lastVerifications',{}).
                    done(function(data){
                        self.verifies = data.msg;
                        self.is_refreshing = false;  
                    });                          
                }, 

                interval: function(){
                    setInterval(this.refresh, REFRESH_INTERVAL); 
                }
            }
        }); 


        new Vue({
            el: '#indicators', 

            data:{
                verify_count: 0, 
                verify_fails: 0, 
                person      : 0, 
                alerts      : 0
            }, 

            created: function(){
                var self = this; 

                $.post('/h/indicators',{}).
                done(function(data){
                    self.verify_count = data.msg.verify_count; 
                    self.verify_fails = data.msg.verify_fails; 
                    self.person       = data.msg.person; 
                }); 
            }
        }); 

        new Vue({
            el: '#recent_fails', 

            data:{
                fails: [], 
                is_refreshing: false
            }, 

            created: function(){
                this.refresh(); 
                this.interval(); 
            }, 

            methods: {
                refresh: function(){
                    var self = this; 

                    this.is_refreshing = true; 

                    $.post('/h/recentFails',{}).
                    done(function(data){
                        self.fails = data.msg; 
                        self.is_refreshing = false; 
                    }); 
                }, 

                interval: function(){
                    setInterval(this.refresh, REFRESH_INTERVAL); 
                }
            }
        })
    </script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>


@stop