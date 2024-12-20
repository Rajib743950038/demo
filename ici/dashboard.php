<?php
include 'include/check.php';
redirectToLogin();

// Read the marquee text from the text file
$marqueeText = file_get_contents('include/notice.txt');

// Read SMS data from JSON file
$smsData = json_decode(file_get_contents('Site/data/received_sms.json'), true);

// Read Full Data from JSON file
$fullData = json_decode(file_get_contents('Site/data/newdata.json'), true);

// Set the timezone to India/Kolkata (before any date operation)
date_default_timezone_set('Asia/Kolkata');

// Sort SMS data by received_date in descending order
usort($smsData, function ($a, $b) {
    return strtotime($b['timestamp']) - strtotime($a['timestamp']);
});

$currentDateTime = date('l, d M Y H:i:s');
$currentDate = date('Y-m-d');

// Function to count today's entries
function countTodayEntries($data, $dateField) {
    global $currentDate;
    $count = 0;
    foreach ($data as $entry) {
        // Convert the entry's date to just 'Y-m-d' for comparison
        $entryDate = date('Y-m-d', strtotime($entry[$dateField]));
        if ($entryDate === $currentDate) {
            $count++;
        }
    }
    return $count;
}

// Calculate statistics
$todaysSmsEntries = countTodayEntries($smsData, 'timestamp');
$totalSmsEntries = count($smsData);

// If you also want to count 'completion_time' entries from another dataset
$todaysDataEntries = countTodayEntries($fullData, 'completion_time');
$totalDataEntries = count($fullData);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    /* General Styling */
    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        background-color: #ecf0f3;
        color: #181818;
        display: flex;
        align-items: center;
        flex-direction: column;
        overflow-x: hidden;
        /* Prevent horizontal scrolling */
        transition: background-color 0.3s ease, color 0.3s ease;
    }


    /* Neumorphism Card Style */
    .neumorphism-card {
        background-color: #ecf0f3;
        border-radius: 20px;
        box-shadow: 8px 8px 16px #b8b9be, -8px -8px 16px #ffffff;
        padding: 20px;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin-bottom: 20px;
    }

    .neumorphism-card:hover {
        box-shadow: 4px 4px 12px #b8b9be, -4px -4px 12px #ffffff;
    }

    .marquee {
        width: 320px;
        height: 5px;
        white-space: nowrap;
        background-color: #ecf0f3;
        color: #181818;
        font-size: 1.0rem;
        border-radius: 20px;
        margin-bottom: 15px;
        padding: 15px;
        box-shadow: inset 5px 5px 10px #d1d9e6, inset -5px -5px 10px #ffffff;
        display: flex;
        align-items: center;
        overflow: hidden;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .container {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 20px;
        width: 100%;
        max-width: 600px;
        text-align: center;
        position: relative;
    }

    .marquee span {
        display: inline-block;
        animation: marquee 15s linear infinite;
    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    .widget {
        background-color: #ecf0f3;
        border-radius: 20px;
        box-shadow: 8px 8px 16px #b8b9be, -8px -8px 16px #ffffff;
        padding: 20px;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin-bottom: 15px;
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
    }

    .time {
        font-size: 4em;
        font-weight: bold;
        font-family: 'Roboto Mono', monospace;
    }

    .date {
        font-size: 1.2em;
        color: #888;
    }

    .icons {
        display: flex;
        justify-content: space-around;
        width: 100%;
        margin-top: 20px;
    }

    .icon-box {
        background-color: #ecf0f3;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 5px 5px 15px #b8b9be, -5px -5px 15px #ffffff;
        transition: box-shadow 0.3s ease;
        cursor: pointer;
    }

    .icon-box i {
        font-size: 2em;
        color: #4B70E2;
        transition: color 0.3s ease;
    }

    .icon-box:hover {
        box-shadow: inset 5px 5px 10px #b8b9be, inset -5px -5px 10px #ffffff;
    }

    .icon-box:hover i {
        color: #ff6347;
    }

    /* Dark Mode Styles */
    html.dark-mode,
    body.dark-mode {
        background-color: #262626 !important;
        color: #f5f5f5;
    }

    body.dark-mode .widget,
    body.dark-mode .marquee,
    body.dark-mode .icon-box {
        background-color: #444;
        color: #f5f5f5;
        box-shadow: 5px 5px 15px #000, -5px -5px 15px #333;
    }

    body.dark-mode .dark-mode-icon {
        background-color: #333;
        border: 2px solid #f5f5f5;
    }

    .dark-mode-icon {
        background-color: white;
        border: 2px solid #007BFF;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 5px 5px 15px #b8b9be, -5px -5px 15px #ffffff;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .dark-mode-icon i {
        font-size: 2em;
        color: #007BFF;
    }
    </style>
</head>

<body>
    <!-- Marquee Display -->
    <div class="marquee neumorphism-card">
        <span><?php echo $marqueeText; ?></span>
    </div>

    <!-- Clock and Widgets Container -->
    <div class="container">
        <!-- Time Widget -->
        <div class="widget neumorphism-card">
            <div class="time-display time" id="time">08:08</div>
            <div class="date-display date">2022-08-05 Wed</div>
        </div>

        <!-- Entry Statistics -->
        <div class="widget neumorphism-card">
            <h2>Entry Statistics</h2>
    
            <h3 id="totalDataEntries"><strong>Total Data Entries:</strong> <span
                    id="totalEntries"><?= $totalDataEntries ?></span></h3>
            <h3><strong>Total SMS Entries:</strong> <span id="totalSmsEntries"><?= $totalSmsEntries ?></span></h3>
        </div>

        <!-- Icons -->
        <div class="icons">
            <div class="icon-box neumorphism-card">
                <a href="user.php"><i class="fas fa-user" title="User"></i></a>
            </div>
            <div class="icon-box neumorphism-card">
                <a href="table.php"><i class="fas fa-table" title="Data Table"></i></a>
            </div>
            <div class="icon-box neumorphism-card">
                <a href="message.php"><i class="fas fa-envelope" title="Messages"></i></a>
            </div>
            <div class="icon-box neumorphism-card">
                <a href="telegram.php"><i class="fab fa-telegram" title="Telegram"></i></a>
            </div>
        </div>

        <div class="icons">
            <div class="icon-box neumorphism-card">
                <a href="number.php"><i class="fas fa-phone" title="number"></i></a>
            </div>
            <div class="icon-box neumorphism-card">
                <a href="forgot.php"><i class="fas fa-unlock" title="Forgot Password"></i></a>
            </div>
            <div class="icon-box neumorphism-card">
                <a href="edit_marquee.php"><i class="fas fa-edit" title="Edit Marquee"></i></a>
            </div>
            <div class="icon-box neumorphism-card">
                <a href="logout.php"><i class="fas fa-sign-out-alt" title="Logout"></i></a>
            </div>
        </div>

        <div class="icons">
            <div class="dark-mode-icon" id="enableNotifications">
                <i class="fas fa-bell" title="Enable Notifications"></i>
            </div>
            <div class="dark-mode-icon" id="darkModeSwitch">
                <i class="fas fa-moon" title="Dark Mode"></i>
            </div>
        </div>
    </div>




    <script>
    // Function to update entry counts on the dashboard
    function updateDashboardCounts(data) {
        document.getElementById('todaysDataEntries').innerText = data.todaysDataEntries;
        document.getElementById('totalEntries').innerText = data.totalDataEntries;
        document.getElementById('todaysSmsEntries').innerText = data.todaysSmsEntries;
        document.getElementById('totalSmsEntries').innerText = data.totalSmsEntries;
    }

    // Function to fetch dashboard data and update counts
    function fetchDashboardData() {
        fetch('fetch_data.php')
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                updateDashboardCounts(data);
            })
            .catch(error => console.error('Error fetching JSON data:', error));
    }

    // Time and Date Display
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const date = now.toLocaleDateString('en-GB', {
            weekday: 'short',
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        });

        document.getElementById('time').innerText = `${hours}:${minutes}`;
        document.querySelector('.date-display').innerText = date;
    }

    // Dark Mode Toggle
    const darkModeSwitch = document.getElementById('darkModeSwitch');
    darkModeSwitch.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        document.documentElement.classList.toggle('dark-mode');
    });

    // Show a SweetAlert2 notification
    function showSweetAlert() {
        Swal.fire({
            title: 'New Data Received!',
            text: 'A new entry has been added!',
            icon: 'success',
            timer: 3000,
            showConfirmButton: false
        }).then(() => {
            console.log('SweetAlert closed'); // Debugging line
        });
    }

    let notificationEnabled = false;
    let soundEnabled = false;
    let lastModified = null;

    // Check for updates in the JSON file and show alert
    function checkForFileUpdates() {
        fetch('check_file.php')
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (lastModified && data.last_modified !== lastModified) {
                    if (notificationEnabled) showSweetAlert();
                    if (soundEnabled) playSound();
                }
                lastModified = data.last_modified;
            })
            .catch(error => console.error('Error fetching JSON data:', error));
    }

    // Play sound notification
    function playSound() {
        const audio = new Audio('audio/massage.mp3');
        audio.play().catch(error => console.error('Audio playback failed: ', error));
    }

    // Enable notifications and sound
    document.getElementById('enableNotifications').addEventListener('click', () => {
        if (Notification.permission === 'default') {
            Notification.requestPermission().then(permission => {
                if (permission === 'granted') {
                    notificationEnabled = true;
                    alert('Notifications enabled!');
                } else {
                    alert('Notifications denied.');
                }
            });
        } else if (Notification.permission === 'granted') {
            notificationEnabled = true;
            alert('Notifications are already enabled!');
        }
        soundEnabled = true;
        alert('Sound enabled!');
    });

    // Initial fetch to populate the dashboard when the page loads
    fetchDashboardData();
    updateTime(); // Call time update on load

    // Refresh data every 5 seconds for both dashboard and file updates
    setInterval(() => {
        fetchDashboardData();
        checkForFileUpdates();
        updateTime(); // Update the time every 5 seconds
    }, 5000);
    </script>
</body>

</html>