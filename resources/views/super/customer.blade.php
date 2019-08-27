@extends('layouts.layout') @section('content')
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <h1 align="center" class="m-0 text-dark">Customers</h1>
                        <br>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-dark" href="/home">Back to menu</a>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row mb-12">

                    <div class="col-sm-4">

                        <select class="form-control">
                            <option>ALL</option>
                            <option>WDNG</option>
                            <option>WDF</option>
                        </select>

                    </div>
                    <a href="">
                        <i class="right fas fa-question-circle"></i>
                    </a>
                    <div class="col-md-5"></div>
                    <br><br>
                </div>
                <!-- /.row -->

                <!-- /.row -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                            @foreach ($usuarios as $people)
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-link">
                                    <div class="inner">
                                        <div align="center">

                                            <img
                                                class="imgre img-circle elevation-2"
                                                src="{{ asset('assets/dist/img/HillsongThisisliving1.jpg') }}">
                                            <br>
                                        </div>
                                        <div>
                                            <p>{{ $people->name }}</p>
                                            
                                            <p>{{ $people->email }}
                                            
                                            </p>

                                        </div>

                                    </div>
                                    <div align="right">
                                        <a href="#">Inpection<i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <!-- ./col -->
                            @endforeach

                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <p >add Customer</p>

                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="/customercreate" class="small-box-footer">Go
                                        <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- ./col -->
                        </div>

                        <!-- /.row (main row) -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

    </div>
    <!-- /.content-wrapper -->
    <!--Inicia la ventana modal-->

</div>
<!-- ./wrapper -->
@endsection