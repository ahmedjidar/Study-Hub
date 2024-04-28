document.addEventListener('DOMContentLoaded', function() {
    // Handle click event on 'Administration' link
    document.getElementById('admin-link').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default action (navigation)
        fetch('../PHPAdmin/administration.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data; // Load 'administration.php' into the #content div
            });
    });

    // Handle click event on 'Annonce' link
    document.getElementById('annonce-link').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default action (navigation)
        fetch('../PHPAnnonce/annonce.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data; // Load 'annonce.php' into the #content div
            });
    });

    // courses
    document.getElementById('courses-link').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default action (navigation)
        fetch('../PHPCourses/courses.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data; // Load 'annonce.php' into the #content div
            });
    });
    
    // meditation
    document.getElementById('meditation-link').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default action (navigation)
        fetch('../PHPMeditation/meditation.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data; // Load 'annonce.php' into the #content div
            });
    });

    // settings
    document.getElementById('settings-link').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default action (navigation)
        fetch('../PHPSettings/settings.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data; // Load 'annonce.php' into the #content div
            });
    });

    // peer-to-peer chatting
    document.getElementById('chat-link').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default action (navigation)
        fetch('../PHPChat/chat.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data; // Load 'annonce.php' into the #content div
            });
    });

    // profile management
    document.getElementById('profile-link').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default action (navigation)
        fetch('../PHPProfile/profile.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data; // Load 'annonce.php' into the #content div
            });
    });

    // notification
    document.getElementById('notification-link').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default action (navigation)
        fetch('../PHPNotification/notification.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = data; // Load 'annonce.php' into the #content div
            });
    });
});

