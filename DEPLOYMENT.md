# Laravel Deployment Guide: cPanel Shared Hosting

This guide provides a step-by-step approach for deploying the ACEF Laravel application to a cPanel shared hosting environment using SSH and Git.

## Prerequisites
- cPanel access with SSH Terminal or SSH access enabled.
- A GitHub/GitLab repository for your code.
- PHP 8.2+ enabled in cPanel (Select PHP Version).

---

## Step 1: Prepare SSH Access in cPanel

1. Log in to **cPanel**.
2. Find the **Security** section and click on **SSH Access**.
3. Click **Manage SSH Keys**.
4. Click **Generate a New Key**.
   - **Key Name**: `id_rsa` (Keep this default name for simplest use. If you change it to `acef_key`, you will need extra steps later, so `id_rsa` is best for beginners).
   - **Key Password**: (Optional but recommended - if you set one, you'll need to enter it whenever you use Git).
   - **Key Type**: RSA
   - **Key Size**: 4096
5. Click **Generate Key**.

### Authorize the Key
1. Go back to **Manage SSH Keys**.
2. Under "Public Keys", find your new key.
3. Click **Manage** next to it.
4. Click **Authorize** to allow this key to be used for server access.

### Add Key to GitHub
1. In cPanel, under **SSH Access** > **Manage SSH Keys**, find your key again.
2. Click **View/Download** for the **Public Key**.
3. Copy the entire string (starting with `ssh-rsa`).
4. Go to **GitHub** > **Settings** > **SSH and GPG keys** > **New SSH key**.
5. Paste your key and save it.

---

## Step 2: Clone the Repository

1. Open the **Terminal** in cPanel (under the Advanced section).
2. Navigate to your home directory (usually `/home/yourusername`).
3. Clone the repo into a folder that is **NOT** inside `public_html`:
   ```bash
   git clone git@github.com:yourusername/ACEF.git acef-app
   ```
   *By placing the code outside `public_html`, you ensure that your sensitive files (like `.env`) are never accessible via a browser.*

---

## Step 3: Configure Environment

1. Navigate into the app folder:
   ```bash
   cd acef-app
   ```
2. Copy the production environment file:
   ```bash
   cp .env.example.production .env
   ```
3. Edit the `.env` file (you can use cPanel File Manager or `vi .env` in terminal):
   - Update `APP_URL` to your domain (e.g., `https://acef-ngo.org`).
   - Update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` (Create these in cPanel's **MySQL® Databases** first).
   - Ensure `APP_ENV=production` and `APP_DEBUG=false`.
4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

---

## Step 4: Install Dependencies

Run these commands in the terminal:
```bash
# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Run Migrations (Careful: This will update your production database)
php artisan migrate --force

# Link storage
php artisan storage:link
```

---

## Step 5: Link the Public Directory

Since Laravel's entry point is in the `public` folder, you need to tell cPanel to serve files from there.

### Option A: Using a Symbolic Link (Recommended)
If your main domain points to `public_html`:
1. Rename or move your existing `public_html` (back it up first!):
   ```bash
   mv ~/public_html ~/public_html_backup
   ```
2. Create a link from the app's `public` folder to `public_html`:
   ```bash
   ln -s ~/acef-app/public ~/public_html
   ```

### Option B: Using an `.htaccess` redirect
If you cannot delete `public_html`, create an `.htaccess` file inside `public_html` with:
```apache
<IfModule mod_rewrite.c>
   RewriteEngine On
   RewriteRule ^(.*)$ acef-app/public/$1 [L]
</IfModule>
```

---

## Step 6: Asset Compilation (Vite)

On shared hosting, you usually don't have `npm`. It is best to compile your assets locally and push them to Git, or use a tool to upload the `public/build` folder.

1. **Locally**: Run `npm run build`.
2. **Commit**: Ensure the `public/build` folder is committed to your repository (check your `.gitignore`).
3. **Pull**: On the server, run `git pull`.

---

## Step 7: Optimization

Run these to make the site faster in production:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Common cPanel Issues
- **PHP Version**: If `php artisan` fails, try using the full path to the correct PHP version, e.g., `/usr/local/bin/php82 artisan`.
- **Symlinks**: Some shared hosts disable symlinks. If Step 5 fails, contact support or use a more complex folder structure.
