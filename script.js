
    // Add this JavaScript
    document.addEventListener('DOMContentLoaded', function () {
        const profiles = document.querySelectorAll('.profile');
        const loginSignup = document.querySelector('.login_signup');
        const loginForm = document.querySelector('.login');
        const signupForm = document.querySelector('.signup');
        const switchLinks = document.querySelectorAll('.switch-form');
        const profileinfo = document.querySelector('.profileinfo');
        // Toggle login/signup box
        profiles.forEach(profile => {
            profile.addEventListener('click', function (e) {
                e.stopPropagation();
                loginSignup.style.display = loginSignup.style.display === 'none' ? 'block' : 'none';
                // Show login form by default when opening
                if (!loginForm.classList.contains('active')) {
                    loginForm.classList.add('active');
                    signupForm.classList.remove('active');
                }
            });
        });

        // Switch between login/signup forms
        switchLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                loginForm.classList.toggle('active');
                signupForm.classList.toggle('active');
            });
        });

        // Close when clicking outside
        document.addEventListener('click', function (e) {
            if (!loginSignup.contains(e.target) && !Array.from(profiles).some(profile => profile.contains(e.target))) {
                loginSignup.style.display = 'none';
            }
        });

        // Prevent closing when clicking inside the box
        loginSignup.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });
    const info = document.querySelector(".profileinfo");
  document.querySelector(".profile").addEventListener("click", function () {
    if (info.style.display === "none" || info.style.display === " ") {
      info.style.display = "block";
    } else {
      info.style.display = "none";
    }
  });
  document.querySelector(".close").addEventListener("click",function(){
     info.style.display = "none";
  });
  let sellTab = null;

document.querySelector(".Sell").addEventListener("click", function() {
  if (sellTab === null || sellTab.closed) {
    sellTab = window.open("sellform.php", "_blank");
  } else {
    sellTab.focus();
  }
});



