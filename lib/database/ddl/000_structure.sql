-- categories definition
CREATE TABLE categories (
    id INTEGER NOT NULL,
    name TEXT(32) NOT NULL,
    image_path TEXT,
    CONSTRAINT categories_pk PRIMARY KEY (id)
);

-- menu definition
CREATE TABLE menu (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    name TEXT(60),
    image_path TEXT,
    price REAL DEFAULT (0) NOT NULL,
    description TEXT,
    category_id INTEGER NOT NULL,
    CONSTRAINT menu_categories_FK FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- users definition
CREATE TABLE users (
    id INTEGER NOT NULL,
    password TEXT(32) NOT NULL,
    email TEXT(64) UNIQUE,
    "role" TEXT DEFAULT ('USER') NOT NULL,
    CONSTRAINT id_pk PRIMARY KEY (id)
);

-- favorites definition
CREATE TABLE favorites (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    menu_id INTEGER NOT NULL,
    CONSTRAINT favorites_menu_FK FOREIGN KEY (menu_id) REFERENCES menu(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT favorites_users_FK FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);