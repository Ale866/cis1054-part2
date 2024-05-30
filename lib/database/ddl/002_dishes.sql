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
        '/images/dishes/bruschetta.jpg',
        8.99,
        'A classic Italian appetizer, Bruschetta is made with slices of toasted bread, generously topped with a flavorful mix of fresh diced tomatoes, minced garlic, aromatic basil, and a drizzle of high-quality extra virgin olive oil. It is the perfect start to any meal, combining crisp textures with vibrant flavors.',
        0
    ),
    (
        2,
        'Caprese Salad',
        '/images/dishes/caprese_salad.jpg',
        10.99,
        'Our Caprese Salad is a delightful combination of fresh mozzarella cheese, juicy ripe tomatoes, and fragrant basil leaves, all drizzled with a rich balsamic glaze. This simple yet elegant salad celebrates the flavors of fresh, high-quality ingredients and is a refreshing choice for any occasion.',
        0
    ),
    (
        3,
        'Focaccia',
        '/images/dishes/focaccia.jpg',
        6.99,
        'This traditional Italian flatbread, Focaccia, is baked to perfection and topped with a generous amount of savory olives. Its soft, fluffy texture and rich olive flavor make it an irresistible side dish or snack that pairs wonderfully with a variety of dips and spreads.',
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
        '/images/dishes/amatriciana_pasta.jpg',
        12.99,
        'Our Pasta Amatriciana is a traditional Italian dish featuring perfectly cooked pasta tossed in a robust tomato sauce, enriched with crispy guanciale (Italian cured pork cheek), and topped with a generous amount of grated pecorino romano cheese. This dish is a true taste of Italy, offering a perfect balance of savory and tangy flavors.',
        1
    ),
    (
        5,
        'Spaghetti Carbonara',
        '/images/dishes/spaghetti_carbonara.jpg',
        14.99,
        'Experience the classic Spaghetti Carbonara, a rich and creamy pasta dish made with al dente spaghetti, a luscious sauce of eggs and Parmesan cheese, and crispy pancetta. Each bite delivers a decadent combination of creamy, cheesy goodness with the savory, salty notes of pancetta.',
        1
    ),
    (
        6,
        'Lasagna',
        '/images/dishes/lasagna.jpg',
        16.99,
        'Our Lasagna is a hearty, comforting dish featuring layers of tender pasta sheets, rich Bolognese sauce made with ground beef and tomatoes, creamy béchamel sauce, and a generous topping of melted cheese. This classic Italian favorite is baked to perfection, offering a deliciously satisfying meal in every slice.',
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
        '/images/dishes/pepperoni_pizza.jpg',
        14.99,
        'Enjoy our classic Pepperoni Pizza, featuring a crispy yet chewy crust topped with a rich tomato sauce, gooey mozzarella cheese, and generous slices of spicy pepperoni. It is a timeless favorite that delivers a perfect blend of savory, cheesy, and spicy flavors in every bite.',
        2
    ),
    (
        8,
        'Mushroom Pizza',
        '/images/dishes/mushroom_pizza.jpg',
        16.99,
        'Our Mushroom Pizza is a delightful combination of a crispy crust, a bed of gooey mozzarella cheese, and a generous topping of fresh, earthy mushrooms. Each bite offers a wonderful mix of textures and flavors, making it a perfect choice for mushroom lovers and pizza enthusiasts alike.',
        2
    ),
    (
        9,
        'Pizza Margherita',
        '/images/dishes/margherita_pizza.jpg',
        15.99,
        'Savor the simplicity and elegance of our Pizza Margherita, featuring a perfectly baked crust topped with fresh mozzarella cheese, a rich tomato sauce, and fragrant basil leaves. This classic Italian pizza is a testament to the beauty of fresh, high-quality ingredients and traditional preparation methods.',
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
        'Caciucco',
        '/images/dishes/caciucco.jpg',
        17.99,
        'Caciucco is a traditional Italian seafood stew, brimming with a variety of fresh seafood such as fish, squid, and shellfish, all simmered in a rich tomato sauce infused with garlic, herbs, and white wine. This hearty and flavorful dish is a true celebration of the sea, offering a delightful and warming meal.',
        3
    ),
    (
        11,
        'Saltimbocca alla Romana',
        '/images/dishes/saltimbocca.jpg',
        18.99,
        'Our Saltimbocca alla Romana features tender veal cutlets topped with slices of prosciutto and fresh sage leaves, all cooked in a delicious white wine sauce. This elegant and flavorful dish is a traditional Italian favorite that combines the savory flavors of veal and prosciutto with the aromatic hint of sage.',
        3
    ),
    (
        12,
        'Eggplant Parmigiana',
        '/images/dishes/eggplant_parmigiana.jpg',
        15.99,
        'Eggplant Parmigiana is a beloved Italian dish made with breaded and fried eggplant slices, layered with rich marinara sauce and melted cheese. Baked to perfection, this dish offers a delightful combination of crispy eggplant, tangy tomato sauce, and gooey cheese, making it a satisfying vegetarian option.',
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
        '/images/dishes/tiramisu.jpg',
        8.99,
        'Indulge in our classic Tiramisu, a beloved Italian dessert made with layers of coffee-soaked ladyfingers, rich mascarpone cheese, and a dusting of cocoa powder. This creamy, dreamy dessert offers a perfect balance of coffee and sweet flavors, making it an irresistible end to any meal.',
        4
    ),
    (
        14,
        'Cannoli',
        '/images/dishes/cannoli.jpg',
        6.99,
        'Our Cannoli features crispy pastry shells filled with a luscious mixture of sweetened ricotta cheese and chocolate chips. Each bite offers a delightful contrast of crunchy shell and creamy filling, making it a perfect treat for those with a sweet tooth.',
        4
    ),
    (
        15,
        'Panna Cotta',
        '/images/dishes/panna_cotta.jpg',
        7.99,
        'Panna Cotta is a smooth and creamy Italian dessert made with sweetened cream, set to perfection and topped with a vibrant berry compote. This elegant dessert is light, refreshing, and bursting with flavor, making it a perfect choice for a delightful end to any meal.',
        4
    );