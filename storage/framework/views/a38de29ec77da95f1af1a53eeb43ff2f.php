
<?php $__env->startSection('title', 'Équipements'); ?>
<?php $__env->startSection('content'); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

:root {
    /* ── Morada Lodge Palette ── */
    /* BROWN/BEIGE */
    --m50:  #f9f5f0;
    --m100: #f4f1e8;
    --m200: #e8dcc0;
    --m300: #d4b896;
    --m400: #c19a6b;
    --m500: #8b4513;
    --m600: #704838;
    --m700: #5a2b0d;
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

* { box-sizing: border-box; margin: 0; padding: 0; }

.facility-page {
    background: var(--surface);
    min-height: 100vh;
    padding: 28px 32px 64px;
    font-family: var(--font);
    color: var(--s800);
}

/* ── Animations ── */
@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}
.anim-1 { animation: fadeSlide .4s ease both; }
.anim-2 { animation: fadeSlide .4s .08s ease both; }

/* ══════════════════════════════════════════════
   BREADCRUMB
══════════════════════════════════════════════ */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: .8rem;
    color: var(--s400);
    margin-bottom: 20px;
}
.breadcrumb a {
    color: var(--s400);
    text-decoration: none;
    transition: var(--transition);
}
.breadcrumb a:hover {
    color: var(--g600);
}
.breadcrumb .sep {
    color: var(--s300);
}
.breadcrumb .current {
    color: var(--s600);
    font-weight: 500;
}

/* ══════════════════════════════════════════════
   HEADER
══════════════════════════════════════════════ */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 16px;
    padding-bottom: 24px;
    border-bottom: 1.5px solid var(--s100);
}
.header-title {
    display: flex;
    align-items: center;
    gap: 14px;
}
.header-icon {
    width: 48px;
    height: 48px;
    background: var(--m600);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
    flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(139,69,19,.35);
}
.header-title h1 {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--s900);
    margin: 0;
    line-height: 1.2;
    letter-spacing: -.3px;
}
.header-title em {
    font-style: normal;
    color: var(--m600);
}
.header-subtitle {
    color: var(--s400);
    font-size: .8rem;
    margin-top: 3px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.header-subtitle i { color: var(--m500); }
.header-actions { display: flex; align-items: center; gap: 10px; }

/* ════════════════════════════════════════════
   BUTTONS
══════════════════════════════════════════════ */
.btn-db {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 20px;
    border-radius: var(--r);
    font-size: .8rem;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    white-space: nowrap;
    line-height: 1;
    font-family: var(--font);
}
.btn-db-primary {
    background: var(--m600);
    color: white;
    box-shadow: 0 2px 10px rgba(139,69,19,.3);
}
.btn-db-primary:hover {
    background: var(--m700);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(139,69,19,.35);
}
.btn-db-ghost {
    background: var(--white);
    color: var(--s600);
    border: 1.5px solid var(--s200);
}
.btn-db-ghost:hover {
    background: var(--m50);
    border-color: var(--m300);
    color: var(--m700);
}
.btn-sm {
    padding: 6px 12px;
    font-size: .7rem;
}

/* ════════════════════════════════════════════
   CARD
══════════════════════════════════════════════ */
.card {
    background: var(--white);
    border: 1.5px solid var(--s100);
    border-radius: var(--rxl);
    overflow: hidden;
    margin-bottom: 20px;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
}
.card:hover { box-shadow: var(--shadow-md); }
.table-responsive {
    overflow-x: auto;
}
.table {
    width: 100%;
    border-collapse: collapse;
}
.table thead th {
    background: var(--s50);
    padding: 12px 16px;
    font-size: .7rem;
    font-weight: 600;
    color: var(--s500);
    text-transform: uppercase;
    letter-spacing: .5px;
    border-bottom: 1.5px solid var(--s100);
    text-align: left;
}
.table tbody td {
    padding: 12px 16px;
    border-bottom: 1px solid var(--s100);
    color: var(--s700);
    font-size: .8rem;
    vertical-align: middle;
}
.table tbody tr:hover td { background: var(--m50); }

/* ════════════════════════════════════════════
   BADGES
══════════════════════════════════════════════ */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 100px;
    font-size: .68rem;
    font-weight: 600;
    white-space: nowrap;
}
.badge-primary { background: var(--m100); color: var(--m700); border: 1.5px solid var(--m200); }
.badge-success { background: var(--m100); color: var(--m700); border: 1.5px solid var(--m200); }
.badge-danger { background: #fee2e2; color: #b91c1c; border: 1.5px solid #fecaca; }
.badge-info { background: var(--m50); color: var(--m600); border: 1.5px solid var(--m200); }
.badge-secondary { background: var(--s100); color: var(--s600); border: 1.5px solid var(--s200); }
.badge-number {
    background: var(--s100);
    color: var(--s600);
    padding: 2px 6px;
    border-radius: 4px;
    font-size: .65rem;
}

/* ════════════════════════════════════════════
   EMPTY STATE
══════════════════════════════════════════════ */
.empty-state {
    text-align: center;
    padding: 48px 24px;
}
.empty-state i {
    font-size: 3rem;
    color: var(--s300);
    margin-bottom: 16px;
}
.empty-state h5 {
    font-size: .95rem;
    font-weight: 600;
    color: var(--s600);
    margin-bottom: 4px;
}
.empty-state p {
    color: var(--s400);
    font-size: .8rem;
}
</style>

<div class="facility-page">

    
    <div class="breadcrumb anim-1">
        <a href="<?php echo e(route('dashboard.index')); ?>"><i class="fas fa-home"></i> Dashboard</a>
        <span class="sep"><i class="fas fa-chevron-right fa-xs"></i></span>
        <span class="current">Équipements</span>
    </div>

    
    <div class="page-header anim-2">
        <div>
            <div class="header-title">
                <span class="header-icon"><i class="fas fa-cogs"></i></span>
                <h1>Gestion des <em>équipements</em></h1>
            </div>
            <p class="header-subtitle">Liste des équipements disponibles dans les chambres</p>
        </div>
        <a href="<?php echo e(route('facility.create')); ?>" class="btn-db btn-db-primary">
            <i class="fas fa-plus-circle"></i> Ajouter
        </a>
    </div>

    
    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="80">#</th>
                        <th>Nom</th>
                        <th width="120">Statut</th>
                        <th width="200" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><span class="badge badge-gray"><?php echo e($loop->iteration); ?></span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <?php if($facility->icon): ?>
                                        <i class="fas <?php echo e($facility->icon); ?>" style="color:var(--m600);"></i>
                                    <?php else: ?>
                                        <i class="fas fa-cog" style="color:var(--m600);"></i>
                                    <?php endif; ?>
                                    <span class="fw-semibold"><?php echo e($facility->name); ?></span>
                                </div>
                            </td>
                            <td>
                                <?php if($facility->status): ?>
                                    <span class="badge badge-primary"><i class="fas fa-check-circle"></i> Actif</span>
                                <?php else: ?>
                                    <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Inactif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="<?php echo e(route('facility.edit', $facility->id)); ?>" 
                                       class="btn btn-gray btn-sm"
                                       title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-red btn-sm delete" 
                                            data-id="<?php echo e($facility->id); ?>" 
                                            data-name="<?php echo e($facility->name); ?>"
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="delete-form-<?php echo e($facility->id); ?>" 
                                          action="<?php echo e(route('facility.destroy', $facility->id)); ?>" 
                                          method="POST" class="d-none">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <div class="empty-icon"><i class="fas fa-cogs"></i></div>
                                    <h4>Aucun équipement</h4>
                                    <p>Commencez par ajouter un équipement.</p>
                                    <a href="<?php echo e(route('facility.create')); ?>" class="btn btn-primary mt-3">
                                        <i class="fas fa-plus-circle"></i> Ajouter
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            const name = this.dataset.name;

            Swal.fire({
                title: 'Confirmer la suppression',
                html: `Supprimer l'équipement <strong>${name}</strong> ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1e6b2e',
                cancelButtonColor: '#b91c1c',
                confirmButtonText: '<i class="fas fa-check"></i> Oui, supprimer',
                cancelButtonText: '<i class="fas fa-times"></i> Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        });
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Majorelle V\Documents\MoradaManagement\resources\views/facility/index.blade.php ENDPATH**/ ?>