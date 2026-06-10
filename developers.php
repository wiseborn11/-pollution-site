<?php require_once 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developers - PlasticPollutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <?php include 'navbar.php'; ?>

    <main class="flex-grow py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Meet the Developers</h1>
                <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">The technical minds behind the PlasticPollutions platform.</p>
            </div>

            <div class="flex flex-wrap justify-center gap-10">
                
                <!-- Dev 1 -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden w-full max-w-sm transform transition hover:-translate-y-2 hover:shadow-2xl">
                    <div class="h-32 bg-green-600"></div>
                    <div class="px-6 pb-6 relative">
                        <img src="assets/images/dev_profile_1_1778711518760.png" alt="Priscilla" class="w-32 h-32 rounded-full border-4 border-white mx-auto -mt-16 object-cover bg-white shadow-sm">
                        <div class="text-center mt-4">
                            <h2 class="text-2xl font-bold text-gray-900">Priscilla</h2>
                            <p class="text-green-600 font-semibold mb-4">Lead Full-Stack Developer</p>
                            <p class="text-gray-600 text-sm mb-6 px-2">"Building technology that drives real-world environmental change is my passion. I architected the core PHP/MySQL backend and designed the responsive Tailwind interfaces for this platform."</p>
                            <div class="flex justify-center">
                                <a href="https://github.com/priscilla" target="_blank" class="text-gray-500 hover:text-gray-900 transition flex items-center justify-center space-x-2 border border-gray-300 rounded-full py-2 px-4 hover:bg-gray-50">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                                    <span class="font-medium text-sm">GitHub Profile</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dev 2 (Using same image but as example) -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden w-full max-w-sm transform transition hover:-translate-y-2 hover:shadow-2xl">
                    <div class="h-32 bg-blue-600"></div>
                    <div class="px-6 pb-6 relative">
                        <img src="assets/images/dev_profile_1_1778711518760.png" alt="Collaborator" class="w-32 h-32 rounded-full border-4 border-white mx-auto -mt-16 object-cover bg-white shadow-sm">
                        <div class="text-center mt-4">
                            <h2 class="text-2xl font-bold text-gray-900">Alex</h2>
                            <p class="text-blue-600 font-semibold mb-4">UI/UX & Frontend</p>
                            <p class="text-gray-600 text-sm mb-6 px-2">"I focused on ensuring the user experience is flawless and engaging. From the interactive pledge trackers to the responsive design, my goal is to make activism accessible."</p>
                            <div class="flex justify-center">
                                <a href="https://github.com/" target="_blank" class="text-gray-500 hover:text-gray-900 transition flex items-center justify-center space-x-2 border border-gray-300 rounded-full py-2 px-4 hover:bg-gray-50">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                                    <span class="font-medium text-sm">GitHub Profile</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
