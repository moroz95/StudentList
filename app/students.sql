-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "students" ---------------------------------
CREATE TABLE `students` ( 
	`firstName` VarChar( 255 ) NOT NULL,
	`lastName` VarChar( 255 ) NOT NULL,
	`groupNumber` TinyText NULL,
	`birthDate` Date NOT NULL,
	`email` Char( 255 ) NOT NULL,
	`mark` Int( 255 ) NOT NULL,
	`id` Int( 255 ) AUTO_INCREMENT NOT NULL,
	`location` Enum( 'local', 'nonresident' ) NOT NULL,
	`sex` Enum( 'male', 'female' ) NOT NULL,
	`password` VarChar( 255 ) NULL,
	CONSTRAINT `unique_email` UNIQUE( `email` ),
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 48;
-- ---------------------------------------------------------


-- Dump data of "students" ---------------------------------
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Мария', 'Забошкина', '100-561', '1994-05-07', '123@emal.com', '300', '33', 'local', 'female', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Никита', 'Долгоусов', '123', '1977-10-06', 'eey@gmail.com', '230', '30', 'nonresident', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Никита', 'Белоусов', '12345', '1977-10-06', 'eey@gmail.con', '247', '5', 'nonresident', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Анастасия', 'Янковская', '100-51', '1998-05-07', 'h@email.com', '210', '9', 'nonresident', 'female', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Мария', 'Янковская', '100-561', '1999-05-07', 'her@email.com', '220', '2', 'nonresident', 'female', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Гульчата', 'Нашенская', '100-551', '1995-05-07', 'her@emaily.com', '132', '32', 'nonresident', 'female', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Мария', 'Антошина', '100-561', '1999-05-07', 'her@emal.com', '220', '11', 'local', 'female', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Максим', 'Харитонов', '101-456', '1995-08-09', 'his@email.com', '199', '3', 'nonresident', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Максим', 'Давнович', '101-456', '1996-08-11', 'hiss@email.com', '196', '34', 'nonresident', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Студент', 'Новый', '1245', '1994-03-12', 'lacos@mail.ru', '299', '43', 'nonresident', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Алексей', 'Батурин', '141-322', '1998-01-01', 'my@email.com', '200', '1', 'local', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Зинаида', 'Аркадьевна', '0011s', '1979-06-04', 'n@oulook.cmru', '199', '44', 'nonresident', 'female', '2UNY12ZGP2Si8hiUv0eJ9hGhxLNKvWB5pT92pY9DXoSa4ednzBUFfQ' );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Анастасия', 'Фомкина', '24', '1999-07-21', 'Nastaia21@yandex.ru', '299', '45', 'nonresident', 'female', 'DZlIx4UWKKtqmtkpQPh6aXAFfHRQ9uuDfS2XPngnVA8H3jgnJQfXsA' );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Алексей', 'Замутин', '141-323', '1997-01-01', 'nice@email.com', '133', '35', 'local', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Имя', 'Новое', '1346', '1111-11-11', 'njt@com.ru', '217', '6', 'nonresident', 'female', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Ктото', 'Там', '1347', '1111-11-11', 'njtr@com.ru', '217', '36', 'nonresident', 'female', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Имя', 'фАНТА', '789', '1997-05-12', 'noon@hul.com', '300', '41', 'local', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Никита', 'Локтионов', '239-afs', '1999-12-10', 'nuiki@nak.ri', '299', '4', 'nonresident', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Владимир', 'Локтионов', '239-afs', '1996-12-10', 'nuikri@nak.ri', '250', '37', 'nonresident', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Костя', 'Костянский', 'пппп', '2017-02-24', 'sada@mi.sff', '-3293', '39', 'local', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Аркадий', 'Новоюткин', '100-51', '1998-04-07', 'ser@email.com', '156', '10', 'local', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Аркадий', 'Укупник', '100-51', '1995-04-07', 'sesr@email.com', '166', '38', 'local', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Найсный', 'Алексей', '1234', '1996-07-07', 'shiftiam@gmail.com', '199', '40', 'local', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Апдейта', 'Проверка', '23435', '1996-05-05', 'shiftiam@gmam.lko', '245', '42', 'nonresident', 'male', NULL );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`,`password`) VALUES ( 'Валерия', 'Грибоедова', '100-51', '1998-04-07', 'tata@email.com', '200', '31', 'local', 'female', NULL );
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


