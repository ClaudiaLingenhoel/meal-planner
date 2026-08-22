const initialisedServingsInputs = new WeakSet();

const initialiseServingScaler = () => {
    const servingsInput = document.querySelector("#servings");
    if (!servingsInput || initialisedServingsInputs.has(servingsInput)) {
        return;
    }

    const originalServings = Number.parseInt(
        servingsInput.dataset.originalServings,
        10,
    );
    if (!Number.isFinite(originalServings) || originalServings < 1) {
        return;
    }

    initialisedServingsInputs.add(servingsInput);
    const ingredientAmounts = document.querySelectorAll(".ingredient-amount");

    servingsInput.addEventListener("input", () => {
        const selectedServings = Number.parseInt(servingsInput.value, 10);

        if (!Number.isFinite(selectedServings) || selectedServings < 1) {
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

            if (
                !Number.isFinite(originalQuantity) ||
                !quantityElement ||
                !unitElement
            ) {
                return;
            }

            quantityElement.textContent =
                Math.round(scaledQuantity * 100) / 100;

            unitElement.textContent = displayUnit;
        });
    });
};

document.addEventListener("turbo:load", initialiseServingScaler);
initialiseServingScaler();
