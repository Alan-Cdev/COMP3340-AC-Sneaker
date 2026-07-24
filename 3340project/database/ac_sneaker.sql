CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 email VARCHAR(150) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 role ENUM('customer','admin') NOT NULL DEFAULT 'customer',
 status ENUM('active','disabled') NOT NULL DEFAULT 'active',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 category VARCHAR(80) NOT NULL,
 description TEXT NOT NULL,
 price DECIMAL(10,2) NOT NULL,
 colors VARCHAR(255) NOT NULL,
 sizes VARCHAR(255) NOT NULL,
 image VARCHAR(255) NOT NULL,
 rating DECIMAL(2,1) NOT NULL DEFAULT 4.5,
 active TINYINT(1) NOT NULL DEFAULT 1,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 total DECIMAL(10,2) NOT NULL,
 status ENUM('Processing','Shipped','Delivered','Cancelled') DEFAULT 'Processing',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_items (
 id INT AUTO_INCREMENT PRIMARY KEY,
 order_id INT NOT NULL,
 product_id INT NOT NULL,
 quantity INT NOT NULL,
 price DECIMAL(10,2) NOT NULL,
 color VARCHAR(50),
 size VARCHAR(20),
 FOREIGN KEY (order_id) REFERENCES orders(id),
 FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE service_requests (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 subject VARCHAR(160) NOT NULL,
 message TEXT NOT NULL,
 admin_response TEXT,
 status ENUM('Open','Answered','Closed') DEFAULT 'Open',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO users (name,email,password_hash,role,status) VALUES
('Site Administrator','admin@acsneaker.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.','admin','active'),
('Demo Customer','customer@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.','customer','active');

INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Urban Pulse','Lifestyle','Everyday low-top sneaker with soft foam cushioning.',89.99,'Black|White','7|8|9|10|11','assets/images/products/product-01.svg',4.4);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Aero Sprint','Running','Lightweight running shoe for daily training.',119.99,'Blue|Grey','7|8|9|10|11','assets/images/products/product-02.svg',4.5);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Court Nova','Basketball','High-top support with responsive cushioning.',139.99,'Red|Black','8|9|10|11|12','assets/images/products/product-03.svg',4.6);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Canvas Drift','Casual','Breathable canvas sneaker for warm weather.',69.99,'Cream|Navy','6|7|8|9|10','assets/images/products/product-04.svg',4.7);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Trail Forge','Hiking','Rugged trail shoe with reinforced grip.',149.99,'Olive|Brown','8|9|10|11|12','assets/images/products/product-05.svg',4.3);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Metro Knit','Lifestyle','Flexible knit upper and memory foam insole.',99.99,'Charcoal|Teal','7|8|9|10|11','assets/images/products/product-06.svg',4.4);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Velocity Pro','Running','Performance trainer built for tempo runs.',159.99,'Volt|Black','8|9|10|11|12','assets/images/products/product-07.svg',4.5);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Classic High','Casual','Retro high-top profile with padded collar.',94.99,'White|Burgundy','7|8|9|10|11','assets/images/products/product-08.svg',4.6);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Cloud Step','Walking','Comfort-first walking shoe with wide fit.',109.99,'Grey|Lavender','6|7|8|9|10','assets/images/products/product-09.svg',4.7);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Street Edge','Skate','Durable suede skate shoe with flat sole.',84.99,'Black|Tan','7|8|9|10|11','assets/images/products/product-10.svg',4.3);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Eco Loop','Sustainable','Sneaker made with recycled knit materials.',124.99,'Sage|Sand','7|8|9|10|11','assets/images/products/product-11.svg',4.4);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Studio Flex','Training','Stable cross-training shoe for gym sessions.',114.99,'White|Coral','7|8|9|10|11','assets/images/products/product-12.svg',4.5);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Night Runner','Running','Reflective road-running shoe for low light.',134.99,'Black|Silver','8|9|10|11|12','assets/images/products/product-13.svg',4.6);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Harbour Slip','Casual','Easy slip-on with flexible rubber outsole.',74.99,'Navy|Stone','6|7|8|9|10','assets/images/products/product-14.svg',4.7);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Summit Core','Hiking','Water-resistant hiking sneaker for mixed terrain.',154.99,'Forest|Graphite','8|9|10|11|12','assets/images/products/product-15.svg',4.3);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Arc Runner','Running','Balanced cushioning for beginners and commuters.',104.99,'Orange|Blue','7|8|9|10|11','assets/images/products/product-16.svg',4.4);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Court Lite','Tennis','Lateral support and abrasion-resistant outsole.',129.99,'White|Green','7|8|9|10|11','assets/images/products/product-17.svg',4.5);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Retro Wave','Lifestyle','1990s-inspired runner with layered panels.',109.99,'Pink|Grey','6|7|8|9|10','assets/images/products/product-18.svg',4.6);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Flex Junior','Kids','Lightweight kids sneaker with easy fastener.',59.99,'Blue|Purple','1|2|3|4|5','assets/images/products/product-19.svg',4.7);
INSERT INTO products (name,category,description,price,colors,sizes,image,rating) VALUES ('Executive Walk','Formal','Minimal leather sneaker for smart-casual wear.',169.99,'Black|Brown','8|9|10|11|12','assets/images/products/product-20.svg',4.3);


CREATE TABLE IF NOT EXISTS wishlist (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 product_id INT NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY unique_wishlist (user_id, product_id),
 FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS reviews (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 product_id INT NOT NULL,
 rating TINYINT NOT NULL,
 comment VARCHAR(500) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY unique_review (user_id, product_id),
 CONSTRAINT chk_rating CHECK (rating BETWEEN 1 AND 5),
 FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);
