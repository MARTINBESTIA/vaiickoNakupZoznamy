INSERT INTO users (username, password) VALUES
                                           ('martin', '$2y$12$BsUh7/ZUhm6jE1iioAKTqOAAB2amk8Za85J3KlTfjDx/ux054UaWC'),
                                           ('admin', '$2y$12$CubX5Ua3T4/qeUSy4wbdmO.tF.00FScEMIEuB29cPmnSDkw84IJ8K'),
                                           ('jana', '$2y$12$sNN6xu76nrZLwwMyC1E4u.WSfJp2xRi3Weq1ObR9frGy6lIGHeoTK'),
                                           ('peter', '$2y$12$cE5YDHNkA8X/o6bcpDHViecfst5PSztAeXd9PXeKFoEab1johOFtK'),
                                           ('lucia', '$2y$12$nF2ldRGamuXSPEQWje4SzOjQsH9/y67VG3a1kkZtHFtnOzLZM.Kv6');

INSERT INTO zoznam (name, creator_id) VALUES
                                          ('Nákupný zoznam LIDL', 1),
                                          ('Nákupný zoznam TESCO', 1),
                                          ('Nákupný zoznam BILLA', 3),
                                          ('Nákupný zoznam KAUFLAND', 4),
                                          ('Nákupný zoznam COOP Jednota', 5);

INSERT INTO groups (name, creator_id) VALUES
                                          ('Rodina', 1),
                                          ('Priatelia', 3),
                                          ('Spolužiaci', 4),
                                          ('Kolegovia', 5),
                                          ('Neznámi', 1);

INSERT INTO user_in_group (user_id, group_id) VALUES
                                                  (1, 1),
                                                  (1, 5),
                                                  (2, 1),
                                                  (3, 2),
                                                  (4, 3),
                                                  (5, 4),
                                                  (5, 2);

INSERT INTO zoznam_in_group (zoznam_id, group_id) VALUES
                                                      (1, 1),
                                                      (2, 1),
                                                      (2, 5),
                                                      (3, 2),
                                                      (4, 3),
                                                      (5, 4),
                                                      (5, 2);