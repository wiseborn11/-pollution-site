# Railway Deployment Guide - PlasticPollutions Site

## Step-by-Step Railway Deployment

### 1. Prerequisites
- GitHub account (free at github.com)
- Railway account (free tier available at railway.app)

### 2. Create a GitHub Repository

1. Go to **github.com** and sign in (or create account)
2. Click **New Repository**
3. Name it: `pollution-site` (or any name)
4. Choose **Public** or **Private** (your choice)
5. Click **Create Repository**

### 3. Upload Your Code to GitHub

**Option A: Using Git Command Line**

Open PowerShell in your project folder and run:

```powershell
# Initialize git repository
git init

# Add all files
git add .

# Create first commit
git commit -m "Initial commit - PlasticPollutions site"

# Add remote (replace USERNAME with your GitHub username)
git remote add origin https://github.com/USERNAME/pollution-site.git

# Push to GitHub
git branch -M main
git push -u origin main
```

**Option B: Using GitHub Desktop**
1. Download GitHub Desktop from desktop.github.com
2. Open it and click "Create New Repository"
3. Select your project folder
4. Publish to GitHub
5. Done!

### 4. Set Up Railway Deployment

1. Go to **railway.app**
2. Click **Start a New Project** or **Dashboard**
3. Click **+ New Project**
4. Click **Deploy from GitHub** (or **Deploy from GitHub Repo**)
5. Click **Connect GitHub** and authorize Railway
6. Select your `pollution-site` repository
7. Click **Deploy**

Railway will now:
- Detect it's a PHP app
- Build and deploy automatically
- Assign you a domain (e.g., `pollution-site-production.up.railway.app`)

### 5. Set Up the Database

**Create MySQL Database on Railway:**

1. In Railway dashboard, click **+ New**
2. Select **MySQL** 
3. Click **Deploy**
4. Railway creates a MySQL instance

**Link Database to Your App:**

1. Click on your MySQL service
2. Go to **Variables** tab
3. Copy all the database variables
4. Click on your PHP app service
5. Go to **Variables** tab
6. Add these environment variables:
   - `DB_HOST` - copy from MySQL Variables
   - `DB_PORT` - usually 3306
   - `DB_NAME` - copy from MySQL Variables
   - `DB_USER` - copy from MySQL Variables
   - `DB_PASSWORD` - copy from MySQL Variables

### 6. Import Database Schema

1. In Railway MySQL service, click **Connect**
2. Use **Shell** or **Connect to database** option
3. Open a SQL client or use phpMyAdmin
4. Copy and paste the contents of `setup.sql`
5. Execute to create all tables

**Or use the database URL from Railway:**
1. In MySQL service, go to **Variables**
2. Look for the full database URL
3. Use it with a MySQL client to import `setup.sql`

### 7. Update Your db.php File

Your `db.php` should read from environment variables:

```php
<?php
// db.php - Railway Version
$host = $_ENV['DB_HOST'] ?? 'localhost';
$port = $_ENV['DB_PORT'] ?? '3306';
$dbname = $_ENV['DB_NAME'] ?? 'plastic_pollutions_db';
$user = $_ENV['DB_USER'] ?? 'root';
$pass = $_ENV['DB_PASSWORD'] ?? '';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
```

1. Replace your current `db.php` with the code above
2. Commit and push to GitHub:
   ```powershell
   git add db.php
   git commit -m "Update db.php for Railway deployment"
   git push
   ```
3. Railway automatically redeploys

### 8. Test Your Site

1. Go to your Railway dashboard
2. Click on your PHP app service
3. Look for the **Domains** section
4. Click the domain (e.g., `pollution-site-production.up.railway.app`)
5. Your site should load!

### 9. Custom Domain (Optional)

To use your own domain:

1. Buy a domain (namecheap.com, godaddy.com, etc.)
2. In Railway dashboard, go to your app
3. Click **Settings** → **Domains**
4. Click **+ Add Domain**
5. Enter your domain
6. Follow Railway's DNS instructions
7. Point your domain to Railway

## 🔗 Project Files Included

| File | Purpose |
|------|---------|
| Procfile | Tells Railway how to start your PHP app |
| railway.json | Railway configuration |
| .railwayignore | Files to exclude from deployment |
| db.php | Updated to use environment variables |

## 📊 Architecture on Railway

```
Your GitHub Repo
     ↓
Railway (auto-detects PHP)
     ├── PHP App Service
     └── MySQL Database Service
            ↓
       Your Domain
```

## 🆓 Free Tier Limits

Railway's free tier includes:
- Up to $5 credit per month (usually enough for a small app)
- Automatic scaling
- MySQL database included

Monitor your usage at railway.app/account/billing

## Troubleshooting

**"502 Bad Gateway" error:**
- Check Procfile syntax
- Ensure db.php can connect to database
- Check Railway build logs for errors

**Database not connecting:**
- Verify DB_HOST, DB_USER, DB_PASSWORD in Railway variables
- Make sure MySQL service is running
- Check setup.sql was imported successfully

**Files not found (404 errors):**
- Verify all files are in GitHub repo
- Check file names are correct
- Clear browser cache

## ✅ Verification Checklist

After deployment:
- [ ] Site loads at Railway domain
- [ ] Homepage displays correctly
- [ ] Can navigate between pages
- [ ] Register page works
- [ ] Can create new user account
- [ ] Can log in
- [ ] Dashboard shows user info
- [ ] Donations form submits
- [ ] All images load from assets/

## Need Help?

- Railway Docs: https://docs.railway.app
- GitHub Docs: https://docs.github.com
- PHP on Railway: https://docs.railway.app/guides/PHP

Your lecturer will be impressed with a Railway deployment! 🚀
