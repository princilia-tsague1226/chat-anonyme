
const btn = document.getElementById("toggle-room-form");
const formBlock = document.getElementById("add-room-block");

if (btn && formBlock) {
    btn.addEventListener("click", function() {
        // Si c'est caché, on affiche. Si c'est affiché, on cache.
        if (formBlock.style.display === "none") {
            formBlock.style.display = "block";
            btn.innerText = "Annuler"; // On change le + en -
        } else {
            formBlock.style.display = "none";
            btn.innerText = "+ Ajouter un salon";
        }
    });
}
