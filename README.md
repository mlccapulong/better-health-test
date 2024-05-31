
# Music Player App

The Music Player App is a web application that allows users to listen to music tracks, register, login, and enjoy a seamless music playback experience. The app is built using Laravel 10, Vue.js 3, and Bootstrap 3.4.1 CSS framework with a dark theme color. Font Awesome free version is used for icons.

## Features
- User registration and login system
- List of songs displayed in the user interface
- Play/pause functionality for songs
- Next/previous song selection
- Random play functionality (without repeating the same song consecutively)
- Avoid playing songs from the same artist consecutively

## Installation

1. Clone the repository:
```
git clone <repository-url>
```

2. Navigate to the project directory:
```
cd music-player-app
```

3. Install dependencies:
```
composer install
npm install
```

4. Create a copy of the .env.example file and rename it to .env. Update the database credentials and other necessary configuration options.

5. Generate an application key:
```
php artisan key:generate
```

6. Run the database migrations:
```
php artisan migrate
```

7. Compile frontend assets:
```
npm run dev
```

## Usage
1. Start the Laravel development server:
```
php artisan serve
```

2. Access the application in your web browser at http://localhost:8000.

3. Register or login to your account.

4. Navigate to the Music section to start playing songs.