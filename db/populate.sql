-- Users --
INSERT INTO "user" (id,firstName,lastName,email,username,password,location,about,registeredOn) VALUES
(1,'Roth','Hampton','tempor.augue.ac@sitametmetus.edu','roth_hampton','PXA24YEP6CV','Porto','I LOVE CARS and so I decided to build this website so I can share it with everyone else.','2021-03-30 12:38:24'),
(2,'Bree','Espinoza','auctor.velit.eget@mollis.ca','bree_espinoza','ZED49VDV4VT','Muradiye','I love BMWs and I cant help myself when it comes to buying them. My girlfriend doesnt really approve of that so I need to sell some of them','2021-03-30 12:38:24'),
(3,'Tanek','Spence','Fusce.dolor@nisi.com','tanek_spence','DTQ16ULU3HP','Barry','Ive been in love with cars ever since I was a 4 year old and now I want to make a living out of it.','2021-03-30 12:38:24'),
(4,'Fitzgerald','Cash','dolor.dapibus.gravida@sedduiFusce.edu','cash_fitz','UAU42EDT3XL','Perchtoldsdorf','Cars, cars, cars, You gotta love them.','2021-03-30 12:38:24'),
(5,'Aimee','Cortez','nibh@dictum.co.uk','aimee_cortez','XXX07JUG7BH','Sargodha','Life without cars is like Rome without the Pope.','2021-03-30 12:38:24'),
(6,'Barclay','Sargent','aliquet.Proin@Praesent.com','barclay','KDI43MJE4FP','Maunath Bhanjan','Just chilling and buying cars.','2021-03-30 12:38:24'),
(7,'Fuller','Beck','mi.felis@pedeacurna.com','fuller_beck','NAQ18MSW3TI','Pekanbaru','Just trying to have some fun :)','2021-03-30 12:38:24'),
(8,'Ulysses','Bennett','dictum@Donectempor.com','ulysses_bennte','CQW48UUT5TJ','Aylmer','Impulsive car buyer.','2021-03-30 12:38:24'),
(9,'Ian','Walsh','nulla@Curabitursed.ca','ian_walsh','LQG38WSJ6NO','Borgomasino','Im a Bad Ass.','2021-03-30 12:38:24'),
(10,'Valentine','Boyer','elit.pharetra.ut@aliquetsem.com','valentine_boyer','RIX27PKB7IJ','Sakhalin','Hello! Just loving cars.','2021-03-30 12:38:24'),
(11,'Ulysses','Hayes','mauris@metusInnec.co.uk','ulysses_hayes','PPY94UIU8YF','Scala Coeli','Fast and Furious lover. JUst trying to bring things from the screen to real life.','2021-03-30 12:38:24'),
(12,'Moses','Stanton','dui.nec.urna@dictumcursus.edu','moses_stanton','NPR54ONU1NS','Tallahassee','Im boreeeeeeeeeeeeeeeeeeeeeeeeeeeeeeed','2021-03-30 12:38:24'),
(13,'Silas','Olsen','faucibus.ut.nulla@fermentummetus.net','silas_olsen','MCH94KSM4NQ','Pishin Valley','what am i doing with my life?','2021-03-30 12:38:24'),
(14,'Abra','Carson','tempor@pede.co.uk','abra_carson','EWV73ABO7RD','Belogorsk','Fast and furious is the best and you cant change my mind','2021-03-30 12:38:24'),
(15,'Montana','Poole','convallis@diamSed.com','montana','EXV51KVN4UG','Saint-Nazaire','just trying to find a nice car for my family','2021-03-30 12:38:24'),
(16,'Melvin','Burch','Nulla.tincidunt@nonnisiAenean.org','melvin_b','KJV18FNQ2TA','Bostaniçi','hey everyone. Im new to the car passion thing but i really want to get into business.','2021-03-30 12:38:24'),
(17,'Jared','Head','mauris.a.nunc@eu.ca','NBU44UNP0BB','head_jared','Provost','life is boring but cars are not','2021-03-30 12:38:24'),
(18,'Yvonne','Odonnell','condimentum@velvulputate.edu','odonnel_y','WYQ13QQL6SR','Saint-Médard-en-Jalles','Renaults are the best cars in the world.','2021-03-30 12:38:24'),
(19,'Palmer','Maldonado','Aliquam.tincidunt@orci.com','paler_mal','HTJ05GKL1QF','East Linton','Hey hey hey hey hey hey!','2021-03-30 12:38:24'),
(20,'Geraldine','Farrell','tempor.arcu.Vestibulum@Naminterdumenim.co.uk','geraldine','RTV38CTE4GF','Surat','wanna see me playing with cars while wearing nothing? come to this link: geraldine.naked.com','2021-03-30 12:38:24');

-- Seller Permissions --
INSERT INTO "seller" (id) VALUES (2),(3),(4),(7);

-- Vehicles --
INSERT INTO "vehicle" (id,owner,brand,model,condition,manufactureYear,horsepower) VALUES
(1,2,'BMW','1 Series','Mint',2008,150),
(2,2,'BMW','3 Series','Mint',2010,200),
(3,2,'BMW','5 Series','Mint',2009,220),
(4,2,'BMW','7 Series','Mint',2012,250),
(5,2,'Mercedes','Class A','Clean',2015,180),
(6,2,'Mercedes','Class C','Average',2015,240),
(7,3,'Rolls Royce','Ghost','Mint',2016,320),
(8,3,'Rolls Royce','Ghost','Clean',2012,320),
(9,3,'Rolls Royce','Dawn','Average',2016,300),
(10,3,'Rolls Royce','Phantom','Rough',2003,380),
(11,3,'Rolls Royce','Ghost','Clean',2014,320),
(12,3,'Rolls Royce','Ghost','Clean',2014,320),
(13,3,'Rolls Royce','Dawn','Mint',2018,400),
(14,3,'Rolls Royce','Phantom','Average',2010,380),
(15,4,'Ferrari','Spider','Average',2016,6800),
(16,4,'Ford','Mustang','Rough',2008,550),
(17,4,'Jaguar','XE','Clean',2019,450),
(18,4,'Lamborguini','Aventador S','Clean',2020,740),
(19,4,'Porsche','Panamera 4 Executive','Mint',2020,450),
(20,4,'Tesla','S','Mint',2021,700);

-- Auctions --
INSERT INTO "auction" (id,auction_name,vehicle,startingBid,creationTime,startingTime,endingTime,auctionType) VALUES
(1,'BMW 1 Series 2008 Good State',1,8000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(2,'BMW 3 Series 2010 Mint',2,10000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(3,'BMW 5 Series Exclusive',3,15000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(4,'BMW 7 Series Great for Sports People',4,20000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(5,'Mercedes A Clean',5,10000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Private'),
(6,'Mercedes C Average',6,10000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Private'),
(7,'Awesome Rolls Royce Ghost 16',7,30000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(8,'Clean RR Ghost 12',8,25000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(9,'RR Dawn 16 Perfect for Families',9,25000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(10,'Old but never out of Style RR Phantom 03',10,20000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(11,'Clean RR Ghost 14',11,43000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(12,'Fantastic RR Ghost 14',12,48000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-05 12:00:00','Public'),
(13,'Mint RR Dawn 18',13,60000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-08 12:00:00','Public'),
(14,'10s Phantom for the fearless',14,35000,'2021-03-30 12:59:24','2021-04-03 12:00:00','2021-04-08 12:00:00','Public'),
(15,'Exclusive Ferrari Spider',15,180000,'2021-03-30 12:59:24','2021-04-04 12:00:00','2021-04-08 12:00:00','Public'),
(16,'CR7 Old Mustang',16,400000,'2021-03-30 12:59:24','2021-04-04 12:00:00','2021-04-08 12:00:00','Public'),
(17,'Roar with your new Jaguar XE',17,240000,'2021-03-30 12:59:24','2021-04-04 12:00:00','2021-04-08 12:00:00','Public'),
(18,'Luxury Aventador S',18,390000,'2021-03-30 12:59:24','2021-04-05 12:00:00','2021-04-08 12:00:00','Public'),
(19,'New Panamera 4 Executive',19,160000,'2021-03-30 12:59:24','2021-04-05 12:00:00','2021-04-08 12:00:00','Public'),
(20,'Brand New Tesla S',20,230000,'2021-03-30 12:59:24','2021-04-05 12:00:00','2021-04-08 12:00:00','Public');

-- User Permissions --
INSERT INTO "global_mod" (id) VALUES (2),(5);
INSERT INTO "auction_mod" (user_id,auction_id) VALUES (3,7),(3,8),(3,9),(3,10),(3,11),(3,12),(3,13),(3,14);
INSERT INTO "auction_mod" (user_id,auction_id) VALUES (4,15),(4,16),(4,17),(4,18),(4,19),(4,20);
INSERT INTO "auction_mod" (user_id,auction_id) VALUES (6,15),(6,16),(6,17);
INSERT INTO "admin" (id) VALUES (1);

-- Profile Photos --
INSERT INTO "image" (id,path) VALUES
(1, 'profile_photos/1.png'),
(2, 'profile_photos/1.png'),
(3, 'profile_photos/1.png'),
(4, 'profile_photos/1.png'),
(5, 'profile_photos/1.png'),
(6, 'profile_photos/1.png'),
(7, 'profile_photos/1.png'),
(8, 'profile_photos/1.png'),
(9, 'profile_photos/1.png'),
(10, 'profile_photos/1.png'),
(11, 'profile_photos/1.png'),
(12, 'profile_photos/1.png'),
(13, 'profile_photos/1.png'),
(14, 'profile_photos/1.png'),
(15, 'profile_photos/1.png'),
(16, 'profile_photos/1.png'),
(17, 'profile_photos/1.png'),
(18, 'profile_photos/1.png'),
(19, 'profile_photos/1.png'),
(20, 'profile_photos/1.png');

INSERT INTO "profile_image" (user_id,image) VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10),(11,11),(12,12),(13,13),(14,14),(15,15),(16,16),(17,17),(18,18),(19,19),(20,20);

-- Car Photos --
INSERT INTO "image" (id,path) VALUES
(21, 'car_photos/1/1.png'), (22, 'car_photos/1/2.png'), (23, 'car_photos/1/3.png'),
(24, 'car_photos/2/1.png'), (25, 'car_photos/2/2.png'),
(26, 'car_photos/3/1.png'),
(27, 'car_photos/4/1.png'), (28, 'car_photos/4/2.png'),
(29, 'car_photos/5/1.png'),
(30, 'car_photos/6/1.png'),
(31, 'car_photos/7/1.png'),
(32, 'car_photos/8/1.png'),
(33, 'car_photos/9/1.png'),
(34, 'car_photos/10/1.png'),
(35, 'car_photos/11/1.png'),
(36, 'car_photos/12/1.png'),
(37, 'car_photos/13/1.png'),
(38, 'car_photos/14/1.png'),
(39, 'car_photos/15/1.png'),
(40, 'car_photos/16/1.png'),
(41, 'car_photos/17/1.png'),
(42, 'car_photos/18/1.png'),
(43, 'car_photos/19/1.png'),
(44, 'car_photos/20/1.png');

INSERT INTO "vehicle_image" (vehicle,image,sequence_number) VALUES
(1,21,1), (1,22,2), (1,23,3),
(2,24,1),(2,25,2),
(3,26,1),
(4,27,1),(4,28,2),
(5,29,1),
(6,30,1),
(7,31,1),
(8,32,1),
(9,33,1),
(10,34,1),
(11,35,1),
(12,36,1),
(13,37,1),
(14,38,1),
(15,39,1),
(16,40,1),
(17,41,1),
(18,42,1),
(19,43,1),
(20,44,1);

-- Public Auction Guests --
INSERT INTO "auction_guest" (user_id, auction_id) VALUES
(8,5),(9,5),(10,5),(11,5),(12,5),(13,5),
(11,6),(12,6),(13,6),(14,6),(15,6);

-- Favourite Auctions --
INSERT INTO "favourite_auction" (user_id, auction_id) VALUES
(8,1),(8,2),(8,3),(8,4),(8,5),
(9,5),(9,6),(9,7),(9,8),(9,9),
(10,8),(10,9),
(11,6),(11,5),
(12,6),(12,11),(12,19),(12,17),
(13,15),(13,16);

-- Auction Comments --
INSERT INTO "auction_comment" (id,user_id,auction_id,createdOn,content) VALUES
(1,8,1,'2021-03-31 15:27:38','Cant wait to get my hands on this car!'),
(2,9,1,'2021-03-31 17:54:38','Lovely Car! Hope I can get it!'),
(3,10,1,'2021-03-31 19:03:38','I love this BMW. It will be the perfect gift for my daughter.'),
(4,8,2,'2021-03-31 15:27:38','Cant wait to get my hands on this car!'),
(5,8,3,'2021-03-31 15:27:38','Cant wait to get my hands on this car!'),
(6,8,4,'2021-03-31 15:27:38','Cant wait to get my hands on this car!'),
(7,8,5,'2021-03-31 15:27:38','Cant wait to get my hands on this car!'),
(8,8,7,'2021-03-31 15:27:38','Cant wait to get my hands on this car!'),
(9,11,6,'2021-03-31 15:27:38','Thank you for inviting me for this auction. I really want this car!'),
(10,13,6,'2021-03-31 13:27:38','Really looking forward for this auction'),
(11,12,6,'2021-03-31 18:27:38','Great Car and great seller. Cant wait for this awesome auction.');

-- Banned Users --
INSERT INTO "ban" (id,user_id,createdBy,createdOn,startTime,endTime,reason,banType) VALUES
(1, 20, 1, '2021-03-31 15:27:38', '2021-03-31 15:27:38','2050-03-31 15:27:38', 'Is a bot.','AllBan'),
(2, 19, 1, '2021-03-31 15:27:38', '2021-03-31 15:27:38','2050-03-31 15:27:38', 'I dont trust him.','BuyerBan'),
(3, 18, 1, '2021-03-31 15:27:38', '2021-03-31 15:27:38','2050-03-31 15:27:38', 'I dont want him selling his cars in my website','SellerBan');
INSERT INTO "ban" (id,user_id,createdBy,createdOn,startTime,endTime,reason,banType,auction_id) VALUES
(4, 8, 3, '2021-03-31 15:27:38', '2021-03-31 15:27:38','2050-03-31 15:27:38', 'I dont trust him for this auction','AuctionBan',14);

-- Bids --
INSERT INTO "bidding" (id,user_id,auction_id,amount,createdOn) VALUES
(1,5,1,8000,'2021-04-01 17:06:32'),
(2,6,1,8300,'2021-04-01 17:20:32'),
(3,7,1,8500,'2021-04-01 17:45:32'),
(4,5,1,8800,'2021-04-01 17:56:32'),
(5,6,2,10000,'2021-04-01 17:06:32'),
(6,8,2,10500,'2021-04-01 17:20:32'),
(7,6,2,11000,'2021-04-01 17:45:32'),
(8,8,3,15000,'2021-04-01 17:56:32'),
(9,5,4,20000,'2021-04-01 17:06:32'),
(10,7,4,21000,'2021-04-01 17:20:32'),
(11,12,5,10000,'2021-04-01 17:45:32'),
(12,15,6,10000,'2021-04-01 17:56:32'),
(13,11,7,30000,'2021-04-01 17:20:32'),
(14,12,8,25000,'2021-04-01 17:45:32'),
(15,13,9,25000,'2021-04-01 17:56:32');