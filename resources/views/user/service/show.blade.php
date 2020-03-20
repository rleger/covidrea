@extends('layouts.app')

@section('page_title', 'Mettre à jour mes lits')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        {{ $services }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
