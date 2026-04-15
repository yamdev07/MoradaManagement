/**
 * Script de diagnostic pour les soumissions de formulaires
 * Identifie les problèmes potentiels avec les formulaires du dashboard
 */

class FormDebugger {
    constructor() {
        this.init();
    }

    init() {
        console.log('🔍 Form Debugger Initialisé');
        this.setupGlobalHandlers();
        this.checkCSRF();
        this.monitorForms();
    }

    setupGlobalHandlers() {
        // Intercepter toutes les soumissions de formulaires
        document.addEventListener('submit', (e) => {
            const form = e.target;
            console.log('📝 Soumission de formulaire détectée:', {
                form: form,
                action: form.action,
                method: form.method,
                id: form.id,
                className: form.className
            });

            // Vérifier le CSRF
            const csrfToken = this.getCSRFToken(form);
            if (!csrfToken) {
                console.error('❌ Token CSRF manquant dans le formulaire');
                this.showDebugError('Token CSRF manquant', 'error');
                return;
            }

            // Vérifier l'action
            if (!form.action || form.action === '#') {
                console.error('❌ Action du formulaire manquante');
                this.showDebugError('Action du formulaire manquante', 'error');
                return;
            }

            // Logger les données du formulaire
            const formData = new FormData(form);
            console.log('📋 Données du formulaire:', Object.fromEntries(formData));

            // Ajouter le debug info
            formData.append('_debug', '1');
            formData.append('_debug_timestamp', Date.now());
        });

        // Intercepter les clics sur les boutons de soumission
        document.addEventListener('click', (e) => {
            const button = e.target.closest('button[type="submit"], input[type="submit"]');
            if (button) {
                console.log('🔘 Bouton submit cliqué:', {
                    button: button,
                    form: button.form,
                    disabled: button.disabled
                });
            }
        });
    }

    checkCSRF() {
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfMeta) {
            console.error('❌ Meta tag CSRF manquant');
            this.showDebugError('Meta tag CSRF manquant', 'error');
            return;
        }

        const csrfToken = csrfMeta.getAttribute('content');
        if (!csrfToken) {
            console.error('❌ Token CSRF vide');
            this.showDebugError('Token CSRF vide', 'error');
            return;
        }

        console.log('✅ Token CSRF trouvé:', csrfToken.substring(0, 20) + '...');
        return csrfToken;
    }

    getCSRFToken(form) {
        // Chercher le token CSRF dans le formulaire
        let token = null;

        // 1. Input hidden standard
        const hiddenInput = form.querySelector('input[name="_token"]');
        if (hiddenInput) {
            token = hiddenInput.value;
        }

        // 2. Meta tag
        if (!token) {
            const metaTag = document.querySelector('meta[name="csrf-token"]');
            if (metaTag) {
                token = metaTag.getAttribute('content');
            }
        }

        return token;
    }

    monitorForms() {
        // Surveiller les formulaires spécifiques du dashboard
        const forms = document.querySelectorAll('form');
        console.log(`📋 ${forms.length} formulaire(s) trouvé(s)`);

        forms.forEach((form, index) => {
            console.log(`Formulaire ${index + 1}:`, {
                id: form.id || 'sans-id',
                action: form.action || 'pas-d-action',
                method: form.method || 'pas-de-methode',
                hasSubmit: form.querySelector('[type="submit"]'),
                inputs: form.querySelectorAll('input, select, textarea').length
            });

            // Ajouter un indicateur visuel de debug
            if (!form.hasAttribute('data-debugged')) {
                form.setAttribute('data-debugged', 'true');
                this.addDebugIndicator(form);
            }
        });
    }

    addDebugIndicator(form) {
        // Ajouter un indicateur visuel pour le debug
        const indicator = document.createElement('div');
        indicator.style.cssText = `
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff6b6b;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            z-index: 9999;
            cursor: pointer;
        `;
        indicator.innerHTML = '🐛';
        indicator.title = 'Formulaire sous surveillance debug';
        indicator.onclick = () => this.showFormDebugInfo(form);

        // Positionner le formulaire en relative si nécessaire
        if (form.style.position !== 'relative' && form.style.position !== 'absolute') {
            form.style.position = 'relative';
        }

        form.appendChild(indicator);
    }

    showFormDebugInfo(form) {
        const info = {
            id: form.id || 'sans-id',
            action: form.action || 'pas-d-action',
            method: form.method || 'pas-de-methode',
            inputs: form.querySelectorAll('input, select, textarea').length,
            submitButtons: form.querySelectorAll('[type="submit"]').length,
            hasCSRF: !!form.querySelector('input[name="_token"]'),
            csrfToken: this.getCSRFToken(form) ? 'présent' : 'manquant'
        };

        console.table('🔍 Debug Info Formulaire:', info);

        // Afficher dans une modal
        this.showDebugModal(info);
    }

    showDebugModal(info) {
        // Créer une modal avec les infos de debug
        const modal = document.createElement('div');
        modal.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        `;

        const content = document.createElement('div');
        content.style.cssText = `
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
        `;

        content.innerHTML = `
            <h3 style="margin-top: 0; color: #333;">🔍 Debug Formulaire</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr><td style="padding: 5px; font-weight: bold;">ID:</td><td style="padding: 5px;">${info.id}</td></tr>
                <tr><td style="padding: 5px; font-weight: bold;">Action:</td><td style="padding: 5px; word-break: break-all;">${info.action}</td></tr>
                <tr><td style="padding: 5px; font-weight: bold;">Méthode:</td><td style="padding: 5px;">${info.method}</td></tr>
                <tr><td style="padding: 5px; font-weight: bold;">Inputs:</td><td style="padding: 5px;">${info.inputs}</td></tr>
                <tr><td style="padding: 5px; font-weight: bold;">Boutons Submit:</td><td style="padding: 5px;">${info.submitButtons}</td></tr>
                <tr><td style="padding: 5px; font-weight: bold;">Token CSRF:</td><td style="padding: 5px; color: ${info.hasCSRF ? 'green' : 'red'}">${info.csrfToken}</td></tr>
            </table>
            <button onclick="this.closest('div[style*=fixed]').remove()" style="margin-top: 15px; padding: 8px 16px; background: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">Fermer</button>
        `;

        modal.appendChild(content);
        document.body.appendChild(modal);

        // Fermer en cliquant en dehors
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.remove();
            }
        });
    }

    showDebugError(message, type = 'warning') {
        console.error(`❌ Debug Error: ${message}`);
        
        // Afficher une notification
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: type,
                title: 'Debug Error',
                text: message,
                timer: 5000,
                showConfirmButton: false
            });
        } else {
            alert(`Debug Error: ${message}`);
        }
    }

    // Méthode pour tester une soumission manuelle
    testSubmit(formId) {
        const form = document.getElementById(formId);
        if (!form) {
            console.error(`Formulaire ${formId} non trouvé`);
            return;
        }

        console.log(`🧪 Test de soumission du formulaire ${formId}`);
        
        // Simuler une soumission
        const submitEvent = new Event('submit', { bubbles: true, cancelable: true });
        form.dispatchEvent(submitEvent);
    }
}

// Initialiser le debugger
window.formDebugger = new FormDebugger();

// Exposer les méthodes de test globalement
window.testFormSubmit = (formId) => window.formDebugger.testSubmit(formId);

console.log('🔍 Form Debugger prêt. Utilisez testFormSubmit("id-formulaire") pour tester.');
