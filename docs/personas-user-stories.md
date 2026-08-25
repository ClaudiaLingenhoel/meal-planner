# User Personas & User Stories

## Product Philosophy

The application focuses on making cooking, meal planning, and grocery shopping simple and enjoyable. It helps users discover recipes, plan meals, accommodate dietary preferences, adjust serving sizes, and organize their weekly grocery shopping.

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

## Alex – The Busy Young Professional

**Age:** 28

Alex has a busy schedule and wants to make cooking a more regular and enjoyable part of everyday life. Meal planning helps reduce the stress of deciding what to eat and makes it easier to prepare meals in advance.

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
* Recipe details include ingredients, instructions, cooking time, servings, calories per serving, and dietary type.
* Users can search recipes and filter by dietary type.
* A vegetarian filter includes vegetarian and vegan recipes.

---

## US03 – Manage Own Recipes

> As a user, I want to create and manage my own recipes, so that I can build a personal recipe collection.

### Acceptance Criteria

* Users can create, edit, and delete their own recipes.
* Recipes can contain multiple ingredients with quantity, unit, and optional specification (shopping note).
* Users can provide calorie information per serving for their recipes.
* Users can upload a recipe image; a default is shown when none is provided.
* Users cannot edit or delete another user's recipes.
* Forms are validated.

---

## US04 – Weekly Meal Planning

> As a user, I want to plan my meals for the week, so that I can establish a regular meal routine.

### Acceptance Criteria

* Users can schedule recipes by date and meal time: breakfast, lunch, dinner, or snack.
* Users can view their weekly meal plan.
* Users can edit and remove planned meals.
* The same recipe cannot be added twice to the same meal slot.
* Users can only manage their own meal plan.

---

## US05 – Weekly Shopping List

> As a user, I want a shopping list based on my weekly meal plan, so that I know what groceries I need before shopping.

### Acceptance Criteria

* Ingredients from planned recipes are included based on the selected number of servings.
* Matching ingredients with compatible units are grouped and their quantities added together.
* Ingredient shopping notes are displayed where applicable.

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
