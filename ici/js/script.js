// Function for clock
function updateTime() {
    const now = new Date();
    const time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    const date = now.toLocaleDateString();

    document.getElementById('time').textContent = time;
    document.getElementById('date').textContent = date;
}

// Function for dark/light mode toggle
const modeToggle = document.getElementById('mode-toggle');
const body = document.body;

// Load saved theme from localStorage
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
    body.classList.add(savedTheme);
    modeToggle.checked = savedTheme === 'dark-mode';
}

modeToggle.addEventListener('change', function() {
    if (this.checked) {
        body.classList.add('dark-mode');
        body.classList.remove('light-mode');
        localStorage.setItem('theme', 'dark-mode');
    } else {
        body.classList.add('light-mode');
        body.classList.remove('dark-mode');
        localStorage.setItem('theme', 'light-mode');
    }
});

// Update clock every second
setInterval(updateTime, 1000);
updateTime();  // Initial call to display time right away
