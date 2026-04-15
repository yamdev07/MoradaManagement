@extends('template.master')
@section('title', 'Notifications')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

:root {
    /* ---- COULEURS TENANT DYNAMIQUES ---- */
    --tenant-primary: {{ $tenantColors['primary_color'] ?? '#8b4513' }};
    --tenant-secondary: {{ $tenantColors['secondary_color'] ?? '#d2b48c' }};
    --tenant-accent: {{ $tenantColors['accent_color'] ?? '#f59e0b' }};
    
    /* Couleurs de base adaptées */
    --primary: var(--tenant-primary);
    --primary-light: var(--tenant-secondary);
    --primary-soft: rgba(var(--tenant-primary), 0.08);
    --success: var(--tenant-primary);
    --success-light: rgba(var(--tenant-primary), 0.08);
    --warning: var(--tenant-primary);
    --warning-light: rgba(var(--tenant-primary), 0.08);
    --info: var(--tenant-primary);
    --info-light: rgba(var(--tenant-primary), 0.08);
    --dark: var(--tenant-primary);
    
    /* ---- Morada Lodge Palette ---- */
    /* BROWN/BEIGE */
    --m50:  #f9f5f0;
    --m100: #f4f1e8;
    --m200: #e8dcc0;
    --m300: #d4b896;
    --m400: #c19a6b;
    --m500: var(--tenant-primary);
    --m600: var(--tenant-secondary);
    --m700: var(--tenant-accent);
    --m800: #4a1f08;
    --m900: #3a1504;
    /* BLANC / SURFACE */
    --white:    #ffffff;
    --surface:  #f9f5f0;
    --surface2: #f4f1e8;
    /* GRIS */
    --s50:  #fafafa;
    --s100: #f5f5f5;
    --s200: #e5e5e5;
    --s300: #d4d4d4;
    --s400: #a3a3a3;
    --s500: #737373;
    --s600: #525252;
    --s700: #404040;
    --s800: #262626;
    --s900: #171717;

    --shadow-xs: 0 1px 2px rgba(0,0,0,.04);
    --shadow-sm: 0 1px 6px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --shadow-md: 0 4px 16px rgba(0,0,0,.08), 0 2px 4px rgba(0,0,0,.04);
    --shadow-lg: 0 12px 40px rgba(0,0,0,.10), 0 4px 12px rgba(0,0,0,.05);

    --r:   8px;
    --rl:  14px;
    --rxl: 20px;
    --transition: all .2s cubic-bezier(.4,0,.2,1);
    --font: 'DM Sans', system-ui, sans-serif;
    --mono: 'DM Mono', monospace;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.notifications-page {
    padding: 28px 32px 64px;
    background: var(--surface);
    min-height: 100vh;
    font-family: var(--font);
    color: var(--s800);
}

/* ── Animations ── */
@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes scaleIn {
    from { opacity: 0; transform: scale(.96); }
    to   { opacity: 1; transform: scale(1); }
}
.anim-1 { animation: fadeSlide .4s ease both; }
.anim-2 { animation: fadeSlide .4s .08s ease both; }
.anim-3 { animation: fadeSlide .4s .16s ease both; }
.anim-4 { animation: fadeSlide .4s .24s ease both; }
.anim-5 { animation: fadeSlide .4s .32s ease both; }
.anim-6 { animation: fadeSlide .4s .40s ease both; }

/* ══════════════════════════════════════════════
   BREADCRUMB
══════════════════════════════════════════════ */
.notifications-breadcrumb {
    display: flex; align-items: center; gap: 6px;
    font-size: .8rem; color: var(--s400);
    margin-bottom: 20px;
}
.notifications-breadcrumb a {
    color: var(--s400); text-decoration: none;
    transition: var(--transition);
}
.notifications-breadcrumb a:hover { color: var(--m600); }
.notifications-breadcrumb .sep { color: var(--s300); }
.notifications-breadcrumb .current { color: var(--s600); font-weight: 500; }

/* ══════════════════════════════════════════════
   HEADER
══════════════════════════════════════════════ */
.notifications-header {
    display: flex; align-items: center;
    justify-content: space-between; flex-wrap: wrap;
    gap: 16px; margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 1.5px solid var(--s100);
}
.notifications-brand { display: flex; align-items: center; gap: 14px; }
.notifications-brand-icon {
    width: 48px; height: 48px;
    background: var(--m600); border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 1.1rem; flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(139,69,19,.35);
}
.notifications-header-title {
    font-size: 1.4rem; font-weight: 700;
    color: var(--s900); line-height: 1.2; letter-spacing: -.3px;
}
.notifications-header-title em { font-style: normal; color: var(--m600); }
.notifications-header-sub {
    font-size: .8rem; color: var(--s400); margin-top: 3px;
    display: flex; align-items: center; gap: 8px;
}
.notifications-header-sub i { color: var(--m500); }
.notifications-header-actions { display: flex; align-items: center; gap: 10px; }

/* ══════════════════════════════════════════════
   BOUTONS
══════════════════════════════════════════════ */
.btn-db {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 16px; border-radius: var(--r);
    font-size: .8rem; font-weight: 500; border: none;
    cursor: pointer; transition: var(--transition);
    text-decoration: none; white-space: nowrap; line-height: 1;
    font-family: var(--font);
}
.btn-db-primary {
    background: var(--m600); color: white;
    box-shadow: 0 2px 10px rgba(139,69,19,.3);
}
.btn-db-primary:hover {
    background: var(--m700); color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(139,69,19,.35);
    text-decoration: none;
}
.btn-db-ghost {
    background: var(--white); color: var(--s600);
    border: 1.5px solid var(--s200);
}
.btn-db-ghost:hover {
    background: var(--m50); border-color: var(--m300);
    color: var(--m700); text-decoration: none;
}
.btn-db-outline-primary {
    background: transparent; color: var(--m600);
    border: 1.5px solid var(--m200);
}
.btn-db-outline-primary:hover {
    background: var(--m50); color: var(--m700);
    border-color: var(--m300); transform: translateY(-1px);
}

/* ══════════════════════════════════════════════
   TIMELINE
══════════════════════════════════════════════ */
.timelines {
    display: flex; flex-direction: column; gap: 40px;
}

.timeline__group {
    position: relative;
}

.timeline__year {
    display: inline-block;
    font-size: .9rem;
    font-weight: 600;
    color: var(--m600);
    background: var(--m100);
    padding: 6px 20px;
    border-radius: 30px;
    border: 1.5px solid var(--m200);
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: .5px;
}

.timeline__cards {
    display: flex; flex-direction: column; gap: 12px;
    position: relative;
    padding-left: 30px;
}

.timeline__cards::before {
    content: '';
    position: absolute;
    left: 10px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--m200);
    border-radius: 2px;
}

/* ══════════════════════════════════════════════
   NOTIFICATION CARD
══════════════════════════════════════════════ */
.notification-card {
    background: var(--white);
    border: 1.5px solid var(--s100);
    border-radius: var(--rl);
    padding: 20px;
    position: relative;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.notification-card:hover {
    transform: translateX(5px);
    box-shadow: var(--shadow-md);
    border-color: var(--m200);
}

.notification-card--unread {
    border-left: 4px solid var(--m500);
    background: linear-gradient(to right, var(--m50), var(--white));
}

.notification-card--read {
    border-left: 4px solid var(--s300);
    opacity: 0.8;
}

.notification-card__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.notification-card__time {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: .75rem;
    color: var(--s400);
    font-family: var(--mono);
}

.notification-card__time i {
    color: var(--m500);
    font-size: .7rem;
}

.notification-card__badge {
    font-size: .65rem;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: .5px;
}

.badge-unread {
    background: var(--m100);
    color: var(--m700);
    border: 1px solid var(--m200);
}

.badge-read {
    background: var(--s100);
    color: var(--s600);
    border: 1px solid var(--s200);
}

.notification-card__content {
    padding-left: 0;
}

.notification-card__message {
    font-size: .9rem;
    color: var(--s800);
    margin-bottom: 16px;
    line-height: 1.5;
}

.notification-card__footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 16px;
    padding-top: 12px;
    border-top: 1px solid var(--s100);
}

.notification-card__link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 16px;
    background: var(--m50);
    color: var(--m600);
    border: 1.5px solid var(--m200);
    border-radius: var(--r);
    font-size: .75rem;
    font-weight: 500;
    text-decoration: none;
    transition: var(--transition);
}

.notification-card__link:hover {
    background: var(--m100);
    color: var(--m700);
    border-color: var(--m300);
    transform: translateY(-2px);
    text-decoration: none;
}

.notification-card__meta {
    font-size: .7rem;
    color: var(--s400);
    display: flex;
    align-items: center;
    gap: 6px;
}

/* ══════════════════════════════════════════════
   EMPTY STATE
══════════════════════════════════════════════ */
.empty-state {
    padding: 48px 24px; text-align: center;
    background: var(--white);
    border: 1.5px solid var(--s100);
    border-radius: var(--rl);
}
.empty-icon {
    width: 64px; height: 64px; background: var(--m50);
    border-radius: 50%; display: flex; align-items: center;
    justify-content: center; font-size: 1.5rem; color: var(--m300);
    margin: 0 auto 16px; border: 2px solid var(--m100);
}
.empty-title {
    font-size: .9rem; font-weight: 600; color: var(--s700);
    margin-bottom: 4px;
}
.empty-text {
    font-size: .75rem; color: var(--s400);
}

/* ══════════════════════════════════════════════
   STAT CARD (pour le header)
══════════════════════════════════════════════ */
.stats-mini {
    display: flex; gap: 10px;
}
.stat-mini-item {
    display: flex; align-items: center; gap: 8px;
    padding: 8px 14px;
    background: var(--white);
    border: 1.5px solid var(--s100);
    border-radius: var(--rl);
}
.stat-mini-dot {
    width: 8px; height: 8px; border-radius: 50%;
}
.dot-unread { background: var(--m500); }
.dot-read { background: var(--s400); }
.stat-mini-label {
    font-size: .7rem; color: var(--s600);
}
.stat-mini-value {
    font-size: .9rem; font-weight: 600; color: var(--s800);
    font-family: var(--mono);
    margin-left: 4px;
}

/* ══════════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════════ */
@media(max-width:768px){
    .notifications-page{ padding: 20px; }
    .notifications-header{ flex-direction: column; align-items: flex-start; }
    .stats-mini{ width: 100%; }
    .timeline__cards{ padding-left: 20px; }
    .timeline__cards::before{ left: 5px; }
}
</style>

<div class="notifications-page">
    <!-- Breadcrumb -->
    <div class="notifications-breadcrumb anim-1">
        <a href="{{ route('dashboard.index') }}"><i class="fas fa-home fa-xs"></i> Dashboard</a>
        <span class="sep"><i class="fas fa-chevron-right fa-xs"></i></span>
        <span class="current">Notifications</span>
    </div>

    <!-- Header -->
    <div class="notifications-header anim-2">
        <div class="notifications-brand">
            <div class="notifications-brand-icon"><i class="fas fa-bell"></i></div>
            <div>
                <h1 class="notifications-header-title">Centre de <em>notifications</em></h1>
                <p class="notifications-header-sub">
                    <i class="fas fa-bell me-1"></i> Restez informé des activités importantes
                </p>
            </div>
        </div>
        <div class="notifications-header-actions">
            <div class="stats-mini">
                <div class="stat-mini-item">
                    <span class="stat-mini-dot dot-unread"></span>
                    <span class="stat-mini-label">Non lues</span>
                    <span class="stat-mini-value">{{ auth()->user()->unreadNotifications->count() }}</span>
                </div>
                <div class="stat-mini-item">
                    <span class="stat-mini-dot dot-read"></span>
                    <span class="stat-mini-label">Lues</span>
                    <span class="stat-mini-value">{{ auth()->user()->readNotifications->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline -->
    <div class="timelines anim-3">

        <!-- Unread Section -->
        <div class="timeline__group">
            <span class="timeline__year">
                <i class="fas fa-circle me-2" style="color:var(--m500); font-size:.5rem;"></i>
                Non lues
            </span>
            <div class="timeline__cards">
                @forelse (auth()->user()->unreadNotifications as $notification)
                    <div class="notification-card notification-card--unread">
                        <div class="notification-card__header">
                            <div class="notification-card__time">
                                <i class="fas fa-clock"></i>
                                {{ Helper::dateFormatTimeNoYear($notification->created_at) }}
                            </div>
                            <span class="notification-card__badge badge-unread">
                                <i class="fas fa-circle me-1" style="font-size:.5rem;"></i>
                                Nouveau
                            </span>
                        </div>
                        <div class="notification-card__content">
                            <p class="notification-card__message">
                                {{ $notification->data['message'] ?? 'Nouvelle notification' }}
                            </p>
                        </div>
                        <div class="notification-card__footer">
                            <a href="{{ route('notification.routeTo', $notification->id) }}" 
                               class="notification-card__link"
                               onclick="event.preventDefault(); markAsReadAndRedirect('{{ $notification->id }}', '{{ $notification->data['url'] ?? '#' }}')">
                                <i class="fas fa-eye"></i>
                                Voir les détails
                            </a>
                            <span class="notification-card__meta">
                                <i class="fas fa-info-circle"></i>
                                Cliquez pour marquer comme lu
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-bell-slash"></i>
                        </div>
                        <p class="empty-title">Aucune notification non lue</p>
                        <p class="empty-text">Vous n'avez pas de nouvelles notifications</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Read Section -->
        <div class="timeline__group">
            <span class="timeline__year">
                <i class="fas fa-circle me-2" style="color:var(--s400); font-size:.5rem;"></i>
                Lues
            </span>
            <div class="timeline__cards">
                @forelse (auth()->user()->readNotifications as $notification)
                    <div class="notification-card notification-card--read">
                        <div class="notification-card__header">
                            <div class="notification-card__time">
                                <i class="fas fa-clock"></i>
                                {{ Helper::dateFormatTimeNoYear($notification->created_at) }}
                            </div>
                            <span class="notification-card__badge badge-read">
                                <i class="fas fa-check me-1"></i>
                                Lu
                            </span>
                        </div>
                        <div class="notification-card__content">
                            <p class="notification-card__message">
                                {{ $notification->data['message'] ?? 'Notification' }}
                            </p>
                        </div>
                        <div class="notification-card__footer">
                            <a href="{{ $notification->data['url'] ?? '#' }}" class="notification-card__link">
                                <i class="fas fa-eye"></i>
                                Voir les détails
                            </a>
                            <span class="notification-card__meta">
                                <i class="fas fa-check-circle" style="color:var(--m500);"></i>
                                Déjà consulté
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <p class="empty-title">Aucune notification</p>
                        <p class="empty-text">Vous n'avez pas encore de notifications</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

@endsection

@section('footer')
<script>
// Fonction pour marquer comme lu et rediriger
function markAsReadAndRedirect(notificationId, url) {
    fetch(`/notification-to/${notificationId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            window.location.href = url;
        } else {
            console.error('Erreur lors du marquage de la notification');
            window.location.href = url;
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        window.location.href = url;
    });
}

// Marquer toutes comme lues (optionnel)
document.addEventListener('DOMContentLoaded', function() {
    // Vous pouvez ajouter un bouton "Tout marquer comme lu" ici
});
</script>
@endsection