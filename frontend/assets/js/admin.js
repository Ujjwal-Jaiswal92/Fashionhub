// =========================
// Delete Confirmation
// =========================

const deleteBtns = document.querySelectorAll(".delete-btn");

deleteBtns.forEach(button => {

    button.addEventListener("click", function (e) {

        const confirmDelete = confirm(
            "Are you sure you want to delete this item?"
        );

        if (!confirmDelete) {
            e.preventDefault();
        }

    });

});

// =========================
// Sidebar Active Link
// =========================

const currentPage =
window.location.pathname.split("/").pop();

const links =
document.querySelectorAll(".sidebar a");

links.forEach(link => {

    if (link.getAttribute("href") === currentPage) {

        link.parentElement.classList.add("active");

    }

});