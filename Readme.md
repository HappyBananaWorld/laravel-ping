
# Laravel Ping

![Laravel Ping](./public/images/laravel-ping.png)

**Laravel Ping** is a package that shows all debug information live in a web panel.

---

## Installation

### Prerequisite
First, you need to install **Reverb**:

```bash
php artisan install:broadcasting
```

During installation, select **Reverb**.

### Install Laravel Ping
After installing Reverb, install Laravel Ping via Composer:

```bash
composer require happydev/laravel-ping
```

### Publish Config and Views
Publish the configuration and public assets:

```bash
php artisan vendor:publish --provider="LaravelPing\LiveDebuggerServiceProvider" --tag="config"
php artisan vendor:publish --provider="LaravelPing\LiveDebuggerServiceProvider" --tag="public"
```

---

## Setup


To view your debug messages, create a route in `web.php`:

```php
Route::get('/debug', function () {
    return view('debug');
});
```

Then, in your `debug.blade.php` view file, add this line at the top:

```php
@include('live-debugger::debugger')
```

This will render the live debugger panel on that page.

---

## Usage

You can send debug messages using:

```php
ping("Hello Ping");
p("Hello Ping");
```

`ping()` and `p()` will display your messages live in the web panel.

---

## Notes

- This package is intended for **development environment only**.
- Make sure Reverb is installed and active before using Laravel Ping.

---

## Future Features

- Support for filtering debug messages by type or source.
- Ability to save debug logs for later review.
- Customizable themes and panel layout.
- Integration with external monitoring tools.
