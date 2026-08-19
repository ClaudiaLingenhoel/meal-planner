const collection = document.querySelector("#recipe-ingredients");
const addButton = document.querySelector("#add-ingredient");

if (collection && addButton) {
    // add new ingredient row
    addButton.addEventListener("click", () => {
        const index = collection.dataset.index;

        const newForm = collection.dataset.prototype.replace(
            /__name__/g,
            index,
        );

        collection.dataset.index = parseInt(index) + 1;

        collection.insertAdjacentHTML("beforeend", newForm);
    });

    collection.addEventListener("click", (event) => {
        if (event.target.classList.contains("remove-ingredient")) {
            event.target.closest(".recipe-ingredient-item").remove();
        }
    });
}
