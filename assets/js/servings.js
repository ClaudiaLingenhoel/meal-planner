const servingsInput = document.querySelector("#servings");
const ingredientAmounts = document.querySelectorAll(".ingredient-amount");

if (servingsInput) {
    const originalServings = parseInt(servingsInput.dataset.originalServings);

    servingsInput.addEventListener("input", () => {
        const selectedServings = parseInt(servingsInput.value);

        if (selectedServings < 1) {
            return;
        }

        const factor = selectedServings / originalServings;

        ingredientAmounts.forEach((ingredientAmount) => {
            const originalQuantity = parseFloat(
                ingredientAmount.dataset.quantity,
            );

            const originalUnit = ingredientAmount.dataset.unit;

            let scaledQuantity = originalQuantity * factor;
            let displayUnit = originalUnit;

            if (originalUnit === "g" && scaledQuantity >= 1000) {
                scaledQuantity = scaledQuantity / 1000;
                displayUnit = "kg";
            } else if (originalUnit === "ml" && scaledQuantity >= 1000) {
                scaledQuantity = scaledQuantity / 1000;
                displayUnit = "l";
            }

            const quantityElement = ingredientAmount.querySelector(
                ".ingredient-quantity",
            );

            const unitElement =
                ingredientAmount.querySelector(".ingredient-unit");

            quantityElement.textContent =
                Math.round(scaledQuantity * 100) / 100;

            unitElement.textContent = displayUnit;
        });
    });
}
