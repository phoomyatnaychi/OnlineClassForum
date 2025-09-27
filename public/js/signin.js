// filepath: online-class-sharing-signin/public/scripts/signin.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const errorMessage = document.createElement('p');
    errorMessage.style.color = 'red';
    form.appendChild(errorMessage);

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();

        if (!email || !password) {
            errorMessage.textContent = 'Email and password are required.';
            return;
        }

        const formData = new FormData();
        formData.append('email', email);
        formData.append('password', password);

        fetch('src/signin.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect or perform successful sign-in actions
                window.location.href = 'dashboard.html'; // Example redirect
            } else {
                errorMessage.textContent = data.message;
            }
        })
        .catch(error => {
            errorMessage.textContent = 'An error occurred. Please try again.';
            console.error('Error:', error);
        });
    });
});