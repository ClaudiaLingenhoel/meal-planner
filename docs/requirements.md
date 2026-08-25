# Requirements

## 1. Functional Requirements

### 1.1 User Accounts

Users must be able to:

- Register an account.
- Log in and log out.
- Edit their profile information.
- Browse recipes created by all users.
- Access only their own user-specific data and functionality.

### 1.2 Recipe Management

Users must be able to:

- View a list of all available recipes.
- Search recipes by name.
- Filter recipes by dietary type.
- View individual recipe details, including:
  - Recipe name
  - Ingredients
  - Instructions
  - Cooking time
  - Dietary type
  - Image
- Create their own recipes.
- Edit their own recipes.
- Delete their own recipes.
- Upload an image for their recipes.

Recipe forms should support the information required by the database design, including ingredients, instructions, cooking time, servings, dietary type, and other relevant recipe information.

Users must not be able to edit or delete recipes belonging to other users.

### 1.3 Meal Planning

Users must be able to:

- Add a recipe to their weekly meal planner.
- Select a date for the planned meal.
- Select a meal time:
  - Breakfast
  - Lunch
  - Dinner
- View their planned meals in a weekly planner.
- Edit planned meals.
- Remove planned meals.

Users must only be able to view and modify their own planned meals.

### 1.4 Administration

Administrators must be able to:

- Log in using an administrator account.
- Access protected administration functionality.
- View all recipes.
- Create recipes.
- Edit any recipe.
- Delete any recipe.
- View all users.
- Create users.
- Edit users.
- Block and unblock user accounts.
- View all users' meal plans.

Normal users must not be able to access administrator functionality.

## 2. Validation Requirements

The application must:

- Validate required form fields.
- Perform validation on both the client and server where appropriate.
- Validate email addresses.
- Prevent registration with an already-used email address.
- Validate uploaded recipe images.
- Display clear error messages when submitted data is invalid.
- Validate meal-planning data before saving it.

## 3. Authentication & Security Requirements

The application must:

- Store passwords using secure password hashing.
- Use secure session-based authentication.
- Distinguish between normal users and administrators through user roles.
- Perform authorization checks server-side.
- Prevent users from modifying other users' recipes.
- Prevent users from modifying other users' meal plans.
- Prevent normal users from accessing administrator functionality.
- Prevent blocked accounts from accessing functionality as defined by the application's authentication rules.

## 4. Non-Functional Requirements

### Responsive Design

The application must provide a usable interface on:

- Desktop
- Tablet
- Mobile

### Usability

The application should:

- Use a clear and consistent navigation structure.
- Present recipe information in an easily readable format.
- Make the weekly meal planner easy to understand at a glance.
- Provide clear labels and feedback for forms and actions.
- Maintain a consistent visual design throughout the application.

### Maintainability

The project should:

- Follow Symfony conventions and recommended project structure.
- Keep presentation, application logic, and database-related code appropriately separated.
- Use clear and consistent naming conventions.
- Avoid unnecessary duplication of code.
- Maintain a clean and organized repository structure.

## 5. Technical Requirements

- **Backend:** PHP / Symfony
- **Frontend:** HTML, CSS and JavaScript
- **UI Framework:** Bootstrap
- **Database:** MySQL
- **Version Control:** Git/GitHub

## 6. Core Project Scope

The minimum viable application must provide:

1. User registration and authentication
2. Profile management
3. Recipe browsing
4. Recipe details
5. Recipe creation, editing and deletion
6. Recipe image uploads
7. Recipe search
8. Dietary-type filtering
9. Weekly meal planning
10. Planned meal editing and removal
11. Administrator authentication
12. Administrator recipe management
13. Administrator user management
14. Administrator meal-plan overview
15. Form validation
16. Secure authentication
17. Authorization and ownership checks
18. Responsive design

All core functionality should be completed and tested before optional features are implemented.

## 7. Nice-to-Have Features

The following two optional features have been selected for implementation if sufficient time remains after all core functionality is complete:

### Filter Recipes by Cooking Time (or calories)

Users should be able to filter recipes based on their cooking time.

### Featured Recipes

The homepage should include a section displaying selected or featured recipes.

## 8. Optional Features Not in Current Scope

The following features are part of the assignment's suggested nice-to-have functionality but have **not** been selected for the current project scope:

- Recipe ratings
- Daily planner view
- Printing the weekly meal plan
- Admin recipe approval workflow

These features will not be implemented unless the core requirements and the two selected nice-to-have features are completed ahead of schedule.

## 9. Further Team Planned Features

The following features may be implemented after all core functionality is complete:

- Adjust ingredient quantities based on the selected number of servings.
- Generate a shopping list from the weekly meal plan.
- Combine matching ingredients and quantities within the shopping list.