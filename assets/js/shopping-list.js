const checkboxes = document.querySelectorAll(".shopping-checkbox");
const shoppingList = document.querySelector("#shopping-list");

if (shoppingList) {
    const week = shoppingList.dataset.week;
    const user = shoppingList.dataset.user;
    const storageKey = "checkedShoppingItems_" + user + "_" + week;

    let checkedItems = JSON.parse(localStorage.getItem(storageKey)) || [];

    checkboxes.forEach((checkbox) => {
        const key = checkbox.dataset.key;

        // restore checked items
        if (checkedItems.includes(key)) {
            checkbox.checked = true;
        }

        checkbox.addEventListener("change", () => {
            if (checkbox.checked) {
                // item.classList.add("checked");
                if (!checkedItems.includes(key)) {
                    checkedItems.push(key);
                }
            } else {
                // item.classList.remove("checked");

                checkedItems = checkedItems.filter((itemKey) => {
                    return itemKey !== key;
                });
            }
            localStorage.setItem(storageKey, JSON.stringify(checkedItems));
        });
    });
}
