UPDATE company
SET user_id = 35 
WHERE email = (SELECT email FROM users WHERE user_id = 35);
