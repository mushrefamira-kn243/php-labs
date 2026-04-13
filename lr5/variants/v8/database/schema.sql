CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    login VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    phone VARCHAR(20),
    city VARCHAR(50),
    gender VARCHAR(10),
    about TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS instruments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    brand VARCHAR(100),
    price DECIMAL(10,2) NOT NULL DEFAULT 0,
    condition VARCHAR(30),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Seed instruments
INSERT INTO instruments (name, type, brand, price, condition) VALUES
    ('Фортепіано Steinway & Sons Model D', 'струнний', 'Steinway & Sons', 150000.00, 'новий'),
    ('Скрипка Stradivarius', 'струнний', 'Antonio Stradivari', 50000.00, 'відмінний'),
    ('Труба Bach', 'духовий', 'Bach', 2500.00, 'новий'),
    ('Барабани Pearl', 'ударний', 'Pearl', 8000.00, 'б/в'),
    ('Гітара Gibson Les Paul', 'струнний', 'Gibson', 12000.00, 'відмінний'),
    ('Флейта Yamaha', 'духовий', 'Yamaha', 1500.00, 'новий'),
    ('Кларнет Buffet Crampon', 'духовий', 'Buffet Crampon', 3000.00, 'новий'),
    ('Бас-гітара Fender Precision', 'струнний', 'Fender', 2500.00, 'б/в'),
    ('Саксофон Selmer', 'духовий', 'Selmer', 4500.00, 'відмінний'),
    ('Ксилофон Adams', 'ударний', 'Adams', 2000.00, 'новий');
