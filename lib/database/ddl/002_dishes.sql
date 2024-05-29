-- Entrees
INSERT INTO
    menu (
        id,
        name,
        image_path,
        price,
        description,
        category_id
    )
VALUES
    (
        1,
        'Bruschetta',
        '/images/bruschetta.jpg',
        8.99,
        'Toasted bread topped with fresh tomatoes, garlic, basil, and olive oil.',
        0
    ),
    (
        2,
        'Caprese Salad',
        '/images/caprese_salad.jpg',
        10.99,
        'Fresh mozzarella, tomatoes, basil, and balsamic glaze.',
        0
    ),
    (
        3,
        'Focaccia',
        '/images/focaccia.jpg',
        6.99,
        'Focaccia with olives.',
        0
    );

-- Main Dishes
INSERT INTO
    menu (
        id,
        name,
        image_path,
        price,
        description,
        category_id
    )
VALUES
    (
        4,
        'Pasta Amatriciana',
        '/images/amatriciana_pasta.jpg',
        12.99,
        'Classic pasta with tomato sauce, guanciale, and pecorino romano.',
        1
    ),
    (
        5,
        'Spaghetti Carbonara',
        '/images/spaghetti_carbonara.jpg',
        14.99,
        'Spaghetti pasta with creamy egg and pancetta sauce.',
        1
    ),
    (
        6,
        'Lasagna',
        '/images/lasagna.jpg',
        16.99,
        'Layers of pasta with Bolognese sauce, béchamel, and cheese.',
        1
    );

-- Pizza
INSERT INTO
    menu (
        id,
        name,
        image_path,
        price,
        description,
        category_id
    )
VALUES
    (
        7,
        'Pepperoni Pizza',
        '/images/pepperoni_pizza.jpg',
        14.99,
        'Classic pizza with tomato sauce, mozzarella cheese, and pepperoni slices.',
        2
    ),
    (
        8,
        'Mushroom Pizza',
        '/images/mushroom_pizza.jpg',
        16.99,
        'Pizza with mozzarella cheese and mushrooms.',
        2
    ),
    (
        9,
        'Pizza Margerita',
        '/images/margherita_pizza.jpg',
        15.99,
        'Classic italian pizza with mozzarella cheese, tomato sauce, and basil.',
        2
    );

-- Second Dishes
INSERT INTO
    menu (
        id,
        name,
        image_path,
        price,
        description,
        category_id
    )
VALUES
    (
        10,
        'Caciuccio',
        '/images/caciucco.jpg',
        17.99,
        'Soup with tomato sauce and seafood.',
        3
    ),
    (
        11,
        'Saltimbocca alla Romana',
        '/images/saltimbocca.jpg',
        18.99,
        'Veal cutlets with prosciutto and sage in a white wine sauce.',
        3
    ),
    (
        12,
        'Eggplant Parmigiana',
        '/images/eggplant_parmigiana.jpg',
        15.99,
        'Breaded and fried eggplant slices layered with marinara sauce and cheese.',
        3
    );

-- Desserts
INSERT INTO
    menu (
        id,
        name,
        image_path,
        price,
        description,
        category_id
    )
VALUES
    (
        13,
        'Tiramisu',
        '/images/tiramisu.jpg',
        8.99,
        'Classic Italian dessert made with layers of coffee-soaked ladyfingers and mascarpone cheese.',
        4
    ),
    (
        14,
        'Cannoli',
        '/images/cannoli.jpg',
        6.99,
        'Crispy pastry shells filled with sweetened ricotta cheese and chocolate chips.',
        4
    ),
    (
        15,
        'Panna Cotta',
        '/images/panna_cotta.jpg',
        7.99,
        'Creamy Italian dessert topped with berry compote.',
        4
    );