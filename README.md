<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

---

## 👤 Author

**Noval Althoff**  
📞 Contact: (+62) 821-3333-2201

💻 Purpose: Technical Test

⚙  Laravel Version: 12.8.1

---

## 🚀 Getting Started

### Follow these steps to set up the project locally:

1. **Clone the Repository**

   ```bash
   git clone https://github.com/novalalthoff/novalalthoff_fdtest.git

   cd novalalthoff_fdtest
   ```

2. **Install PHP Dependencies**

   ```bash
   composer install
   ```

3. **Install JavaScript Dependencies**

   ```bash
   npm install
   ```

4. **Copy and Configure Environment File**

   ```bash
   cp .env.example .env
   ```

   Then update your `.env` file with your local settings:

   ✅ Database Configuration

   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=novalalthoff_fdtest
   DB_USERNAME=postgres
   DB_PASSWORD=
   ```

   ✅ Email Configuration

   Update these with your own email credentials (default is Gmail):

   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your_email@gmail.com
   MAIL_PASSWORD=your_app_password  # Use App Password, NOT regular password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your_email@gmail.com
   MAIL_FROM_NAME="${APP_NAME}"
   ```

   💡 Tip: If using Gmail, make sure you use an App Password instead of your regular password.

   ✅ RabbitMQ Configuration

   ```env
   QUEUE_CONNECTION=rabbitmq

   RABBITMQ_HOST=127.0.0.1
   RABBITMQ_PORT=5672
   RABBITMQ_USER=your_rabbitmq_user
   RABBITMQ_PASSWORD=your_rabbitmq_password
   RABBITMQ_VHOST=/
   ```

5. **Run Database Migration and Seed**

   ```bash
   php artisan migrate --seed
   ```

6. **Create Laravel Storage Link**

   ```bash
   php artisan storage:link
   ```

7. **Start the Development Environment**

   ```bash
   composer run dev
   ```

   This command runs multiple processes concurrently to streamline your local development:

   - `php artisan serve` – starts the Laravel backend at http://127.0.0.1:8000
   - `php artisan queue:listen --tries=1` – starts the queue listener (for handling email and other jobs)
   - `npm run dev` – starts Vite for frontend asset hot reloading at http://localhost:5173

   You do not need to run `php artisan queue:work` separately — it's already handled by `composer run dev`.

8. **Enjoy!**

   You're ready to go 🎉, now open your browser and go to:

   ```
   http://localhost:8000
   ```

- **Nb**:

    _If you're facing an issue or stuck in verification page, you can manually check your OTP code on `verification_code` table._

    _If the issue still persist, you can use credential below to sign in (please take notes that you have to seed the database first):_

    email: `example@mail.com`

    password: `password`

---

## 📚 About Laravel

Laravel is a powerful PHP framework designed to make web development easy, expressive, and enjoyable. It includes features like:

- Elegant routing and middleware
- Blade templating engine
- Eloquent ORM for working with databases
- Built-in authentication and authorization
- Artisan CLI for productivity
- And much more...

📖 Learn more at the [Laravel Documentation](https://laravel.com/docs).

---

## 🤝 Contributing

Feel free to fork this project and submit pull requests. Contributions are always welcome!

---

## 🛡 License

This project is open-source and licensed under the [MIT license](https://opensource.org/licenses/MIT).
