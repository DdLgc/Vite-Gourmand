-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
--       Vite & Gourmand
-- /////////////////////////////
-- -----------
-- Users
-- -----------
CREATE TABLE app_user (
    id BIGSERIAL PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(180) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    postal_address VARCHAR(255) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,
    city VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    roles JSON NOT NULL,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- ---------
-- Menus
-- ---------
CREATE TABLE menu (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    conditions TEXT NOT NULL,
    minimum_people INTEGER NOT NULL,
    base_price_cents INTEGER NOT NULL,
    available_stock INTEGER NOT NULL DEFAULT 0,
    theme VARCHAR(50) NOT NULL,
    diet VARCHAR(50) NOT NULL,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_menu_minimum_people CHECK (minimum_people > 0),
    CONSTRAINT chk_menu_base_price CHECK (base_price_cents >= 0),
    CONSTRAINT chk_menu_available_stock CHECK (available_stock >= 0)
);

-- ----------------
-- Customer orders
-- ----------------
CREATE TABLE customer_order (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL,
    menu_id BIGINT NOT NULL,
    people_count INTEGER NOT NULL,
    delivery_address VARCHAR(255) NOT NULL,
    delivery_postal_code VARCHAR(10) NOT NULL,
    delivery_city VARCHAR(100) NOT NULL,
    delivery_date DATE NOT NULL,
    delivery_time TIME NOT NULL,
    menu_amount_cents INTEGER NOT NULL,
    discount_amount_cents INTEGER NOT NULL DEFAULT 0,
    delivery_amount_cents INTEGER NOT NULL DEFAULT 0,
    total_amount_cents INTEGER NOT NULL,
    status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_customer_order_user FOREIGN KEY (user_id) REFERENCES app_user(id),
    CONSTRAINT fk_customer_order_menu FOREIGN KEY (menu_id) REFERENCES menu(id),
    CONSTRAINT chk_customer_order_people CHECK (people_count > 0),
    CONSTRAINT chk_customer_order_menu_amount CHECK (menu_amount_cents >= 0),
    CONSTRAINT chk_customer_order_discount CHECK (discount_amount_cents >= 0),
    CONSTRAINT chk_customer_order_delivery_amount CHECK (delivery_amount_cents >= 0),
    CONSTRAINT chk_customer_order_total CHECK (total_amount_cents >= 0)
);

-- ------------
-- Menu images
-- ------------
CREATE TABLE menu_image (
    id BIGSERIAL PRIMARY KEY,
    menu_id BIGINT NOT NULL,
    path VARCHAR(255) NOT NULL,
    alt_text VARCHAR(255) NOT NULL,
    position INTEGER NOT NULL DEFAULT 0,
    CONSTRAINT fk_menu_image_menu FOREIGN KEY (menu_id) REFERENCES menu(id) ON DELETE CASCADE,
    CONSTRAINT chk_menu_image_position CHECK (position >= 0)
);

-- -------
-- Dishes
-- -------
CREATE TABLE dish (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    course_type VARCHAR(50) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- ------------------------
-- Menu / Dish association
-- ------------------------
CREATE TABLE menu_dish (
    menu_id BIGINT NOT NULL,
    dish_id BIGINT NOT NULL,
    PRIMARY KEY (menu_id, dish_id),
    CONSTRAINT fk_menu_dish_menu FOREIGN KEY (menu_id) REFERENCES menu(id) ON DELETE CASCADE,
    CONSTRAINT fk_menu_dish_dish FOREIGN KEY (dish_id) REFERENCES dish(id) ON DELETE CASCADE
);

-- ---------
-- Allergens
-- ---------
CREATE TABLE allergen (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- ----------------------------
-- Dish / Allergen association
-- ----------------------------
CREATE TABLE dish_allergen (
    dish_id BIGINT NOT NULL,
    allergen_id BIGINT NOT NULL,
    PRIMARY KEY (dish_id, allergen_id),
    CONSTRAINT fk_dish_allergen_dish FOREIGN KEY (dish_id) REFERENCES dish(id) ON DELETE CASCADE,
    CONSTRAINT fk_dish_allergen_allergen FOREIGN KEY (allergen_id) REFERENCES allergen(id) ON DELETE CASCADE
);

-- ---------------------
-- Order status history
-- ---------------------
CREATE TABLE order_status_history (
    id BIGSERIAL PRIMARY KEY,
    order_id BIGINT NOT NULL,
    changed_by_id BIGINT NOT NULL,
    status VARCHAR(50) NOT NULL,
    changed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_order_status_history_order FOREIGN KEY (order_id) REFERENCES customer_order(id) ON DELETE CASCADE,
    CONSTRAINT fk_order_status_history_user FOREIGN KEY (changed_by_id) REFERENCES app_user(id)
);

-- ------------------
-- Order contact logs
-- ------------------
CREATE TABLE order_contact_log (
    id BIGSERIAL PRIMARY KEY,
    order_id BIGINT NOT NULL,
    employee_id BIGINT NOT NULL,
    contact_method VARCHAR(50) NOT NULL,
    reason TEXT NOT NULL,
    contacted_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_order_contact_log_order FOREIGN KEY (order_id) REFERENCES customer_order(id) ON DELETE CASCADE,
    CONSTRAINT fk_order_contact_log_employee FOREIGN KEY (employee_id) REFERENCES app_user(id)
);

-- -------
-- Reviews
-- -------
CREATE TABLE review (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL,
    order_id BIGINT NOT NULL UNIQUE,
    rating INTEGER NOT NULL,
    comment TEXT NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    validated_at TIMESTAMP,
    CONSTRAINT fk_review_user FOREIGN KEY (user_id) REFERENCES app_user(id),
    CONSTRAINT fk_review_order FOREIGN KEY (order_id) REFERENCES customer_order(id) ON DELETE CASCADE,
    CONSTRAINT chk_review_rating CHECK (
        rating BETWEEN 1
        AND 5
    )
);

-- --------------
-- Opening hours
-- --------------
CREATE TABLE opening_hour (
    id BIGSERIAL PRIMARY KEY,
    day_of_week SMALLINT NOT NULL UNIQUE,
    morning_open TIME,
    morning_close TIME,
    afternoon_open TIME,
    afternoon_close TIME,
    is_closed BOOLEAN NOT NULL DEFAULT FALSE,
    CONSTRAINT chk_opening_hour_day CHECK (
        day_of_week BETWEEN 1
        AND 7
    ),
    CONSTRAINT chk_opening_hour_morning CHECK (
        morning_open IS NULL
        OR morning_close IS NULL
        OR morning_open < morning_close
    ),
    CONSTRAINT chk_opening_hour_afternoon CHECK (
        afternoon_open IS NULL
        OR afternoon_close IS NULL
        OR afternoon_open < afternoon_close
    )
);