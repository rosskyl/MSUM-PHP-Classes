USE rosskyl_address_book;

DROP TABLE Individual;
CREATE TABLE Individual (
	ind_id INT UNIQUE NOT NULL PRIMARY KEY AUTO_INCREMENT,
	f_name VARCHAR(30),
	m_name VARCHAR(30),
	l_name VARCHAR(30)
);

DROP TABLE Address;
CREATE TABLE Address (
	address_id INT UNIQUE NOT NULL PRIMARY KEY AUTO_INCREMENT,
	line_1 VARCHAR(30),
	line_2 VARCHAR(30),
	city VARCHAR(30),
	state_cd CHAR(2),
	zip_cd CHAR(5)
);

DROP TABLE AddressConnection;
CREATE TABLE AddressConnection (
	connection_id INT UNIQUE NOT NULL PRIMARY KEY AUTO_INCREMENT,
	ind_id INT,
	address_id INT
);
