# PlasticPollutions Application Reflection Report

## 1. What I Learned Building the System
Building the PlasticPollutions web application provided a comprehensive review of full-stack development, specifically using the LAMP stack architecture. I reinforced my understanding of secure user authentication paradigms by implementing CSRF protections and utilizing PHP's modern password hashing APIs (`password_hash` and `password_verify`). Building a complete schema utilizing foreign key constraints ensured that data integrity was maintained, specifically regarding cascading deletions for users and their corresponding donations or petition signatures.

Furthermore, integrating Tailwind CSS entirely via CDN without a build step highlighted the framework's immense utility in rapidly scaffolding responsive, aesthetically pleasing interfaces. From designing interactive modals to crafting responsive navigation bars and complex CSS timeline diagrams, Tailwind significantly accelerated the styling process. I also gained practical experience utilizing native JavaScript and the `IntersectionObserver` API to trigger animations (like the counters on the homepage) only when they scrolled into the user's viewport.

## 2. Challenges Encountered
Several technical challenges presented themselves during the development lifecycle:

1. **Lockout Logic**: Implementing the account lockout feature required careful time manipulation in PHP and MySQL. Determining whether a user should be locked out based on timestamps, while simultaneously tracking their attempt count, required complex conditional logic during the login flow.
2. **Unique ID Generation**: Generating a unique visitor ID adhering strictly to the `/^PU\d{6}$/` format required ensuring collision avoidance in a multi-user environment.
3. **AJAX Form Handling**: Creating a seamless user dashboard where profile updates, password changes, and donations occurred without page reloads introduced complexities around session management and returning standardized JSON responses from the server.
4. **State Persistence**: The pledge tracker on the "Help" page needed to save the user's progress without requiring an account or database table, meaning the state had to persist on the client-side.

## 3. How Each Challenge Was Resolved
1. **Lockout Logic**: I resolved the lockout challenge by adding `login_attempts` and `lockout_until` columns to the `users` table. On failed login, the attempts counter increments. If it hits 3, the `lockout_until` field is populated with a timestamp 3 minutes in the future. On subsequent logins, the script checks if the current time has surpassed the `lockout_until` timestamp before even verifying the password hash.
2. **Unique ID Generation**: I utilized a `do-while` loop in the registration script. The script generates a random 6-digit number, formats it with the 'PU' prefix, and queries the database to see if it already exists. The loop continues generating until a unique ID is found, ensuring absolute uniqueness before the `INSERT` operation.
3. **AJAX Form Handling**: I centralized the AJAX endpoint logic at the top of the `dashboard.php` file, intercepting `POST` requests tagged with the `XMLHttpRequest` header. The PHP script processes the specific action, interacts with the database using PDO, and immediately `exit`s after echoing a structured JSON object (`{"success": true, "message": "..."}`). On the frontend, the native `fetch` API captures this and triggers a dynamic toast notification.
4. **State Persistence**: I utilized the browser's `localStorage` API. I attached event listeners to the pledge checkboxes that instantly saved their checked status to `localStorage` using unique IDs. On page load, a script loops through the DOM, retrieves the stored boolean values, and pre-checks the boxes accordingly.

## 4. Suggested Improvements
While functional, the application could be significantly enhanced in several areas:

**Accessibility:**
- **ARIA Attributes**: We need to implement comprehensive ARIA (Accessible Rich Internet Applications) roles and labels across all dynamic elements, specifically the AJAX-driven forms and the custom dropdown menus.
- **Keyboard Navigation**: Ensure the image slider and custom modal can be fully operated using only a keyboard (managing focus states).

**Performance:**
- **Caching**: Implement Redis or Memcached to cache global site statistics (like the visitor counter and total donations) rather than querying the database on every page load.
- **Lazy Loading**: Native lazy loading (`loading="lazy"`) should be added to the images, especially the heavy slider graphics and profile images, to improve the initial Time to Interactive (TTI).

**Scalability:**
- **API-Based Architecture**: Transitioning from monolithic PHP scripts to a decoupled architecture (e.g., a dedicated RESTful API built with Laravel or Express) would separate the frontend from the backend, allowing for easier maintenance and the potential creation of mobile applications.
- **Cloud Database**: Migrating the MySQL database from a local instance to a managed cloud service (like AWS RDS or Google Cloud SQL) would provide automated backups, read replicas, and seamless horizontal scaling as the user base grows.
