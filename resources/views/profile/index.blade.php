@extends('layouts.master')

@section('page-css')
    
@endsection

@section('main-content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Blank</h1>
        <ul>
            <li><a href="">Pages</a></li>
            <li>Blank</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div><!-- end of main-content -->
    <section class="ul-contact-detail">
        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card o-hidden"><img class="d-block w-100" src="../../dist-assets/images/products/iphone-1.jpg" alt="First slide" />
                    <div class="card-body">
                        <div class="ul-contact-detail__info">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="ul-contact-detail__info-1">
                                        <h5>Nama</h5><span>{{ $profile->name }}</span>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="ul-contact-detail__info-1">
                                        <h5>NIP</h5><span>{{ $profile->nip }}</span>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="ul-contact-detail__info-1">
                                        <h5>Email</h5><span>{{ $profile->email }}</span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-8">
                <!--  begin::basic-tab -->
                <div class="card mb-4">
                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                            </div>
                        </nav>
                        <div class="tab-content ul-tab__content" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="row">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="ul-contact-detail__profile">
                                            <div class="ul-contact-detail__inner-profile">
                                                <h4 class="heading">Full Name</h4><span class="tetx-muted">Timity Clarkson</span>
                                            </div>
                                            <div class="ul-contact-detail__inner-profile">
                                                <h4 class="heading">Full Name</h4><span class="tetx-muted">Timity Clarkson</span>
                                            </div>
                                            <div class="ul-contact-detail__inner-profile">
                                                <h4 class="heading">Full Name</h4><span class="tetx-muted">Timity Clarkson</span>
                                            </div>
                                            <div class="ul-contact-detail__inner-profile">
                                                <h4 class="heading">Full Name</h4><span class="tetx-muted">Timity Clarkson</span>
                                            </div>
                                        </div>
                                        <div class="custom-separator"></div>
                                    </div>
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="ul-contact-dwtail__profile-swcription">
                                            <p class="mt-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-12">
                                        <h4 class="card-title mb-3">Skills</h4>
                                        <div class="custom-separator"></div><span>Wordpress</span>
                                        <div class="progress mb-3 mt-2">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">10%</div>
                                        </div><span>HTML 5</span>
                                        <div class="progress mb-3 mt-2">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                        </div><span>React.js</span>
                                        <div class="progress mb-3 mt-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                        </div><span>Photoshop</span>
                                        <div class="progress mb-3 mt-2">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  end::basic-tab -->
            </div>
        </div>
    </section>

</div>

@endsection

@section('page-js')
    
@endsection