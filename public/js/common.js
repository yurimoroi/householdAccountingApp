window.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll(".l-sidebar .e-list .e-item");
    const url = window.location.pathname.substring(1);

    links.forEach((link) => {
        const title = link.querySelector(".e-link-text").textContent;

        title.toLowerCase() === url && link.classList.add("active");
    });
});

const toggleSidebar = () => {
    const ham = document.querySelector(".e-ham");
    const sidebar = document.querySelector(".l-sidebar");

    const toggle = () => {
        sidebar.classList.contains("active")
            ? sidebar.classList.remove("active")
            : sidebar.classList.add("active");
    };

    ham.addEventListener("click", () => {
        toggle();
    });

    sidebar.addEventListener("click", (e) => {
        e.currentTarget === e.target && toggle();
    });
};

const onLogOut = () => {
    const logOut = document.querySelector(".e-logout");
    const form = document.querySelector(".l-header .e-form");

    logOut.addEventListener("click", () => {
        form.submit();
    });
};

const getCsrfToken = () => {
    return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
};

toggleSidebar();
onLogOut();
