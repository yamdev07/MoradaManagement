@extends('frontend.layouts.master')

@section('title', 'Test Simple')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Test Simple</h3>
                </div>
                <div class="card-body">
                    <h4>Utilisateur connecté : {{ Auth::user() ? Auth::user()->name : 'Non connecté' }}</h4>
                    
                    @if(Auth::user())
                        <p>Tenant ID : {{ Auth::user()->tenant_id ?? 'Aucun' }}</p>
                        <p>Email : {{ Auth::user()->email }}</p>
                    @endif
                    
                    <hr>
                    
                    <h5>Liens de test</h5>
                    <a href="{{ url('/') }}" class="btn btn-primary">Accueil</a><br><br>
                    <a href="{{ url('/test-navigation') }}" class="btn btn-info">Test Navigation</a><br><br>
                    
                    @if(Auth::user() && Auth::user()->tenant_id)
                        @php
                            $tenant = \App\Models\Tenant::find(Auth::user()->tenant_id);
                        @endphp
                        @if($tenant)
                            <a href="{{ url('/tenant/' . $tenant->subdomain . '/dashboard') }}" class="btn btn-success">
                                Dashboard {{ $tenant->name }}
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
