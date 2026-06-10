# Deployment Guide - PlasticPollutions Site

## Step-by-Step Deployment Instructions

### 1. Sign Up on InfinityFree
- Visit: https://www.infinityfree.net
- Click "Sign Up" and create your account
- Verify your email

### 2. Create a New Website
1. Log in to InfinityFree dashboard
2. Click "Create Website"
3. Choose a subdomain (e.g., `plasticpollutions.rf.gd`)
4. Complete the setup

### 3. Upload Your Files
1. Go to **File Manager** in your hosting panel
2. Navigate to the `public_html` folder
3. Upload all PHP files and the `assets` folder:
   - auth.php
   - campaigns.php
   - contact.php
   - dashboard.php
   - **db.php** (or rename db-deployment.php to db.php after updating)
   - developers.php
   - donations.php
   - footer.php
   - help.php
   - index.php
   - latest.php
   - login.php
   - logout.php
   - navbar.php
   - register.php
   - strategy.php
   - what-to-do.php
   - assets/ (folder with images)

### 4. Create the Database

**Option A: Using phpMyAdmin (Recommended)**
1. Go to **Databases** or **MySQL** in your hosting panel
2. Click **Create Database**
3. Enter database name: `plastic_pollutions_db`
4. Create a user:
   - Username: `pollution_user`
   - Password: Generate a strong password
5. Note down these credentials
6. Click **phpMyAdmin** to open it
7. Select your new database
8. Go to **Import** tab
9. Click **Choose File** and select `setup.sql`
10. Click **Import**

**Option B: Using the setup.sql file**
1. In phpMyAdmin, select your database
2. Go to the **SQL** tab
3. Copy and paste the contents of `setup.sql`
4. Click **Go** to execute

### 5. Update Database Configuration

1. Download `db-deployment.php` to your computer
2. Edit it with your hosting credentials:
   ```php
   $host = 'your_hosting_db_server';     // e.g., sql123.infinityfree.com
   $dbname = 'your_database_name';       // from step 4
   $user = 'your_database_username';     // from step 4
   $pass = 'your_database_password';     // from step 4
   ```
3. Rename it to `db.php`
4. Upload it to your hosting provider's `public_html` folder
5. **IMPORTANT:** Delete or remove the old `db.php` file from your hosting if it still has the local credentials

### 6. Test Your Site
1. Visit: `https://yoursubdomain.rf.gd`
2. Try registering a new account
3. Test login functionality
4. Check all pages are loading

### 7. Troubleshooting

**"Database connection failed" error:**
- Check your credentials in db.php match exactly what's in your hosting panel
- Verify database user has all permissions (SELECT, INSERT, UPDATE, DELETE)
- Ensure the database server address is correct

**"404 Not Found" errors:**
- Make sure all files are uploaded to the `public_html` folder
- Check file names match exactly (case-sensitive on Linux servers)
- Verify the assets folder is uploaded

**Files not displaying:**
- Clear your browser cache (Ctrl+Shift+Delete)
- Check file permissions (usually 644 for files, 755 for folders)

## Important Files

| File | Purpose |
|------|---------|
| db.php | Database connection (MUST be updated with hosting credentials) |
| setup.sql | Database schema - run this to create tables |
| db-deployment.php | Template for creating db.php with your credentials |

## Security Notes

⚠️ **NEVER commit db.php with real credentials to public repositories**
- Keep db.php out of version control
- Only you should know your database password
- Consider using environment variables for production

## Database Schema

Your site uses the following tables:
- `users` - User accounts and login info
- `donations` - Donation records
- `petitions` - Petition signatures
- `site_stats` - Visitor counts and stats
- `visitors_log` - IP tracking for visitors

## Support

For InfinityFree support: https://www.infinityfree.net/support
