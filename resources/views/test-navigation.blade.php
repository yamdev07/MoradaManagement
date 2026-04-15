@extends('frontend.layouts.master')

@section('title', 'Test Navigation')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Test de Navigation</h3>
                </div>
                <div class="card-body">
                    <h4>Liens normaux (devraient rester dans le même onglet)</h4>
                    <a href="{{ url('/') }}" class="btn btn-primary mb-2">Page d'accueil</a><br><br>
                    <a href="{{ url('/tenant/benin/dashboard') }}" class="btn btn-success mb-2">Dashboard Bénin</a><br><br>
                    
                    <h4>Liens avec target="_blank (devraient ouvrir un nouvel onglet)</h4>
                    <a href="{{ url('/') }}" target="_blank" class="btn btn-warning mb-2">Page d'accueil (nouvel onglet)</a><br><br>
                    
                    <h4>Boutons JavaScript</h4>
                    <button onclick="window.location.href='{{ url('/') }}'" class="btn btn-info mb-2">Navigation JS</button><br><br>
                    <button onclick="window.open('{{ url('/') }}', '_blank')" class="btn btn-danger mb-2">Nouvel onglet JS</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
console.log('Page de test Laravel chargée');

// Intercepter tous les clics
document.addEventListener('click', function(e) {
    console.log('Click detected:', e.target);
    console.log('Href:', e.target.href);
    console.log('Target:', e.target.target);
    console.log('Current URL:', window.location.href);
});

// Vérifier si des scripts modifient les liens
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM chargé');
    
    // Vérifier tous les liens
    const links = document.querySelectorAll('a');
    links.forEach((link, index) => {
        console.log(`Lien ${index}:`, link.href, link.target);
    });
});
</script>
@endsection
