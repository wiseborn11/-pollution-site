# Deployment Checklist

Use this checklist to ensure everything is ready for deployment:

## Pre-Deployment
- [ ] All PHP files are working locally on XAMPP
- [ ] Database is created locally with all tables
- [ ] All forms are functioning correctly
- [ ] No console errors in browser developer tools
- [ ] Images in assets/ folder are loading

## Hosting Setup
- [ ] InfinityFree account created and verified
- [ ] Website subdomain created
- [ ] Database created on hosting
- [ ] Database user created with strong password
- [ ] Database credentials noted

## File Upload
- [ ] All PHP files uploaded to public_html
- [ ] assets/ folder uploaded with all images
- [ ] db-deployment.php renamed to db.php with correct credentials
- [ ] Old db.php removed from hosting (if it had local credentials)
- [ ] File permissions are correct (644 for files, 755 for folders)

## Database
- [ ] setup.sql imported successfully
- [ ] All 5 tables created (users, donations, petitions, site_stats, visitors_log)
- [ ] site_stats table has initial visitor_count = 0

## Testing
- [ ] Site loads at https://yoursubdomain.rf.gd
- [ ] Homepage displays correctly
- [ ] Navigation links work
- [ ] Register page loads
- [ ] Login page loads
- [ ] Can create a new user account
- [ ] Can log in with new account
- [ ] Dashboard displays user info
- [ ] Donations form works
- [ ] All pages are accessible

## Final Steps
- [ ] Share your site URL with others
- [ ] Test from different devices/browsers
- [ ] Check site loads on mobile
- [ ] Share with Pentecost University

## Ongoing Maintenance
- [ ] Backup your database regularly
- [ ] Monitor for errors in hosting control panel
- [ ] Keep your password secure
- [ ] Check visitor statistics regularly
