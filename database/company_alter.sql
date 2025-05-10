ALTER TABLE company
ADD COLUMN user_id INT AFTER company_id,
ADD FOREIGN KEY (user_id) REFERENCES users(user_id);
