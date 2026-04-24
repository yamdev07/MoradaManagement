
<?php $__env->startSection('title', 'Create New Room'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-0">
                    <i class="fas fa-plus me-2 text-primary"></i>Create New Room
                </h2>
                <nav aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard.index')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('room.index')); ?>">Rooms</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>
            <a href="<?php echo e(route('room.index')); ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>
    
    <?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <strong>Please fix the following errors:</strong>
        <ul class="mb-0 mt-2 ps-3">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <div class="card shadow border-0">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0">
                <i class="fas fa-info-circle me-2 text-info"></i>Room Information
            </h5>
        </div>
        
        <div class="card-body">
            <form class="row g-4" method="POST" action="<?php echo e(route('room.store')); ?>">
                <?php echo csrf_field(); ?>
                
                <!-- Room Number -->
                <div class="col-md-6">
                    <label for="number" class="form-label fw-semibold">
                        <i class="fas fa-hashtag text-primary me-1"></i>Room Number *
                    </label>
                    <input type="text" class="form-control <?php $__errorArgs = ['number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="number" name="number" value="<?php echo e(old('number')); ?>" 
                           placeholder="Example: 101, 201, 301" required>
                    <?php $__errorArgs = ['number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block mt-1">
                            <i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">Unique room identifier</small>
                </div>
                
                <!-- Room Name (Optional) -->
                <div class="col-md-6">
                    <label for="name" class="form-label fw-semibold">
                        <i class="fas fa-signature text-primary me-1"></i>Room Name
                        <span class="text-muted fw-normal">(Optional)</span>
                    </label>
                    <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="name" name="name" value="<?php echo e(old('name')); ?>" 
                           placeholder="Example: Presidential Suite, Ocean View Room">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block mt-1">
                            <i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">Descriptive name for the room</small>
                </div>
                
                <!-- Room Type -->
                <div class="col-md-6">
                    <label for="type_id" class="form-label fw-semibold">
                        <i class="fas fa-bed text-primary me-1"></i>Room Type *
                    </label>
                    <select id="type_id" name="type_id" class="form-select <?php $__errorArgs = ['type_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="" disabled selected>-- Select Type --</option>
                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type->id); ?>" <?php echo e(old('type_id') == $type->id ? 'selected' : ''); ?>>
                                <?php echo e($type->name); ?> 
                                <?php if($type->base_price): ?>
                                    - <?php echo e(number_format($type->base_price, 0, ',', ' ')); ?> FCFA
                                <?php endif; ?>
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['type_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block mt-1">
                            <i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <!-- Room Status -->
                <div class="col-md-6">
                    <label for="room_status_id" class="form-label fw-semibold">
                        <i class="fas fa-circle text-success me-1"></i>Room Status *
                    </label>
                    <select id="room_status_id" name="room_status_id" class="form-select <?php $__errorArgs = ['room_status_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="" disabled selected>-- Select Status --</option>
                        <?php $__currentLoopData = $roomstatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomstatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($roomstatus->id); ?>" <?php echo e(old('room_status_id') == $roomstatus->id ? 'selected' : ''); ?>>
                                <span class="badge bg-<?php echo e($roomstatus->code == 'available' ? 'success' : ($roomstatus->code == 'occupied' ? 'danger' : 'warning')); ?> me-2">
                                    <?php echo e($roomstatus->code); ?>

                                </span>
                                <?php echo e($roomstatus->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['room_status_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block mt-1">
                            <i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <!-- Capacity -->
                <div class="col-md-6">
                    <label for="capacity" class="form-label fw-semibold">
                        <i class="fas fa-users text-primary me-1"></i>Capacity *
                    </label>
                    <input type="number" class="form-control <?php $__errorArgs = ['capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="capacity" name="capacity" value="<?php echo e(old('capacity', 2)); ?>" 
                           placeholder="Example: 2, 4, 6" min="1" max="10" required>
                    <?php $__errorArgs = ['capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block mt-1">
                            <i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">Number of guests (1-10)</small>
                </div>
                
                <!-- Price -->
                <div class="col-md-6">
                    <label for="price" class="form-label fw-semibold">
                        <i class="fas fa-money-bill-wave text-success me-1"></i>Price per Night *
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">FCFA</span>
                        <input type="number" class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="price" name="price" value="<?php echo e(old('price')); ?>" 
                               placeholder="Example: 50000" min="0" required>
                    </div>
                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block mt-1">
                            <i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <!-- View Description -->
                <div class="col-md-6">
                    <label for="view" class="form-label fw-semibold">
                        <i class="fas fa-binoculars text-info me-1"></i>View Description
                    </label>
                    <textarea class="form-control <?php $__errorArgs = ['view'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                              id="view" name="view" rows="1" 
                              placeholder="Example: Sea view, Mountain view, City view, Garden view"><?php echo e(old('view')); ?></textarea>
                    <?php $__errorArgs = ['view'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block mt-1">
                            <i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <!-- Submit Buttons -->
                <div class="col-12 mt-4 pt-3 border-top">
                    <div class="d-flex justify-content-between">
                        <a href="<?php echo e(route('room.index')); ?>" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Create Room
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 2rem;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.4);
    }
    
    .card {
        border-radius: 15px;
        border: 1px solid rgba(0,0,0,0.1);
    }
    
    .card-header {
        border-radius: 15px 15px 0 0 !important;
        background-color: #f8f9fa;
    }
    
    .alert {
        border-radius: 10px;
        border: none;
    }
    
    .input-group-text {
        border-radius: 8px 0 0 8px;
        background-color: #f8f9fa;
    }
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Majorelle V\Documents\MoradaManagement\resources\views/room/create.blade.php ENDPATH**/ ?>