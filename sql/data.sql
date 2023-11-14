
INSERT INTO user(uName, pWord)
VALUES ('grotka01', 'grotka01'),
       ('vuan01',   'vuan01'),
       ('angeda01', 'angeda01'),
       ('boyech01', 'boyech01'), 
       ('llanjo01', 'llanjo01'),
       ('tangyi02', 'tangyi02'),
       ('cummbe01', 'cummbe01'),
       ('gilmow01', 'gilmow01'),
       ('phamph01', 'phamph01'),
       ('admin',    'admin');


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


INSERT INTO meal(mName)
VALUES ('Creamy Chicken & Vegetable Stir-Fry'),
       ('Fruit Yogurt'),
       ('Tofu Vegetable Salad with Creamy Dressing'),
       ('Morning Oatmeal Bowl'),
       ('Grilled Salmon & Vegetable Skewers'),
       ('Beef & Barley Soup'),
       ('Strawberry Banana Smoothie Bowl');


INSERT INTO admin
VALUES (1),
       (2),
       (3),
       (9);


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
       (9, 7),
       (9, 8);


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
VALUES (4, 1, 3),
       (5, 2, 2),
       (5, 3, 4),
       (6, 4, 4),
       (7, 5, 5),
       (8, 6, 3),
       (8, 7, 4);


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
