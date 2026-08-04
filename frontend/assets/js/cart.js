// =========================
// Quantity Buttons
// =========================

const minusBtns = document.querySelectorAll(".minus");
const plusBtns = document.querySelectorAll(".plus");

minusBtns.forEach(btn => {

    btn.addEventListener("click", () => {

        let input = btn.nextElementSibling;

        let qty = parseInt(input.value);

        if (qty > 1) {

            input.value = qty - 1;

        }

    });

});

plusBtns.forEach(btn => {

    btn.addEventListener("click", () => {

        let input = btn.previousElementSibling;

        let qty = parseInt(input.value);

        input.value = qty + 1;

    });

});