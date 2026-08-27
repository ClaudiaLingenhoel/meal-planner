<p>
  <img src="docs/screenshots/logo.png" alt="Meal Planner Logo" width="300">
</p>

MealPlanner is a Symfony web application for managing recipes, planning meals for a week, and generating a shopping list from the planned meals.

![Recipe Browser](docs/screenshots/recipe-browser.png)

This application was developed as the final project of a Full-Stack Web Development course by a two-person team.

## Main Features

- User registration, login, logout, and profile management
- Recipe browsing and recipe detail pages
- Search recipes by title, description, instructions, and ingredients
- Filtering by dietary type, cooking time, and calories per serving
- Recipe sorting by date, title, cooking time, and calories
- Creation, editing, and deletion of user-owned recipes
- Recipe image upload
- Multiple ingredients per recipe, including quantities, units, and optional shopping notes
- Dynamic ingredient scaling based on servings
- Weekly meal planner with breakfast, lunch, dinner, and snack slots
- Adjustable servings for planned meals
- Weekly shopping list generated from planned meals
- Aggregation and scaling of matching shopping-list ingredients
- Role-based administration for users, recipes, and meal plans
- Account blocking for administrators
- Server-side authorization for recipe and meal-plan ownership
- Responsive interface based on Bootstrap

## Technology

- PHP
- Symfony
- Doctrine ORM and Doctrine Migrations
- MySQL
- Twig
- Bootstrap
- JavaScript
- EasyAdmin

## Project Structure

```text
assets/        JavaScript and CSS
config/        Symfony configuration
docs/          ERD, requirements, personas, and user stories
migrations/    Doctrine database migrations
public/        Public files and recipe images
sql/           Database dump with project data
src/           Controllers, entities, forms, repositories, security, and services
templates/     Twig templates
```

## Database Design
![Entity Relationship Diagram](docs/erd/erd.png)

## Screenshots

### Recipe Details
![Recipe Details](docs/screenshots/recipe-details.png)

### Weekly Meal Planner
![Weekly Meal Planner](docs/screenshots/meal-planner.png)

### Shopping List
![Shopping List](docs/screenshots/shopping-list.png)

## Setup

### 1. Install dependencies

```bash
composer install
```

### 2. Configure the database

Create the local environment file from the included example:

```bash
cp .env.local.example .env.local
```

Update `DATABASE_URL` in `.env.local` with the local MySQL credentials.

Example:

```dotenv
DATABASE_URL="mysql://USERNAME:PASSWORD@127.0.0.1:3306/meal_planner?serverVersion=8.0.32&charset=utf8mb4"
```

### 3. Create and import the database

Create a MySQL database named `meal_planner` and import:

```text
sql/meal_planner.sql
```

The SQL dump contains the database structure and the project data used for the application demo.

Demo accounts: user@user.at pw: aaa111 / admin@admin.at pw: aaa111

Alternatively, the database schema can be created from the Doctrine migrations, but the demo and reference data must then be added separately.

### 4. Start the application

Using Symfony CLI:

```bash
symfony server:start
```

Then open the local URL shown by the Symfony server.

## Documentation

Additional project documentation:

- `docs/requirements.md` – project requirements
- `docs/personas-user-stories.md` – user personas, user stories, and acceptance criteria


## Authors

- [@Havokitten](https://github.com/Havokitten)
- [@ClaudiaLingenhoel](https://github.com/ClaudiaLingenhoel)