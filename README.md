# User Management System - Backend

Laravel 11 backend for the User Management System.

## Requirements

- PHP 8.2 or higher
- Composer
- MySQL 5.7 or higher
- XAMPP (recommended for local development)

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd backend
```

2. Install dependencies:
```bash
composer install
```

3. Create environment file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Configure your database in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

6. Run migrations:
```bash
php artisan migrate
```

7. Start the development server:
```bash
php artisan serve
```

## API Documentation

### Endpoints

#### Users

- All users start with 0 points.
- As you click +/-, the leaderboard updates and users are re-ordered based on score.
- You are able to add users (+) and delete users (x)
- When the name is clicked on, UI would show details of this user.
    - Name
    - Age
    - Points
    - Address
- a model factory to fill the db with initial users with random values. : php artisan db:seed --class=UsersSeeders
- a laravel command to reset all scores.: php artisan app:reset-score
- Create a scheduled job that identifies the user with the highest points at a given moment and stores a new record in a winners table. :  php artisan app:winnerDeclared (file location :\app\Console\Commands\WinnerDeclared.php)



1. Get All Users
```
GET /api/userlist
Response: {
    "data": [
        {
            "id": number,
            "name": string,
            "points": number,
            "age": number,
            "address": string,
            "created_at": timestamp,
            "updated_at": timestamp
        }
    ]
}
```

2. Create User
```
POST /api/createuser
Request Body: {
    "name": string,
    "points": number,
    "age": number,
    "address": string
}
Response: {
    "data": {
        "id": number,
        "name": string,
        "points": number,
        "age": number,
        "address": string,
        "created_at": timestamp,
        "updated_at": timestamp
    }
}
```

3. Update User
```
PUT /api/updateuser/{id}
Request Body: {
    "name": string,
    "points": number,
    "age": number,
    "address": string
}
Response: {
    "data": {
        "id": number,
        "name": string,
        "points": number,
        "age": number,
        "address": string,
        "created_at": timestamp,
        "updated_at": timestamp
    }
}
```

4. Delete User
```
DELETE /api/deleteuser/{id}
Response: {
    "message": "User deleted successfully"
}
```

5. Get High score
```
Created  endpoint that returns the users info grouped by score and include the
average age of the users in json format. :  http://127.0.0.1:8000/api/user/groupbypoint

```

## Database Structure

### Users Table
- id (primary key)
- name
- points
- age
- address
- created_at
- updated_at

## CORS Configuration

The backend is configured to accept requests from the frontend. CORS settings can be found in:
- `config/cors.php`
- `app/Http/Middleware/Cors.php`

## Development

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
composer run-script phpcs
```

### Database Seeding
```bash
php artisan db:seed
```

## Troubleshooting

1. Database Connection Issues
   - Verify MySQL is running
   - Check database credentials in .env
   - Ensure database exists

2. CORS Issues
   - Check CORS configuration in config/cors.php
   - Verify frontend URL is allowed
   - Check if CORS middleware is properly registered

3. API Response Issues
   - Check Laravel logs in storage/logs/laravel.log
   - Verify request format matches API documentation
   - Ensure all required fields are provided

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This project is licensed under the MIT License. 