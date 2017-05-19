USE rosskyl_address_book;

INSERT INTO Individual (f_name, m_name, l_name)
VALUES
("Kyle", "J", "Ross"),
("John", NULL, "Doe"),
("Jane", NULL, "Doe"),
("Candis", NULL, "Ross"),
("Marvin", NULL, "Ross"),
("Brandon", NULL, "Ross"),
("Marbles", NULL, "Ross"),
("Mocha", NULL, "Ross"),
("Barb", NULL, "Wire"),
("Fred", NULL, "Bed");

INSERT INTO Address (line_1, line_2, city, state_cd, zip_cd)
VALUES
("5081 Martin Drive", NULL, "Monticello", "MN", "55362"),
("1618 33rd Ave S", "APT 201", "Fargo", "ND", "58104"),
("111 Drive St", NULL, "Fake", "NO", "00000"),
("123 Fako St", NULL, "WhyNot", "XY", "12345"),
("856309 Jenny St", NULL, "Wherever", "SS", "12341");

INSERT INTO AddressConnection (ind_id, address_id)
VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 3),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 4),
(10, 5);
