# Laravel Deployment Guide: cPanel Shared Hosting

This guide provides a step-by-step approach for deploying the ACEF Laravel application to a cPanel shared hosting environment.

---

## Method 1: SSH & Git Deployment (Recommended)

### Step 1: Prepare SSH Access in cPanel
1. Log in to **cPanel**.
2. Find **Security** > **SSH Access** > **Manage SSH Keys**.
3. **Generate a New Key**:
   - **Key Name**: `id_rsa`
   - **Key Password**: (Recommended)
4. **Authorize**: Go back to Manage Keys and click **Authorize** for the new key.
5. **Add to GitHub**: View the **Public Key**, copy the `ssh-rsa` string, and add it to your GitHub account settings.

### Step 2: Clone the Repository
1. Open cPanel **Terminal**.
2. Clone into a folder *above* `public_html`:
   ```bash
   git clone git@github.com:yourusername/ACEF.git acef-app
   ```

### Step 3: Configure Environment
1. `cd ~/acef-app`
2. `cp .env.example.production .env`
3. Edit `.env` with your production URL and database credentials.

### Step 4: Install & Setup
```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
php artisan storage:link
```

---

## Method 2: Manual Upload + Subsequent Git Connection (Beginner Friendly)

If you prefer to upload files manually first, follow these phases.

### Phase 1: Manual Upload
1. **ZIP Locally**: Compress your project folder.
   - **EXCLUDE**: `node_modules`, `vendor`, `.git`, `.env`.
2. **Upload & Extract**: Use cPanel **File Manager** to upload the ZIP to `/home/yourusername/` and extract it as `acef-app`.
3. **Setup .env**: Create `.env` inside `acef-app` using the production template.

### Phase 2: Initial Setup
Open the cPanel **Terminal** and run the **First Three Commands**:

1. **Install Dependencies**:
   ```bash
   cd ~/acef-app
   composer install --no-dev --optimize-autoloader
   ```
2. **Generate Key**:
   ```bash
   php artisan key:generate
   ```
3. **Database Setup**:
   ```bash
   php artisan migrate --force
   ```

### Phase 3: Connect to GitHub (Post-Deployment)
To enable future updates via Git:
1. `git init`
2. `git remote add origin git@github.com:yourusername/ACEF.git`
3. Follow Step 1 (SSH Keys) if not already done.
4. `git fetch origin`
5. `git reset --hard origin/main`

---

## Final Step: Link the Public Directory
Regardless of the method, you must point your domain to the `public` folder.

**Symbolic Link Method**:
1. `mv ~/public_html ~/public_html_backup`
2. `ln -s ~/acef-app/public ~/public_html`

---

## Common cPanel Issues
- **PHP Version**: If `artisan` fails, use `/usr/local/bin/php8x artisan`.
- **Symlinks**: If the host blocks symlinks, use an `.htaccess` redirect in `public_html`.
