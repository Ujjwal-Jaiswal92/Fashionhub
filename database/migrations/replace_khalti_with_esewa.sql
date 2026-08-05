-- Run once in phpMyAdmin after replacing Khalti with eSewa.
-- Any old sandbox Khalti rows are relabelled eSewa so MySQL can change the ENUM.
UPDATE orders SET payment_method = 'eSewa' WHERE payment_method = 'Khalti';
UPDATE payments SET payment_method = 'eSewa' WHERE payment_method = 'Khalti';

ALTER TABLE orders
    MODIFY payment_method ENUM('Cash on Delivery','eSewa') NOT NULL;

ALTER TABLE payments
    MODIFY payment_method ENUM('Cash on Delivery','eSewa') NOT NULL;
