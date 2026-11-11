SET CLIENT_ENCODING TO 'UTF8';

DROP TABLE IF EXISTS reservation CASCADE;
DROP TABLE IF EXISTS animal CASCADE;
DROP TABLE IF EXISTS adoptant CASCADE;

CREATE TABLE animal (
    idAnimal SERIAL PRIMARY KEY,
    nomAnimal VARCHAR(30),

    espece VARCHAR(20),
    race VARCHAR(40),
    description VARCHAR(500),
    statut VARCHAR(20),

    espece_en VARCHAR(20),
    race_en VARCHAR(40),
    description_en VARCHAR(500),
    statut_en VARCHAR(20),

    dateNaissance DATE,
    sexe CHAR(1),
    dateArrivee DATE,
    photoURL VARCHAR(250)
);


CREATE TABLE adoptant (
    idAdoptant SERIAL PRIMARY KEY,
    nom VARCHAR(30),
    prenom VARCHAR(30),
    email VARCHAR(100),
    telephone VARCHAR(15),
    adresse VARCHAR(150)
);

CREATE TABLE reservation (
    idAnimal INT,
    idAdoptant INT,
    statut VARCHAR(20),
    dateReservation DATE,
    PRIMARY KEY (idAnimal, idAdoptant),
    FOREIGN KEY (idAnimal) REFERENCES animal(idAnimal),
    FOREIGN KEY (idAdoptant) REFERENCES adoptant(idAdoptant)
);

INSERT INTO animal 
(nomanimal, espece, espece_en, race, race_en, dateNaissance, sexe, statut, statut_en, datearrivee, description, description_en, photourl) VALUES
('Cookies', 'Chat', 'Cat', 'Siamois', 'Siamese', '2018-04-01', 'M', 'Disponible', 'Available', '2025-07-26',
 'Cookie est arrivé suite à un abandon pour problème de comportement. Perturbé à son arrivée, il est désormais câlin mais supporte mal la manipulation. Il a besoin d''une maison avec extérieur, sans jeunes enfants.',
 'Cookie was surrendered due to behavioral issues. Disturbed at first, he is now affectionate but dislikes being handled. He needs a house with outdoor access and no young children.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/cookies.jpg'),

('Ilian', 'Équidé', 'Equine', 'Cheval', 'Horse', '2019-12-21', 'M', 'Disponible', 'Available', '2025-04-09',
 'Ilian est un cheval sensible et affectueux. Un géant doux avec de grands besoins, idéal pour un adoptant expérimenté.',
 'Ilian is a sensitive and affectionate horse. A gentle giant with significant needs, ideal for an experienced adopter.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/ilian.jpg'),

('Hakeem', 'Chat', 'Cat', 'Européen', 'European Shorthair', '2010-01-29', 'M', 'Disponible', 'Available', '2024-01-08',
 'Hakeem est calme et câlin mais craintif lors des manipulations. Atteint du FIV, il doit vivre en appartement. Très doux avec les ados, moins avec les petits.',
 'Hakeem is calm and affectionate but fearful when handled. He is FIV-positive and must live indoors. Very gentle with teens, less with young children.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/hakeem.jpg'),

('LK', 'Autres', 'Other', 'Poule', 'Hen', '2024-03-12', 'F', 'Disponible', 'Available', '2025-08-30',
 'LK est une petite poule curieuse et sociable. Elle aime explorer, prendre des bains de poussière et suivre les humains pour une friandise. Parfaite pour un petit groupe de poules dans un environnement sécurisé.',
 'LK is a curious, social little hen. She loves exploring, dust bathing, and following humans for treats. Perfect for a small flock in a secure environment.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/lucas.jpg'),

('Moka', 'Chat', 'Cat', 'Européen', 'European Shorthair', '2022-06-15', 'F', 'Disponible', 'Available', '2025-02-12',
 'Moka est joueuse, bavarde et très câline. Elle conviendra parfaitement à une famille avec enfants.',
 'Moka is playful, talkative, and very affectionate. Perfect for a family with children.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/moka.jpg'),

('Ragnar', 'Chien', 'Dog', 'Berger Belge Malinois', 'Belgian Shepherd Malinois', '2018-11-03', 'M', 'Disponible', 'Available', '2025-01-20',
 'Ragnar est un chien protecteur, intelligent et énergique. Il a besoin d''un grand jardin et d''un maître expérimenté.',
 'Ragnar is protective, intelligent, and energetic. He needs a large yard and an experienced owner.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/ragnar.jpg'),

('Nala', 'Chat', 'Cat', 'Européen', 'European Shorthair', '2023-07-18', 'F', 'Disponible', 'Available', '2025-03-05',
 'Nala est douce, sociable et adore la compagnie. Elle s''entend avec les autres chats.',
 'Nala is gentle, social, and loves company. She gets along well with other cats.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/nala.jpg'),

('Pepper', 'Chien', 'Dog', 'Beagle', 'Beagle', '2021-09-10', 'F', 'Disponible', 'Available', '2025-04-14',
 'Pepper est une petite chienne énergique, gourmande et curieuse. Idéale pour une famille active.',
 'Pepper is energetic, food-loving, and curious. Ideal for an active family.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/pepper.jpg'),

('Atlas', 'Chat', 'Cat', 'Maine Coon', 'Maine Coon', '2019-02-27', 'M', 'Disponible', 'Available', '2025-05-01',
 'Atlas est un grand chat majestueux, calme et très affectueux. Il a besoin d''espace pour être heureux.',
 'Atlas is a large, majestic, calm, and affectionate cat. He needs space to be happy.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/atlas.jpg'),

('Sunny', 'Autres', 'Other', 'Lapin Nain', 'Dwarf Rabbit', '2024-05-08', 'M', 'Disponible', 'Available', '2025-09-02',
 'Sunny est un jeune lapin curieux, propre et habitué à la manipulation douce. Parfait pour débutants.',
 'Sunny is a young, curious rabbit, clean and comfortable with gentle handling. Perfect for beginners.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/sunny.jpg'),

('Ruby', 'Chat', 'Cat', 'Européen', 'European Shorthair', '2014-09-13', 'F', 'Disponible', 'Available', '2024-12-10',
 'Ruby est une mamie tranquille et très câline. Elle cherche un foyer calme où passer sa retraite.',
 'Ruby is a calm, very affectionate senior cat. She is looking for a peaceful home to enjoy her retirement.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/ruby.jpg'),

('Tornado', 'Chien', 'Dog', 'Border Collie', 'Border Collie', '2023-01-14', 'M', 'Disponible', 'Available', '2025-07-01',
 'Tornado est un chien extrêmement intelligent et actif. Il a besoin de stimulations mentales quotidiennes.',
 'Tornado is extremely intelligent and active. He needs daily mental stimulation.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/tornado.jpg'),

('Myrtille', 'Chat', 'Cat', 'Européen', 'European Shorthair', '2024-02-08', 'F', 'Disponible', 'Available', '2025-09-25',
 'Myrtille est pleine d''énergie, adore jouer et s''entend très bien avec les autres chats.',
 'Myrtille is full of energy, loves to play, and gets along very well with other cats.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/myrtille.jpg'),

('Jimmy', 'Chat', 'Cat', 'Européen', 'European Shorthair', '2025-01-30', 'M', 'Disponible', 'Available', '2025-06-01',
 'Jimmy est très affectueux, habitué aux enfants et sociable avec les chiens. Le compagnon parfait.',
 'Jimmy is very affectionate, used to children, and friendly with dogs. The perfect companion.',
 'https://raw.githubusercontent.com/an1tt4/projet_bawe_images/refs/heads/main/jimmy.jpg');










