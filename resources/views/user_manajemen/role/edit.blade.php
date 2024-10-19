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
    <form action="{{ route('role.update', ['role'=>$role->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <button class="btn btn-primary ripple mb-3" type="submit">Submit</button>

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="name">Nama Role<span style="color: red">*</span></label>
                                <textarea class="form-control" id="name" rows="2" name="name" required>{{ $role->name }}</textarea>
                            </div>

                            <div class="col-md-12 form-group mb-3">
                                <div class="row justify-content-left">
                                    {{-- user manajemen --}}
                                    <div class="col-md-4">
                                        <div class="card card-profile-1 mb-4">
                                            <div class="card-body text-center">
                                                <h5 class="m-3">User Manajemen</h5>
                                                <div class="text-left">
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[0]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[0]->name }}" {{ $role->hasPermissionTo( $permissions[0]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[1]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[1]->name }}" {{ $role->hasPermissionTo( $permissions[1]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[2]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[2]->name }}" {{ $role->hasPermissionTo( $permissions[2]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[3]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[3]->name }}" {{ $role->hasPermissionTo( $permissions[3]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[4]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[4]->name }}" {{ $role->hasPermissionTo( $permissions[4]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[5]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[5]->name }}" {{ $role->hasPermissionTo( $permissions[5]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[6]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[6]->name }}" {{ $role->hasPermissionTo( $permissions[6]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[7]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[7]->name }}" {{ $role->hasPermissionTo( $permissions[7]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[8]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[8]->name }}" {{ $role->hasPermissionTo( $permissions[8]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[9]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[9]->name }}" {{ $role->hasPermissionTo( $permissions[9]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- data master --}}
                                    <div class="col-md-4">
                                        <div class="card card-profile-1 mb-4">
                                            <div class="card-body text-center">
                                                <h5 class="m-3">Data Master</h5>
                                                <div class="text-left">
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[34]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[34]->name }}" {{ $role->hasPermissionTo( $permissions[34]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[35]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[35]->name }}" {{ $role->hasPermissionTo( $permissions[35]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[36]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[36]->name }}" {{ $role->hasPermissionTo( $permissions[36]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[37]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[37]->name }}" {{ $role->hasPermissionTo( $permissions[37]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[38]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[38]->name }}" {{ $role->hasPermissionTo( $permissions[38]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[39]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[39]->name }}" {{ $role->hasPermissionTo( $permissions[39]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[40]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[40]->name }}" {{ $role->hasPermissionTo( $permissions[40]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[41]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[41]->name }}" {{ $role->hasPermissionTo( $permissions[41]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[42]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[42]->name }}" {{ $role->hasPermissionTo( $permissions[42]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[43]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[43]->name }}" {{ $role->hasPermissionTo( $permissions[43]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[44]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[44]->name }}" {{ $role->hasPermissionTo( $permissions[44]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[45]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[45]->name }}" {{ $role->hasPermissionTo( $permissions[45]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[46]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[46]->name }}" {{ $role->hasPermissionTo( $permissions[46]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>                                                   
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- badan penyelenggara --}}
                                    <div class="col-md-4">
                                        <div class="card card-profile-1 mb-4">
                                            <div class="card-body text-center">
                                                <h5 class="m-3">Badan Penyelenggara</h5>
                                                <div class="text-left">
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[10]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[10]->name }}" {{ $role->hasPermissionTo( $permissions[10]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[11]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[11]->name }}" {{ $role->hasPermissionTo( $permissions[11]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[12]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[12]->name }}" {{ $role->hasPermissionTo( $permissions[12]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[13]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[13]->name }}" {{ $role->hasPermissionTo( $permissions[13]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[14]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[14]->name }}" {{ $role->hasPermissionTo( $permissions[14]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[15]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[15]->name }}" {{ $role->hasPermissionTo( $permissions[15]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[16]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[16]->name }}" {{ $role->hasPermissionTo( $permissions[16]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[17]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[17]->name }}" {{ $role->hasPermissionTo( $permissions[17]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[18]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[18]->name }}" {{ $role->hasPermissionTo( $permissions[18]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[19]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[19]->name }}" {{ $role->hasPermissionTo( $permissions[19]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    {{-- perguruan tinggi --}}
                                    <div class="col-md-4">
                                        <div class="card card-profile-1 mb-4">
                                            <div class="card-body text-center">
                                                <h5 class="m-3">Perguruan Tinggi</h5>
                                                <div class="text-left">

                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[20]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[20]->name }}" {{ $role->hasPermissionTo( $permissions[20]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[21]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[21]->name }}" {{ $role->hasPermissionTo( $permissions[21]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[22]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[22]->name }}" {{ $role->hasPermissionTo( $permissions[22]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[23]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[23]->name }}" {{ $role->hasPermissionTo( $permissions[23]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[24]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[24]->name }}" {{ $role->hasPermissionTo( $permissions[24]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[25]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[25]->name }}" {{ $role->hasPermissionTo( $permissions[25]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[26]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[26]->name }}" {{ $role->hasPermissionTo( $permissions[26]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[27]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[27]->name }}" {{ $role->hasPermissionTo( $permissions[27]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[28]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[28]->name }}" {{ $role->hasPermissionTo( $permissions[28]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[29]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[29]->name }}"{{ $role->hasPermissionTo( $permissions[29]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- pimpinan perti --}}
                                    <div class="col-md-4">
                                        <div class="card card-profile-1 mb-4">
                                            <div class="card-body text-center">
                                                <h5 class="m-3">Pimpinan Perguruan Tinggi</h5>
                                                <div class="text-left">
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[30]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[30]->name }}" {{ $role->hasPermissionTo( $permissions[30]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[31]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[31]->name }}" {{ $role->hasPermissionTo( $permissions[31]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[32]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[32]->name }}" {{ $role->hasPermissionTo( $permissions[32]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[33]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[33]->name }}" {{ $role->hasPermissionTo( $permissions[33]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- program studi --}}
                                    <div class="col-md-4">
                                        <div class="card card-profile-1 mb-4">
                                            <div class="card-body text-center">
                                                <h5 class="m-3">Progam Studi</h5>
                                                <div class="text-left">
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[47]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[47]->name }}" {{ $role->hasPermissionTo( $permissions[47]->name) ? 'checked' : '' }}/><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[48]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[48]->name }}" {{ $role->hasPermissionTo( $permissions[48]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[49]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[49]->name }}" {{ $role->hasPermissionTo( $permissions[49]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                    <label class="switch pr-5 switch-success mb-3 mr-3"><span>{{ $permissions[50]->name }}</span>
                                                        <input type="checkbox" name="permissions[]" value="{{ $permissions[50]->name }}" {{ $role->hasPermissionTo( $permissions[50]->name) ? 'checked' : '' }} /><span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- @foreach ($permissions as $permission)
        {{ $loop->index }} | {{ $permission->id }} | {{ $permission->name }} <br>
    @endforeach --}}
</div>

@endsection

@section('page-js')
    
@endsection