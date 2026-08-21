const initialiseRecipeIngredients = () => {
    const collection = document.querySelector("#recipe-ingredients");
    const addButton = document.querySelector("#add-ingredient");

    if (!collection || !addButton || collection.dataset.initialised === "true") {
        return;
    }

    collection.dataset.initialised = "true";

    addButton.addEventListener("click", () => {
        const index = collection.dataset.index;
        const newForm = collection.dataset.prototype.replace(/__name__/g, index);

        collection.dataset.index = `${parseInt(index, 10) + 1}`;
        collection.insertAdjacentHTML("beforeend", newForm);
    });

    collection.addEventListener("click", (event) => {
        if (event.target.classList.contains("remove-ingredient")) {
            event.target.closest(".recipe-ingredient-item")?.remove();
        }
    });
};

document.addEventListener("turbo:load", initialiseRecipeIngredients);
initialiseRecipeIngredients();