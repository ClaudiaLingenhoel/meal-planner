const initialisedShoppingLists = new WeakSet();

const initialiseShoppingList = () => {
    const shoppingList = document.querySelector("#shopping-list");
    if (!shoppingList || initialisedShoppingLists.has(shoppingList)) {
        return;
    }

    initialisedShoppingLists.add(shoppingList);
    const checkboxes = shoppingList.querySelectorAll(".shopping-checkbox");
    const week = shoppingList.dataset.week;
    const user = shoppingList.dataset.user;
    const storageKey = `checkedShoppingItems_${user}_${week}`;

    let checkedItems = [];
    try {
        const storedItems = JSON.parse(localStorage.getItem(storageKey));
        if (Array.isArray(storedItems)) {
            checkedItems = storedItems;
        }
    } catch {
        localStorage.removeItem(storageKey);
    }

    checkboxes.forEach((checkbox) => {
        const key = checkbox.dataset.key;

        if (checkedItems.includes(key)) {
            checkbox.checked = true;
        }

        checkbox.addEventListener("change", () => {
            if (checkbox.checked) {
                if (!checkedItems.includes(key)) {
                    checkedItems.push(key);
                }
            } else {
                checkedItems = checkedItems.filter((itemKey) => itemKey !== key);
            }
            localStorage.setItem(storageKey, JSON.stringify(checkedItems));
        });
    });
};

document.addEventListener("turbo:load", initialiseShoppingList);
initialiseShoppingList();
