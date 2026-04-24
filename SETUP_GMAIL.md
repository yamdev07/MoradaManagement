# Configuration Gmail pour Envoi d'Emails

## Étape 1 : Activer la Vérification en 2 Étapes

1. Allez sur : https://myaccount.google.com/security
2. Trouvez "Vérification en 2 étapes"
3. Cliquez sur "Activer"
4. Suivez les instructions pour configurer

## Étape 2 : Générer un Mot de Passe d'Application

1. Sur la même page de sécurité, trouvez "Mots de passe des applications"
2. Cliquez sur "Mots de passe des applications"
3. Sélectionnez :
   - Application : **Autre (nom personnalisé)**
   - Nom : **Morada Lodge System**
4. Cliquez sur "Générer"
5. **Copiez le mot de passe de 16 caractères** (ex: `abcd efgh ijkl mnop`)

## Étape 3 : Configurer le .env

Ouvrez votre fichier `.env` et mettez à jour :

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=moradalodge.system@gmail.com
MAIL_PASSWORD=METTEZ_LE_MOT_DE_PASSE_ICI
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=system@moradalodge.com
MAIL_FROM_NAME="${APP_NAME}"
```

**IMPORTANT :**
- Utilisez le mot de passe d'application de 16 caractères
- PAS votre mot de passe Gmail normal
- N'ajoutez pas d'espaces dans le mot de passe

## Étape 4 : Tester

Après avoir configuré, exécutez :

```bash
php test_email_config.php
```

## Étape 5 : Nettoyer

Une fois que ça fonctionne :

```bash
Remove-Item test_email_config.php
php artisan optimize:clear
```

## Alternative : Autre Fournisseur

Si Gmail ne fonctionne pas, vous pouvez utiliser :

### Sendinblue (Brevo)
```env
MAIL_HOST=smtp-relay.sendinblue.com
MAIL_PORT=587
MAIL_USERNAME=votre-email@sendinblue.com
MAIL_PASSWORD=votre-api-key
```

### Mailtrap (pour tests)
```env
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=votre-username-mailtrap
MAIL_PASSWORD=votre-password-mailtrap
```

---

**Une fois configuré, chaque tenant recevra automatiquement un email de confirmation !**
