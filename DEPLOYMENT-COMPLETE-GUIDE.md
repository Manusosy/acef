# Complete Beginner's Guide to Deploying ACEF to cPanel

This guide will walk you through **every single step** of deploying your Laravel application to cPanel shared hosting. No prior experience required!

---

## 🎯 What You'll Be Doing

1. Preparing your files locally
2. Creating a database on cPanel
3. Uploading files to cPanel
4. Configuring the application
5. Making the site live
6. (Optional) Connecting to GitHub for future updates

**Estimated Time**: 30-45 minutes

---

## 📦 Step 1: Prepare Your Files Locally

### 1.1 Build Production Assets
On your local computer, open PowerShell in the project folder and run:
```powershell
npm run build
```
This creates optimized CSS and JavaScript files for production.

### 1.2 Create a ZIP File
1. **Right-click** your project folder (`ACEF`)
2. Choose **Send to** > **Compressed (zipped) folder**
3. Name it `acef-production.zip`

> ✅ **What to Include**: Everything in the folder
> ❌ **What to Exclude**: We'll handle this on the server

---

## 🗄️ Step 2: Create a Database on cPanel

### 2.1 Log into cPanel
1. Go to your hosting provider's website
2. Navigate to cPanel (usually `yourdomain.com/cpanel`)
3. Log in with your credentials

### 2.2 Create MySQL Database
1. Scroll down to the **DATABASES** section
2. Click **MySQL® Databases**
3. Under **Create New Database**:
   - **Database Name**: `acef_production` (or any name you prefer)
   - Click **Create Database**
4. **Write down** the full database name (usually `username_acef_production`)

### 2.3 Create Database User
1. Scroll to **MySQL Users** > **Add New User**
   - **Username**: `acef_user`
   - **Password**: Click **Generate Password** (SAVE THIS PASSWORD!)
   - Click **Create User**
2. **Write down** the full username (usually `username_acef_user`)

### 2.4 Link User to Database
1. Scroll to **Add User to Database**
2. **User**: Select your new user
3. **Database**: Select your new database
4. Click **Add**
5. On the next page, check **ALL PRIVILEGES**
6. Click **Make Changes**

---

## 📤 Step 3: Upload Files to cPanel

### 3.1 Access File Manager
1. In cPanel, find **FILES** section
2. Click **File Manager**
3. Navigate to your **home directory** (usually `/home/yourusername/`)

### 3.2 Upload the ZIP
1. Click **Upload** (top right)
2. Click **Select File** and choose `acef-production.zip`
3. Wait for upload to complete (may take several minutes)
4. Close the upload window

### 3.3 Extract the ZIP
1. Back in File Manager, find `acef-production.zip`
2. **Right-click** > **Extract**
3. Extract to: `/home/yourusername/acef-app`
4. Click **Extract File(s)**
5. Close the extraction window

### 3.4 Clean Up Unnecessary Files
1. Navigate into the `acef-app` folder
2. **Delete these folders** (right-click > Delete):
   - `node_modules` (if present)
   - `.git` (if present)
   - `vendor` (if present - we'll reinstall this)

---

## ⚙️ Step 4: Configure the Application

### 4.1 Create Environment File
1. In File Manager, navigate to `/home/yourusername/acef-app/`
2. Click **+ File** (top left)
3. Name it `.env` and click **Create New File**
4. **Right-click** `.env` > **Edit**
5. Open your local `.env.example.production` file
6. **Copy all contents** and paste into the cPanel editor
7. **Update these lines**:
   ```env
   APP_URL=https://yourdomain.com
   
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=username_acef_production  # The full name from Step 2.2
   DB_USERNAME=username_acef_user        # The full name from Step 2.3
   DB_PASSWORD=your_generated_password   # From Step 2.3
   ```
8. Click **Save Changes** (top right)
9. Close the editor

### 4.2 Open Terminal
1. In cPanel, scroll to **ADVANCED** section
2. Click **Terminal**
3. A black terminal window will open

---

## 🔧 Step 5: Install and Setup (The "First Three Commands")

Copy and paste these commands **one at a time** into the Terminal.

### 5.1 Navigate to Your App
```bash
cd acef-app
```
Press Enter. You should see the path change to `~/acef-app`

### 5.2 Install PHP Dependencies
```bash
composer install --no-dev --optimize-autoloader
```
Press Enter. This will take 2-3 minutes. You'll see lots of text scrolling.

> ⚠️ If you get "composer: command not found":
> ```bash
> /usr/local/bin/php82 /usr/local/bin/composer install --no-dev --optimize-autoloader
> ```

### 5.3 Generate Application Key
```bash
php artisan key:generate
```
Press Enter. You should see: `Application key set successfully.`

### 5.4 Setup Database
```bash
php artisan migrate --force
```
Press Enter. This creates all database tables. You'll see a list of migrations being run.

### 5.5 Link Storage
```bash
php artisan storage:link
```
Press Enter. You should see: `The [public/storage] link has been connected to [storage/app/public].`

---

## 🌐 Step 6: Make the Site Live

### 6.1 Backup Existing public_html
If you have existing content in `public_html`, let's back it up first:
```bash
cd ~
mv public_html public_html_backup
```

### 6.2 Create Symbolic Link
```bash
ln -s ~/acef-app/public ~/public_html
```
This tells cPanel to serve your Laravel app from the correct folder.

### 6.3 Test Your Site
Open your browser and go to `https://yourdomain.com`

**You should see your ACEF website! 🎉**

---

## 🔐 Step 7 (Optional): Connect to GitHub for Future Updates

This allows you to update your site by just running `git pull` instead of re-uploading everything.

### 7.1 Generate SSH Key in cPanel
1. In cPanel, go to **Security** > **SSH Access**
2. Click **Manage SSH Keys**
3. Click **Generate a New Key**
   - **Key Name**: `id_rsa`
   - **Key Password**: Leave blank for simplicity (or create one if you prefer)
   - **Key Type**: RSA
   - **Key Size**: 4096
4. Click **Generate Key**

### 7.2 Authorize the Key
1. Back in **Manage SSH Keys**
2. Under **Public Keys**, find `id_rsa`
3. Click **Manage** > **Authorize**
4. You'll see it move to **Authorized Keys**

### 7.3 Copy Public Key
1. Click **Manage** next to `id_rsa` again
2. Click **View/Download** under **Public Key**
3. **Select and copy** the entire key (starts with `ssh-rsa`)

### 7.4 Add Key to GitHub
1. Go to **GitHub.com** and log in
2. Click your **profile picture** (top right) > **Settings**
3. In the left sidebar, click **SSH and GPG keys**
4. Click **New SSH key** (green button)
5. **Title**: `cPanel - ACEF Production`
6. **Key**: Paste the key you copied in 7.3
7. Click **Add SSH key**

### 7.5 Initialize Git in Your App
Back in the cPanel Terminal:
```bash
cd ~/acef-app
git init
git remote add origin git@github.com:yourusername/ACEF.git
```
Replace `yourusername` with your GitHub username.

### 7.6 Test Connection
```bash
ssh -T git@github.com
```
Type `yes` when asked. You should see: `Hi yourusername! You've successfully authenticated...`

### 7.7 Sync with GitHub
```bash
git fetch origin
git reset --hard origin/main
```

**Done! Now you can update your site anytime by running:**
```bash
cd ~/acef-app
git pull origin main
```

---

## 🎊 You're Live!

Your ACEF website should now be accessible at your domain. 

### Next Steps
1. Test all forms (Contact Us, Get Involved)
2. Add your PayPal/M-Pesa credentials via the **Admin Dashboard** > **Settings**
3. Monitor the site for 24 hours to ensure stability

---

## 🆘 Common Issues & Solutions

### Issue: "500 Internal Server Error"
**Solution**:
```bash
cd ~/acef-app
chmod -R 755 storage bootstrap/cache
```

### Issue: "Mix manifest not found"
**Solution**: Make sure you ran `npm run build` locally before creating the ZIP.

### Issue: Site shows folder listing instead of homepage
**Solution**: Check that the symbolic link was created correctly:
```bash
ls -la ~/public_html
```
You should see it points to `acef-app/public`

### Issue: Database connection error
**Solution**: Double-check the `.env` file - the database name and username must match exactly what cPanel created (including the prefix).

---

## 📞 Need Help?

If you encounter any issues:
1. Check the Laravel logs: `~/acef-app/storage/logs/laravel.log`
2. Enable debug mode temporarily by setting `APP_DEBUG=true` in `.env`
3. Remember to set it back to `false` when done!
