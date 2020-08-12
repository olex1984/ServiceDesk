-- MySQL dump 10.17  Distrib 10.3.23-MariaDB, for debian-linux-gnueabihf (armv7l)
--
-- Host: localhost    Database: servicedesk
-- ------------------------------------------------------
-- Server version	10.3.23-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin','7060e0ec6bdf91164e245cab3469509e');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_department`
--

DROP TABLE IF EXISTS `service_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_department`
--

LOCK TABLES `service_department` WRITE;
/*!40000 ALTER TABLE `service_department` DISABLE KEYS */;
INSERT INTO `service_department` VALUES (6,14),(7,77),(8,125),(9,176),(10,188),(11,197),(12,215);
/*!40000 ALTER TABLE `service_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `creator` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `control` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `category` varchar(255) NOT NULL,
  `executor` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `agreement` varchar(255) NOT NULL,
  `time_solution` int(11) NOT NULL,
  `solution` mediumtext NOT NULL,
  `pretension` varchar(255) NOT NULL,
  `pretension_solution` varchar(255) NOT NULL,
  `history` mediumtext NOT NULL,
  `uid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `photo_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (29,'avdashov@centrab.ru','','Авдашов Алексей Витальевич','','','1',1),(30,'Avdeev@edu-tritec.ru','','Авдеев Станислав Викторович','','','1',1),(31,'Avseenko@tritec-group.ru','','Авсеенко Алексей Александрович','','','1',1),(32,'e.alekseev@centrab.ru','','Алексеев Егор Анатольевич','','','1',1),(33,'alekseeva@edu-tritec.ru','','Алексеева Анна Александровна','','','1',1),(34,'Tabakova@centrab.ru','','Амбарюк Каролина Вадимовна','','','1',1),(35,'Andreeva@centrab.ru','','Андреева Наталия Владимировна','','','1',1),(36,'rbsupport@real-bs.ru','','Андрей','Подрядчик','','1',0),(37,'anokhina@edu-tritec.ru','','Анохина Елена Владимировна','','','1',1),(38,'Babenko@centrab.ru','','Бабенко Алексей Сергеевич','','','1',1),(39,'Bagaev@centrab.ru','','Багаев Сергей Игоревич','','','1',1),(40,'Bahvalova@centrab.ru','','Бахвалова Татьяна Геннадьевна','','','1',1),(41,'Beregovskaya@centrab.ru','','Береговская Александра Викторовна','','','1',1),(42,'Beresnev@edu-tritec.ru','','Береснев Алексей','Инструктор','','1',1),(43,'Beskrovnyj@centrab.ru','','Бескровный Владимир Владимирович','','','1',1),(44,'bogomolova@centrab.ru','','Богомолова Диана Владимировна','','','1',1),(45,'Bodrov@edu-tritec.ru','','Бодров Алексей Михайлович','Инструктор','','1',1),(46,'Bolgova@edu-tritec.ru','','Болгова Наталья Сергеевна','','','1',1),(47,'bondalet@centrab.ru','','Бондалет Леонид Павлович','','','1',1),(48,'Borshcheva@tritec-group.ru','','Борщева Юлия Александровна','Уволенный сотрудник','','1',1),(49,'bochkareva@centrab.ru','','Бочкарева Светлана Николаевна','','','1',1),(50,'bragin@centrab.ru','','Брагин Сергей Сергеевич','','','1',1),(51,'Varygina@centrab.ru','','Варыгина Дарья Александровна','','','1',1),(52,'Vasilyeva@centrab.ru','','Васильева Елена Олеговна','','','1',1),(53,'vereschagin@centrab.ru','','Верещагин Николай Анатольевич','','','1',1),(54,'Volhin@centrab.ru','','Вольхин Степан Владимирович','','','1',1),(55,'Vorobejchikova@centrab.ru','','Воробейчикова Светлана Сергеевна','','','1',1),(56,'Vorobyeva@centrab.ru','','Воробьева Кристина Андреевна','','','1',1),(57,'Voronkin@edu-tritec.ru','','Воронкин Леонид','Инструктор','','1',1),(58,'galaktionova@centrab.ru','','Галактионова Екатерина Станиславна','','','1',1),(59,'Gerchikova@centrab.ru','','Герчикова Елена Зиновьевна','','','1',1),(60,'Gitelson@centrab.ru','','Гительсон Борис Игоревич','','','1',1),(61,'golovanov@edu-tritec.ru','','Голованов Виталий Петрович','','','1',1),(62,'golovanova@centrab.ru','','Голованова Юлия Олеговна','','','1',1),(63,'gonzurevsky@centrab.ru','','Гонзуревский Илья Алексеевич','','','1',1),(64,'Gordyushkin@tritec-group.com','','Гордюшкин Александр Петрович','','','1',1),(65,'Grebenshchikov@centrab.ru','','Гребенщиков Роман Алексеевич','','','1',1),(66,'Grickova@centrab.ru','','Грицкова Анастасия Владимировна','','','1',1),(67,'Grishova@centrab.ru','','Гришова Юлия Владимировна','','','1',1),(68,'Guzeev@centrab.ru','','Гузеев Александр Викторович','','','1',1),(69,'gunko@centrab.ru','','Гунько Марина Олеговна','','','1',1),(70,'Dmitriev@centrab.ru','','Дмитриев Андрей Владимирович','','','1',1),(71,'drapov@centrab.ru','','Драпов Михаил Владимирович','','','1',1),(72,'Dubasova@centrab.ru','','Дубасова Оксана Альбертовна','','','1',1),(73,'Durbalo@centrab.ru','','Дурбало Александр Александрович','','','1',1),(74,'a.evdokimova@centrab.ru','','Евдокимова Анна Валентиновна','','','1',1),(75,'egorova@centrab.ru','','Егорова Ирина Вячеславовна','','','1',1),(76,'Elenovich@centrab.ru','','Еленович Светлана Николаевна','','','1',1),(77,'yelhimov@tritec-group.ru','','Елхимов Сергей Владимирович','','','1',1),(78,'e.ershova@centrab.ru','','Ершова Екатерина Алексеевна','','','1',1),(79,'efanov@centrab.ru','','Ефанов Сергей Олегович','','','1',1),(80,'zhelezkova@edu-tritec.ru','','Железкова Анна Сергеевна','','','1',1),(81,'ZHivolupova@centrab.ru','','Живолупова Юлия Андреевна','','','1',1),(82,'zhuk@centrab.ru','','Жук Александр Александрович','','','1',1),(83,'s.v.zhuravlev@tritec-group.ru','','Журавлев Сергей Владимирович','','','1',1),(84,'Zabolotnikova@centrab.ru','','Заболотникова Елизавета Дамировна','','','1',1),(85,'zavarzina@centrab.ru','','Заварзина Ирина Владимировна','','','1',1),(86,'Zemlyanskaya@centrab.ru','','Землянская Мария Владимировна','','','1',1),(87,'Zolkina@edu-tritec.ru','','Золкина Галина Владимировна','','','1',1),(88,'Ivashchenko@edu-tritec.ru','','Иващенко Светлана Анатольевна','','','1',1),(89,'T.Ivleva@centrab.ru','','Ивлева Татьяна Александровна','','','1',1),(90,'Ignashenkova@tritec-group.ru','','Игнашенкова Валентина Сергеевна','','','1',1),(91,'Iliina@centrab.ru','','Ильина Оксана Владимировна','','','1',1),(92,'Kalugin@centrab.ru','','Калугин Алексей Александрович','','','1',1),(93,'Karazeeva@tritec-group.ru','','Каразеева Злата Вячеславовна','','','1',1),(94,'Karamysheva@centrab.ru','','Карамышева Ирина Геннадьевна','','','1',1),(95,'karimbaeva@centrab.ru','','Каримбаева Виктория Александровна','','','1',1),(96,'Kasenov@centrab.ru','','Касенов Тимур Булатович','Уволенный сотрудник','','1',1),(97,'Kiryakov@centrab.ru','','Кирьяков Вячеслав Витальевич','Удаленный сотрудник','','1',1),(98,'Kitova@centrab.ru','','Китова Марина Анатольевна','','','1',1),(99,'v.kichatkina@centrab.ru','','Кичаткина Вероника Сергеевна','','','1',1),(100,'Kleymenycheva@centrab.ru','','Клейменычева Татьяна Юрьевна','','','1',1),(101,'klochkova@edu-tritec.ru','','Клочкова Ирина Алексеевна','','','1',1),(102,'koblova@edu-tritec.ru','','Коблова Юлия Николаевна','','','1',1),(103,'dkovalskiy@tritec-group.ru','','Ковальский Денис Юрьевич','Уволенный сотрудник','','1',1),(104,'kovalskiy@tritec-group.ru','','Ковальский Денис Юрьевич','Уволенный сотрудник','','1',1),(105,'Kolozina@centrab.ru','','Колозина Ирина Васильевна','Уволенный сотрудник','','1',1),(106,'Kolomiec@centrab.ru','','Коломиец Дмитрий','Удаленный сотрудник','','1',1),(107,'Suhorukova@centrab.ru','','Колясова Валерия Владимировна','','','1',1),(108,'kondrikov@centrab.ru','','Кондриков Александр Владимирович','Подрядчик','','1',1),(109,'Konkina@centrab.ru','','Конкина Виктория Александровна','','','1',1),(110,'d.kononenko@centrab.ru','','Кононенко Дмитрий Федорович','Уволенный сотрудник','','1',1),(111,'kononenko@tritec-group.ru','','Кононенко Екатерина Викторовна','','','1',1),(112,'Korshunov@centrab.ru','','Коршунов Роман Юрьевич','','','1',1),(113,'Koslivtseva@edu-tritec.ru','','Косливцева Екатерина Владиславовна','','','1',1),(114,'Krasnobaeva@centrab.ru','','Краснобаева Анна Владимировна','','','1',1),(115,'Krivova@centrab.ru','','Кривова Анастасия Игоревна','','','1',1),(116,'kuvaldina@tritec-group.ru','','Кувалдина Анна Васильевна','','','1',1),(117,'a.kuznetsov@tritec-group.ru','','Кузнецов Антон Александрович','','','1',1),(118,'Kuznetsov@centrab.ru','','Кузнецов Владислав Олегович','','','1',1),(119,'Kuznetsova@centrab.ru','','Кузнецова Екатерина Михайловна','','','1',1),(120,'kuzminskaya@edu-tritec.ru','','Кузьминская Светлана Эдуардовна','','','1',1),(121,'Kurkina@centrab.ru','','Куркина Елена Алексеевна','','','1',1),(122,'kushner@centrab.ru','','Кушнер Анастасия Сергеевна','','','1',1),(123,'lavrova@edu-tritec.ru','','Лаврова Елена Владимировна','','','1',1),(124,'Lebedeva@centrab.ru','','Лебедева Ульяна Геннадиевна','','','1',1),(125,'levchenko@tritec-group.ru','','Левченко Михаил Евгеньевич','','','1',1),(126,'likina@edu-tritec.ru','','Ликина Наталья Игоревна','','','1',1),(127,'Lipnitskiy@real-bs.ru','','Липницкий Иван Николаевич','','','1',1),(128,'Lisenkov@tritec-group.ru','','Лисенков Сергей Леонидович','','','1',1),(129,'Lohmatova@tritec-group.ru','','Лохматова Светлана Владимировна','','','1',1),(130,'Lugovaya@edu-tritec.ru','','Луговая Татьяна Александровна','','','1',1),(131,'lugovoydd@edu-tritec.ru','','Луговой Даниил Дмитриевич','','','1',1),(132,'Lugovoy@tritec-group.ru','','Луговой Дмитрий Александрович','Инструктор','','1',1),(133,'lysunkina@centrab.ru','','Лысункина Людмила Николаевна','','','1',1),(134,'Makarevich@tritec-group.ru','','Макаревич Алина Сергеевна','','','1',1),(135,'Malysheva@edu-tritec.ru','','Малышева Елена Юрьевна','Менеджер, Самара','Декретный отпуск','1',1),(136,'malkova@tritec-group.ru','','Малькова Ирина Вячеславна','','','1',1),(137,'Mamedov@tritec-group.ru','','Мамедов Анатолий Юрьевич','','','1',1),(138,'Marenko@tritec-group.ru','','Маренко Елена Александровна','','','1',1),(139,'Matviichuk@centrab.ru','','Матвийчук Максим Анатольевич','','','1',1),(140,'miklyaeva@centrab.ru','','Микляева Ольга Вячеславовна','','','1',1),(141,'minyushin@centrab.ru','','Минюшин Эдуард Валентинович','Уволенный сотрудник','','1',1),(142,'o.muratova@centrab.ru','','Муратова Оксана Сарсеновна','','','1',1),(143,'Musatov@centrab.ru','','Мусатов Иван Алексеевич','','','1',1),(144,'Narezhny@centrab.ru','','Нарежный Сергей Александрович','','','1',1),(145,'u.naumova@centrab.ru','','Наумова Юлия Владимировна','','','1',1),(146,'nevskaya@tritec-group.ru','','Невская Елена Юрьевна','','','1',1),(147,'D.Nefedov@tritec-group.ru','','Нефедов Денис Вячеславович','','','1',1),(148,'A.Nikonova@centrab.ru','','Никонова Анастасия Валерьевна','','','1',1),(149,'nikonova@centrab.ru','','Никонова Вероника Андреевна','','','1',1),(150,'Novohatskaya@centrab.ru','','Новохацкая Елена Николаевна','','','1',1),(151,'Ovsyanikov@edu-tritec.ru','','Овсянников Алексей Анатольевич','','','1',1),(152,'Ogaltsova@centrab.ru','','Огальцова Ксения Сергеевна','','','1',1),(153,'Pavlov.V@centrab.ru','','Павлов Валерий Николаевич','','','1',1),(154,'Panina@edu-tritec.ru','','Панина Ирина Александровна','','','1',1),(155,'Panova@centrab.ru','','Панова Наталья Александровна','','','1',1),(156,'Pantiukhova@centrab.ru','','Пантюхова Марина Алексеевна','','','1',1),(157,'Paramonova@centrab.ru','','Парамонова Ирина Александровна','','','1',1),(158,'Peretyagina@centrab.ru','','Перетягина Марина Николаевна','','','1',1),(159,'Peskova@edu-tritec.ru','','Пескова Наталья Юрьевна','','','1',1),(160,'Plastun@tritec-group.ru','','Пластун Сергей Борисович','Уволенный сотрудник','','1',1),(161,'poimtseva@centrab.ru','','Поимцева Мария Валерьевна','','','1',1),(162,'Pomorov@centrab.ru','','Поморов Антон Андреевич','','','1',1),(163,'Popov@edu-tritec.ru','','Попов Алексей Александрович','','','1',1),(164,'m.popov@centrab.ru','','Попов Михаил Владимирович','','','1',1),(165,'Posnova@edu-tritec.ru','','Поснова Елена Александровна','','','1',1),(166,'E.Pospelova@centrab.ru','','Поспелова Елена Дмитриевна','','','1',1),(167,'pohmelnov@centrab.ru','','Похмельнов Сергей Александрович','','','1',1),(168,'Profatilova@tritec-group.ru','','Профатилова Наталия Игоревна','','','1',1),(169,'Pchelinceva@centrab.ru','','Пчелинцева Юлия Владимировна','','','1',1),(170,'Pyatahin@centrab.ru','','Пятахин Яков Дмитриевич','','','1',1),(171,'Raydenko@centrab.ru','','Райденко Юлиана Андреевна','','','1',1),(172,'ramazanova@tritec-group.ru','','Рамазанова Евгения Алексеевна','','','1',1),(173,'Rodin@centrab.ru','','Родин Дмитрий Александрович','','','1',1),(174,'vrozhnova@edu-tritec.ru','','Рожнова Виктория Евгеньевна','','','1',1),(175,'Rybakov@centrab.ru','','Рыбаков Сергей Владимирович','','','1',1),(176,'Sazhin@tritec-group.ru','','Сажин Сергей Евгеньевич','','','1',1),(177,'sazonov@edu-tritec.ru','','Сазонов Владимир Владимирович','Инструктор','','1',1),(178,'sechkina@edu-tritec.ru','','Сечкина Дарья Григорьевна','','','1',1),(179,'sinicyna@centrab.ru','','Синицына Елизавета Андреевна','','','1',1),(180,'sisina@edu-tritec.ru','','Сисина Мария Александровна','','','1',1),(181,'sitnikova@tritec-group.ru','','Ситникова Анастасия Олеговна','','','1',1),(182,'Slobodkina@tritec-group.ru','','Слободкина Маргарита Михайловна','','','1',1),(183,'smirnov@edu-tritec.ru','','Смирнов Евгений Викторович','Инструктор','','1',1),(184,'E.Smirnova@edu-tritec.ru','','Смирнова Елена Юрьевна','','','1',1),(185,'S.Smirnova@tritec-group.ru','','Смирнова Светлана Владимировна','','','1',1),(186,'Smolenskij@centrab.ru','','Смоленский Максим Васильевич','','','1',1),(187,'Snurnicyna@centrab.ru','','Снурницына Юлия Дмитриевна','','','1',1),(188,'sokerin@tritec-group.ru','','Сокерин Иван Олегович','','','1',1),(189,'sorokina@centrab.ru','','Сорокина Зинаида Юрьевна','','','1',1),(190,'sotnikov@centrab.ru','','Сотников Андрей Викторович','','','1',1),(191,'Stepchenko@edu-tritec.ru','','Степченко Елена Андреевна','','','1',1),(192,'Subbotina@centrab.ru','','Субботина Анастасия Анатольевна','','','1',1),(193,'sugrovskaya@centrab.ru','','Сугровская Виктория Викторовна','','','1',1),(194,'sundetov@centrab.ru','','Сундетов Ризат Тимургалиевич','','','1',1),(195,'Surat@tritec-group.ru','','Сурат Мариана Вячеславовна','','','1',1),(196,'suslikov@tritec-group.ru','','Сусликов Михаил Сергеевич','','','1',1),(197,'talaychuk@tritec-group.ru','','Талайчук Вадим Олегович','','','1',1),(198,'Tihonov@tritec-group.ru','','Тихонов Роман Дмитриевич','','','1',1),(199,'tihonova@tritec-group.ru','','Тихонова Наталья Николаевна','','','1',1),(200,'E.Tkachenko@edu-tritec.ru','','Ткаченко Екатерина Александровна','','','1',1),(201,'Tomko@centrab.ru','','Томко Владислав Викторович','','','1',1),(202,'Trapezina@centrab.ru','','Трапезина Дарья Владимировна','','','1',1),(203,'Trubnikova@centrab.ru','','Трубникова Надежда Сергеевна','','','1',1),(204,'Tyurina@centrab.ru','','Тюрина Евгения Николаевна','','','1',1),(205,'ugryumova@edu-tritec.ru','','Угрюмова Елена Анатольевна','','','1',1),(206,'utkina@tritec-group.ru','','Уткина Татьяна Петровна','','','1',1),(207,'Uhina@tritec-group.ru','','Ухина Полина Алексеевна','Уволенный сотрудник','','1',1),(208,'fedorin@centrab.ru','','Федорин Василий Юрьевич','','','1',1),(209,'Fedorov@centrab.ru','','Федоров Иван Дмитриевич','','','1',1),(210,'filimonovskaya@edu-tritec.ru','','Филимоновская Наталия Анатольевна','','','1',1),(211,'Forostyanov@real-bs.ru','','Форостьянов Илья Олегович','','','1',1),(212,'frolov@centrab.ru','','Фролов Николай Васильевич','','','1',1),(213,'T.Frolova@edu-tritec.ru','','Фролова Татьяна Витальевна','','','1',1),(214,'Hodyreva@centrab.ru','','Ходырева Ольга Петровна','','','1',1),(215,'citcer@tritec-group.ru','1898bbcfaccd00c7d629a45975b60fc6','Цитцер Олег Юрьевич','','','5ed2ab95c16183.11162244',1),(216,'borisova@edu-tritec.ru','','Цуканова Екатерина Владимировна','','','1',1),(217,'Chapligina@edu-tritec.ru','','Чаплыгина Ольга Славостьяновна','','','1',1),(218,'chebotareva@centrab.ru','','Чеботарёва Анна Александровна','','','1',1),(219,'Chekushkin@centrab.ru','','Чекушкин Евгений Владимирович','','','1',1),(220,'Chelibanov@centrab.ru','','Челибанов Алексей Игоревич','','','1',1),(221,'chepelenko@edu-tritec.ru','','Чепеленко Марина Ивановна','','','1',1),(222,'Chernaya@centrab.ru','','Черная Ольга Александровна','Уволенный сотрудник','Teamviewer на ней','1',1),(223,'Shamanaeva@edu-tritec.ru','','Шаманаева Екатерина Владимировна','','','1',1),(224,'shaposhnikov@centrab.ru','','Шапошников Роман Владимирович','','','1',1),(225,'Sharova@centrab.ru','','Шарова Юлия Петровна','','','1',1),(226,'Shelyakina@centrab.ru','','Шелякина Юлия Валерьевна','','','1',1),(227,'Shemarov@centrab.ru','','Шемаров Андрей Александрович','','','1',1),(228,'Schechtman@centrab.ru','','Шехтман Евгений Львович','','','1',1),(229,'shirokova@edu-tritec.ru','','Широкова Дарья Михайловна','','','1',1),(230,'Sholokh@centrab.ru','','Шолох Владислав Витальевич','','','1',1),(231,'shostakevich@centrab.ru','','Шостакевич Людмила Александровна','Удаленный сотрудник','','1',1),(232,'endrikova@edu-tritec.ru','','Эндрикова Ольга Юрьевна','Уволенный сотрудник','','1',1),(233,'Yrinskaya@edu-tritec.ru','','Юринская Юлия Владимировна','','','1',1),(234,'Yakimenko@edu-tritec.ru','','Якименко Виктория Владимировна','','','1',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-12 18:26:33
