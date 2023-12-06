
INSERT INTO user(uName, pWord)
VALUES ('grotka01', '6996b90f5fbbd2be6601457e09902b85'),
       ('vuan01',   'eed673384a3afc779875bea953a33309'),
       ('angeda01', 'ff809ccfd3309105d5fe583af1fb7e9b'),
       ('boyech01', '83dc3af5572fe6de8cc82e8cd4946d30'), 
       ('llanjo01', '3539acf0f4649aa813218dd9a144dd26'),
       ('tangyi02', '6c3a007ee9aaf1a444c7729dddbb7c44'),
       ('cummbe01', '2c17520bd04bbc9ca33601a3e5e281f3'),
       ('gilmow01', '0d282728db98eb2a28bea76f7dc20734'),
       ('phamph01', '68df807c29ea712e609445b23d5608e7'),
       ('admin',    '21232f297a57a5a743894a0e4a801fc3');


INSERT INTO ingredient(iName, type)
VALUES ('Milk', 'Dairy'),
       ('Butter', 'Dairy'),
       ('Chedder Cheese', 'Dairy'),
       ('Greek Yogurt', 'Dairy'),
       ('Cream', 'Dairy'),
       ('Apple', 'Fruit'),
       ('Banana', 'Fruit'),
       ('Orange', 'Fruit'),
       ('Strawberry', 'Fruit'),
       ('Mango', 'Fruit'),
       ('Chicken Breast', 'Protein'),
       ('Salmon', 'Protein'),
       ('Beef', 'Protein'),
       ('Tofu', 'Protein'),
       ('Eggs', 'Protein'),
       ('Broccoli', 'Vegetables'),
       ('Spinach', 'Vegetables'),
       ('Carrot', 'Vegetables'),
       ('Bell Peppers', 'Vegetables'),
       ('Cucumber', 'Vegetables'),
       ('Rice', 'Grain'),
       ('Wheat', 'Grain'),
       ('Oat', 'Grain'),
       ('Corn', 'Grain'),
       ('Barley', 'Grain');


INSERT INTO meal(mName, image, uid)
VALUES ('Creamy Chicken & Vegetable Stir-Fry', './jpg/Creamy Chicken.jpg', 4),
       ('Fruit Yogurt', './jpg/Fruit Yogurt.jpg', 4),
       ('Tofu Vegetable Salad with Creamy Dressing', './jpg/Tofu Vegetable.jpg', 4),
       ('Morning Oatmeal Bowl', './jpg/Outmeal.jpg', 5),
       ('Grilled Salmon & Vegetable Skewers', './jpg/Grilled Salmon.jpg', 6),
       ('Beef & Barley Soup', './jpg/Beef Barley.jpg', 7),
       ('Strawberry Banana Smoothie Bowl', './jpg/Strawberry Banana.jpg', 8);


INSERT INTO click(mid, cdate)
VALUES (1, DATE '2023-12-05'),
       (1, DATE '2023-12-05'),
       (1, DATE '2023-12-05'),
       (1, DATE '2023-12-05'),
       (1, DATE '2023-12-05'),
       (2, DATE '2023-12-05'),
       (2, DATE '2023-12-05'),
       (2, DATE '2023-12-05'),
       (2, DATE '2023-12-05'),
       (2, DATE '2023-12-05'),
       (3, DATE '2023-12-05'),
       (3, DATE '2023-12-05'),
       (3, DATE '2023-12-05'),
       (3, DATE '2023-12-05'),
       (3, DATE '2023-12-05'),
       (4, DATE '2023-12-05'),
       (4, DATE '2023-12-05'),
       (4, DATE '2023-12-05');


INSERT INTO admin
VALUES (1),
       (2),
       (3),
       (10);


INSERT INTO end
VALUES (4),
       (5),
       (6),
       (7),
       (8);


INSERT INTO manages
VALUES (9, 1),
       (9, 2),
       (9, 3),
       (1, 4),
       (2, 5),
       (3, 6),
       (10, 7),
       (10, 8);


INSERT INTO possess
VALUES (4, 1),
       (4, 7),
       (5, 9),
       (6, 14),
       (6, 17),
       (7, 20),
       (7, 23),
       (8, 12),
       (8, 8);


INSERT INTO meal_uses
VALUES (1, 11),
       (1, 16),
       (1, 19),
       (1, 18),
       (1, 21),
       (1, 5),

       (2, 6),
       (2, 7),
       (2, 9),
       (2, 4),
       (2, 23),

       (3, 14),
       (3, 17),
       (3, 20),
       (3, 19),
       (3, 4),
       (3, 1),

       (4, 23),
       (4, 1),
       (4, 10),
       (4, 7),
       (4, 4),
       (4, 15),

       (5, 12),
       (5, 19),
       (5, 16),
       (5, 22),
       (5, 2),
       (5, 8),

       (6, 13),
       (6, 18),
       (6, 17),
       (6, 25),
       (6, 5),

       (7, 9),
       (7, 7),
       (7, 1),
       (7, 4),
       (7, 15),
       (7, 23);


INSERT INTO review
VALUES (4, 1, 3, 'This meal is mid as best.'),
       (5, 2, 2, "I don't know who can ingest this kind of food."),
       (5, 3, 4, 'Pretty nice, would recommend.'),
       (6, 4, 4, 'This is nice.'),
       (7, 5, 5, 'This is one of the best thing I have cooked. Would do this again 5000 times.'),
       (8, 6, 3, 'No review, it is meh'),
       (8, 7, 4, 'Pretty good actually');


INSERT INTO recipe_step
VALUES (1, 1, 'Cut chicken breast into bite-sized pieces and season to taste.'),
       (1, 2, 'Stir-fry chicken in a pan until golden and set aside.'),
       (1, 3, 'In the same pan, add broccoli, sliced bell peppers, and sliced carrots; stir-fry until tender-crisp.'),
       (1, 4, 'Pur cream into the pan, bring to a gentle simmer, and return chicken to the pan. Serve the creamy chicken and vegetable mixgture over cooked rice.'),

       (2, 1, 'Dice apple, slice banana, and cut strawberries.'),
       (2, 2, 'In a glass or bowl, layer Greek yogurt with the fruits.'),
       (2, 3, 'Repeat the layers until the glass is filled.'),
       (2, 4, 'Top with oats and an optional drizzle of honey or a sprinkle of cinnamon.'),
       
       (3, 1, 'Press and cut tofu into cubes, lightly fry or bake until golden.'),
       (3, 2, 'Combine spinach leaves, sliced cucumber, and bell peppers in a salad bowl.'),
       (3, 3, 'For the dressing, mix Greek yogurt with a bit of milk until creamy, season to taste.'),
       (3, 4, 'Toss the salad with the creamy dressing and top with tofu cubes.'),
       
       (4, 1, 'Cook oats in milk according to package instructions.'),
       (4, 2, 'Slice mango and banana.'),
       (4, 3, 'Place cooked oatmeal in a bowl and arrange fruit slices on top.'),
       (4, 4, 'Add a dollop of Greek yogurt and sprinkle with chopped boiled egg.'),

       (5, 1, 'Cut salmon, bell peppers, and broccoli into chunks suitable for skewers.'),
       (5, 2, 'Thread them onto skewers and season as desired.'),
       (5, 3, 'Grill skewers until salmon is cooked through and vegetables are tender.'),
       (5, 4, 'Serve with buttered wheat bread and fresh orange slices on the side.'),

       (6, 1, 'Brown beef chunks in a pot, then remove and set aside.'),
       (6, 2, 'In the same pot, add chopped carrots and cook for a few minutes.'),
       (6, 3, 'Return beef to the pot, add barley and enough water or broth to cover, and bring to a boil.'),
       (6, 4, 'Reduce heat, cover, and simmer until barley is tender.'),
       (6, 5, 'Stir in spinach and cream, and heat through before serving.'),

       (7, 1, 'Blend strawberries and banana with milk until smooth.'),
       (7, 2, 'Pour the smoothie into a bowl.'),
       (7, 3, 'Top with a dollop of Greek yogurt, sliced boiled egg, and a sprinkle of oats for texture.');
