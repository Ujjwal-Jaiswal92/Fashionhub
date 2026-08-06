-- Run once in phpMyAdmin to let existing customer accounts log in immediately.
-- Seller accounts remain Pending until an administrator approves them.
UPDATE users
SET status = 'Approved'
WHERE role = 'customer' AND status = 'Pending';
