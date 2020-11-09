@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                        Hi <strong> {{ auth()->user()->name }} </strong>
                        Anda Login Sebagai
                        @can('isKetua')
                        <span class="btn btn-success">Ketua</span>
                
                        @elsecan('isAdmin')
                        <span class="btn btn-info">Admin</span>
                        @endcan
                    </p>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
