DROP TABLE Question;
-- the question being asked
CREATE TABLE Question (
	question_id INT UNIQUE NOT NULL PRIMARY KEY AUTO_INCREMENT,
	text VARCHAR(255)
);
INSERT INTO Question (text) VALUES ("Does it bark?");

DROP TABLE Solution;
-- the solution to the game
CREATE TABLE Solution (
	solution_id INT UNIQUE NOT NULL PRIMARY KEY AUTO_INCREMENT,
	text VARCHAR(255)
);
INSERT INTO Solution (text) VALUES ("cat"), ("dog");

DROP TABLE QuestionConnection;
-- connecting each question to the next
-- do it this way to reuse questions
-- connection_id should be all 0 and 1
-- 0 represents no and 1 represents yes
CREATE TABLE QuestionConnection (
	connection_id VARCHAR(200) UNIQUE NOT NULL PRIMARY KEY,
	parent_id INT,
	object_id INT,
	object_type VARCHAR(20)
);
INSERT INTO QuestionConnection VALUES 
	("-1", NULL, 1, "Question"),
	("0", 1, 1, "Solution"),
	("1", 1, 2, "Solution");
