
document.addEventListener("DOMContentLoaded", function () {

    // 1. Display a welcome message
    const welcomeMessage = document.getElementById("welcome-message");

    if (welcomeMessage) {
        const hour = new Date().getHours();
        let greeting;

        if (hour < 12) {
            greeting = "Good Morning.";
        } else if (hour < 18) {
            greeting = "Good Afternoon.";
        } else {
            greeting = "Good Evening.";
        }

        welcomeMessage.textContent =
            greeting + " Welcome to Amped & Electrified!";
    }

    // 2. Update the copyright year automatically
    const yearElement = document.getElementById("current-year");

    if (yearElement) {
        yearElement.textContent = new Date().getFullYear();
    }

    // 3. Toggle the mobile navigation menu
    const menuButton = document.getElementById("menu-toggle");
    const navigation = document.getElementById("main-navigation");

    if (menuButton && navigation) {
        menuButton.addEventListener("click", function () {
            const menuIsOpen = navigation.classList.toggle("nav-open");

            menuButton.setAttribute(
                "aria-expanded",
                String(menuIsOpen)
            );

            menuButton.textContent = menuIsOpen ? "Close" : "Menu";
        });

        // Close the menu when a navigation link is clicked
        navigation.querySelectorAll("a").forEach(function (link) {
            link.addEventListener("click", function () {
                navigation.classList.remove("nav-open");
                menuButton.setAttribute("aria-expanded", "false");
                menuButton.textContent = "Menu";
            });
        });
    }

});
