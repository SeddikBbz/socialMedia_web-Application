/*data base name :projectssd.*/
tables:
*user:
CREATE TABLE users (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    fullName VARCHAR(255),
    birthdate DATE,
    location VARCHAR(255),
    bio TEXT
);
**post:
CREATE TABLE posts (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL, 
content TEXT NOT NULL, 
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (user_id) REFERENCES users(userId) );
***comment:
CREATE TABLE comments (
    commentId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    postId INT,
    content TEXT,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (postId) REFERENCES posts(id)
);
****like:
CREATE TABLE likes (
    likeId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    postId INT,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (postId) REFERENCES posts(id)
);

