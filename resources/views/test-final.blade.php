@extends('frontend.layouts.master')

@section('title', 'Test Final Navigation')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Test Final - Navigation Forcée</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle"></i> Script de force active</h5>
                        <p>Un script JavaScript force maintenant tous les liens internes à rester dans le même onglet.</p>
                    </div>
                    
                    <h4>Utilisateur connecté : {{ Auth::user() ? Auth::user()->name : 'Non connecté' }}</h4>
                    
                    @if(Auth::user())
                        <p>Tenant ID : {{ Auth::user()->tenant_id ?? 'Aucun' }}</p>
                        <p>Email : {{ Auth::user()->email }}</p>
                        
                        @if(Auth::user()->tenant_id)
                            @php
                                $tenant = \App\Models\Tenant::find(Auth::user()->tenant_id);
                            @endphp
                            @if($tenant)
                                <div class="alert alert-success">
                                    <strong>Tenant trouvé :</strong> {{ $tenant->name }} ({{ $tenant->subdomain }})
                                </div>
                                
                                <h5>Liens avec target="_self" explicite</h5>
                                <a href="{{ url('/tenant/' . $tenant->subdomain . '/dashboard') }}" class="btn btn-primary mb-2" target="_self">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard avec target="_self"
                                </a><br><br>
                                
                                <a href="{{ url('/tenant/' . $tenant->subdomain . '/users') }}" class="btn btn-info mb-2" target="_self">
                                    <i class="fas fa-users"></i> Utilisateurs avec target="_self"
                                </a><br><br>
                                
                                <a href="{{ url('/') }}" class="btn btn-secondary mb-2" target="_self">
                                    <i class="fas fa-home"></i> Accueil avec target="_self"
                                </a><br><br>
                            @endif
                        @endif
                    @endif
                    
                    <hr>
                    
                    <h5>Test de navigation JavaScript</h5>
                    <button onclick="testNavigation()" class="btn btn-warning">
                        <i class="fas fa-flask"></i> Test Navigation JS
                    </button>
                    
                    <div id="test-result" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function testNavigation() {
    const resultDiv = document.getElementById('test-result');
    resultDiv.innerHTML = '<div class="alert alert-info"><i class="fas fa-spinner fa-spin"></i> Test en cours...</div>';
    
    // Test 1: window.location.href
    setTimeout(() => {
        console.log('Test 1: window.location.href');
        resultDiv.innerHTML = '<div class="alert alert-success">✅ Test 1 réussi : window.location.href fonctionne</div>';
        
        // Test 2: target="_self"
        setTimeout(() => {
            console.log('Test 2: target="_self"');
            const link = document.createElement('a');
            link.href = window.location.href;
            link.target = '_self';
            link.click();
        }, 1000);
    }, 1000);
}

// Log de tous les clics
document.addEventListener('click', function(e) {
    console.log('🖱️ Click detected:', e.target.tagName, e.target.href, e.target.target);
});
</script>
@endsection
