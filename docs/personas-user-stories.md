# User Personas & User Stories

## Product Philosophy

The application focuses on the joy of cooking, eating, and discovering food rather than calorie counting, weight loss, or diet culture. It helps users discover recipes, plan regular meals, accommodate dietary preferences, and organize their weekly grocery shopping.

---

# User Personas

## Mia – The Budget-Conscious Student

**Age:** 22  
**Occupation:** University student  
**Dietary preference:** Vegetarian

Mia lives on a limited budget and wants to avoid unnecessary grocery purchases and expensive last-minute takeout.

**Goals:**

* Plan meals for the week
* Shop efficiently and keep food expenses manageable
* Easily find vegetarian and vegan recipes

---

## Alex – Rediscovering the Joy of Food

**Age:** 28

Alex is recovering from an eating disorder and wants to rediscover cooking and eating as enjoyable parts of everyday life. Meal planning helps provide structure without focusing on calories, weight, or diet culture.

**Goals:**

* Find inspiration for enjoyable meals
* Establish regular meals throughout the week
* Reduce the stress of deciding what to eat

---

## Daniel – The Family Meal Planner

**Age:** 38  
**Household:** Family of four with two young children

Daniel is responsible for most of his family's meal planning and cooking and wants to organize recipes his family enjoys.

**Goals:**

* Build a collection of family recipes
* Plan meals for the week
* Adjust recipes for his family size
* Simplify weekly grocery shopping

---

# User Stories

## US01 – Account & Profile

> As a user, I want to create an account, log in, and manage my profile, so that I can use and personalize my meal planner.

### Acceptance Criteria

* Users can register, log in, and log out.
* Passwords are stored securely.
* Users can edit their profile information and dietary preference.

---

## US02 – Browse & Discover Recipes

> As a vegetarian user, I want to browse, search, and filter recipes, so that I can easily find meals suitable for my dietary preference.

### Acceptance Criteria

* Users can browse recipes from all users and view recipe details.
* Recipe details include ingredients, instructions, cooking time, servings, and dietary type.
* Users can search recipes and filter by dietary type.
* A vegetarian filter includes vegetarian and vegan recipes.

---

## US03 – Manage Own Recipes

> As a user, I want to create and manage my own recipes, so that I can build a personal recipe collection.

### Acceptance Criteria

* Users can create, edit, and delete their own recipes.
* Recipes can contain multiple ingredients with quantity, unit, and optional specification.
* Users can upload a recipe image; a default is shown when none is provided.
* Users cannot edit or delete another user's recipes.
* Forms are validated.

---

## US04 – Weekly Meal Planning

> As a user, I want to plan my meals for the week, so that I can establish a regular meal routine.

### Acceptance Criteria

* Users can schedule recipes by date and meal time: breakfast, lunch, or dinner.
* Users can view their weekly meal plan.
* Users can edit and remove planned meals.
* The same recipe cannot be added twice to the same meal slot.
* Users can only manage their own meal plan.

---

## US05 – Weekly Shopping List

> As a user, I want a shopping list based on my weekly meal plan, so that I know what groceries I need before shopping.

### Acceptance Criteria

* Ingredients from planned recipes are included.
* Matching ingredients with compatible units are grouped and their quantities added together.
* Ingredient specifications are displayed where applicable.

---

## US06 – Adjust Servings

> As a user cooking for multiple people, I want to adjust the number of servings of a recipe, so that I can see the required ingredient quantities.

### Acceptance Criteria

* Users can select a different number of servings.
* Ingredient quantities are adjusted proportionally.
* Stored recipe quantities remain unchanged.

---

## US07 – Admin Management

> As an admin, I want to manage users, recipes, and meal plans, so that I can maintain the platform.

### Acceptance Criteria

* Admins can view, create, and edit users and block or unblock accounts.
* Admins can view, edit, and delete any recipe.
* Admins can view all meal plans.
* Regular users cannot access admin functionality.

---

# Optional User Stories

## US08 – Save Recipes

> As a user looking for meal inspiration, I want to save recipes, so that I can easily find them again later.

### Acceptance Criteria

* Users can save recipes created by other users.
* Users can view their saved recipes in one place.
* Users can remove recipes from their saved list.
* Saving a recipe does not modify the original recipe.
