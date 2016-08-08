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
	CONSTRAINT `unique_email` UNIQUE( `email` ),
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- ---------------------------------------------------------


-- Dump data of "students" ---------------------------------
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`) VALUES ( 'Мария', 'Янковская', '100-561', '1999-05-07', 'her@email.com', '220', '2', 'nonresident', 'female' );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`) VALUES ( 'Максим', 'Харитонов', '101-456', '1995-08-09', 'his@email.com', '199', '3', 'nonresident', 'male' );
INSERT INTO `students`(`firstName`,`lastName`,`groupNumber`,`birthDate`,`email`,`mark`,`id`,`location`,`sex`) VALUES ( 'Алексей', 'Батурин', '141-322', '1998-01-01', 'my@email.com', '200', '1', 'local', 'male' );
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


