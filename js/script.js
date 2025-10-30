// js/script.js
document.addEventListener("DOMContentLoaded", () => {
    // Add 'active' class to current nav link
    const currentLocation = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.sidebar nav a');

    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentLocation) {
            link.classList.add('active');
        }
    });

    // Simple fade-in animation for panels
    const panels = document.querySelectorAll('.glass-panel, .glass-form, .glass-table, .glass-card');
    panels.forEach((panel, index) => {
        panel.style.animation = `fadeInUp 0.5s ease ${index * 0.1}s both`;
    });
});

// Add CSS keyframes for the animation (you can add this to your style.css too)
const styleSheet = document.createElement("style");
styleSheet.type = "text/css";
styleSheet.innerText = `
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
`;
document.head.appendChild(styleSheet);