CREATE DATABASE online_exam;
USE online_exam;

-- users table
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- questions table
CREATE TABLE questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question TEXT NOT NULL,
  option_a VARCHAR(255) NOT NULL,
  option_b VARCHAR(255) NOT NULL,
  option_c VARCHAR(255) NOT NULL,
  option_d VARCHAR(255) NOT NULL,
  correct CHAR(1) NOT NULL COMMENT 'a|b|c|d'
);

-- sample questions
INSERT INTO questions (question, option_a, option_b, option_c, option_d, correct) VALUES
('What is 2 + 2?', '3', '4', '5', '6', 'b'),
('Which language runs in a browser?', 'Python', 'Java', 'C', 'JavaScript', 'd'),
('HTML stands for?', 'Hyper Text Markup Language', 'Home Tool Markup Language', 'Hyperlinks Text Markup', 'None', 'a');
