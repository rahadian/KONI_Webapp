-- Check if the user already exists and drop it if it does
DROP USER IF EXISTS 'k0n1admin'@'%';

-- Create the user
CREATE USER 'k0n1admin'@'%' IDENTIFIED BY 'k0n11337';

-- Grant all privileges to the user
GRANT ALL PRIVILEGES ON *.* TO 'k0n1admin'@'%' WITH GRANT OPTION;

-- Reload the privilege tables
FLUSH PRIVILEGES;