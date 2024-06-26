<?php

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../database/database.php';

class Dish
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function get_dish(string $dish_id): array
    {
        $user_id = $_SESSION['user_id'] ?? null;
        $query = "SELECT 
        m.id,
        m.name,
        m.price,
        c.name as category,
        m.description,
        m.image_path as image,
        IIF(f.id IS NOT NULL, 1,0) as favorite
        FROM menu m 
        INNER JOIN categories c ON m.category_id = c.id
        LEFT JOIN favorites f ON f.menu_id = m.id AND f.user_id = :user_id
        WHERE m.id=:id
        ";
        return $this->db->query($query, [
            ['name' => 'id', 'value' => $dish_id, 'type' => SQLITE3_INTEGER],
            ['name' => 'user_id', 'value' => $user_id, 'type' => SQLITE3_INTEGER]
        ])->first();
    }

    public function create(string $name, string $price, string $category_id, string $description, array $image): array
    {
        $errors = [];
        $errors['name'] = $this->validate_name($name);
        $errors['price'] = $this->validate_price($price);
        $errors['category_id'] = $this->validate_category($category_id);
        $errors['description'] = $this->validate_description($description);
        $errors['image'] = $this->validate_image($image);
        $errors = array_filter($errors);
        if (!empty($errors)) {
            return $errors;
        }


        $query = "INSERT INTO menu (name, price, category_id, description, image_path) VALUES (:name, :price, :category_id, :description, :image_path)";
        $this->db->query($query, [
            ['name' => ':name', 'value' => $name, 'type' => SQLITE3_TEXT],
            ['name' => ':price', 'value' => $price, 'type' => SQLITE3_TEXT],
            ['name' => ':category_id', 'value' => $category_id, 'type' => SQLITE3_INTEGER],
            ['name' => ':description', 'value' => $description, 'type' => SQLITE3_TEXT],
            ['name' => ':image_path', 'value' => $this->upload_image($image), 'type' => SQLITE3_TEXT]
        ]);
        return [];
    }

    private function upload_image($image)
    {
        $target_dir = __DIR__ . '/../../assets/images/custom_dishes/';
        $target_file = $target_dir . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $target_file);
        return 'images/custom_dishes/' . basename($image['name']);
    }

    public function delete($dish_id): void
    {
        $dish = $this->get_dish($dish_id);
        if ($dish['image'] !== 'images/custom_dishes/default.jpg') {
            unlink(__DIR__ . '/../../assets/' . $dish['image']);
        }
        $query = "DELETE FROM menu WHERE id = :id";
        $this->db->query($query, [
            ['name' => ':id', 'value' => $dish_id, 'type' => SQLITE3_INTEGER]
        ]);
    }

    private function validate_name(string $name): string
    {
        if ($name == null) {
            return 'Name is required';
        }
        return '';
    }

    private function validate_price(string $price): string
    {
        if ($price == null) {
            return 'Price is required';
        }
        if ($price < 0) {
            return 'Price must be greater than 0';
        }
        return '';
    }

    private function validate_category(string $category_id): string
    {

        if ($category_id == null) {
            return 'Category is required';
        }
        $categories = $this->db->query("SELECT id FROM categories")->fetch_all();
        $categories = array_map(fn ($category) => $category['id'], $categories);
        if (!in_array($category_id, $categories)) {
            return  'Invalid category';
        }
        return '';
    }

    private function validate_description(string $description): string
    {
        if ($description == null) {
            return 'Description is required';
        }
        return '';
    }

    private function validate_image(array $image): string
    {
        if ($image['error'] !== 0) {
            return  'Image is required';
        }
        $imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
            return  'Only JPG, JPEG, PNG files are allowed';
        }
        return '';
    }
}
