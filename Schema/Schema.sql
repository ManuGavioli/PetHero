CREATE DATABASE IF NOT EXISTS TpFinal_PetHeroDB;

USE TpFinal_PetHeroDB;

DROP TABLE IF EXISTS Availability;
DROP TABLE IF EXISTS Bookings;
DROP TABLE IF EXISTS Reviews;
DROP TABLE IF EXISTS Pets;
DROP TABLE IF EXISTS Owners;
DROP TABLE IF EXISTS Keepers;

CREATE TABLE Keepers 
(
        user_id int(11) NOT NULL AUTO_INCREMENT,
        firstName varchar(30) DEFAULT NULL,
        lastName varchar(30) DEFAULT NULL,
        dni varchar(12) DEFAULT NULL,
        email varchar(45) DEFAULT NULL,
        pass varchar(45) DEFAULT NULL,
        phoneNumber varchar(15) DEFAULT NULL,
        petType varchar(20) DEFAULT NULL,
        price float(10) DEFAULT NULL, 
        PRIMARY KEY(user_id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE Owners 
(
        user_id int(11) NOT NULL AUTO_INCREMENT,
        firstName varchar(30) DEFAULT NULL,
        lastName varchar(30) DEFAULT NULL,
        dni varchar(12) DEFAULT NULL,
        email varchar(45) DEFAULT NULL,
        pass varchar(45) DEFAULT NULL,
        phoneNumber varchar(15) DEFAULT NULL,
        PRIMARY KEY(user_id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE Pets 
(
         id_pet int(11) NOT NULL AUTO_INCREMENT,
         name_pet varchar(30) DEFAULT NULL,
         photo varchar(999) DEFAULT NULL,
         petType varchar(20) DEFAULT NULL,
         raze varchar(20) DEFAULT NULL,
         size float(10) DEFAULT NULL,
         vaccinationPhoto varchar(999) DEFAULT NULL,
         observations varchar(280) DEFAULT NULL,
         video varchar(999) DEFAULT NULL,
         id_owner int(11) NOT NULL,
         PRIMARY KEY (id_pet),
         CONSTRAINT fk_pet_ownerId FOREIGN KEY (id_owner) REFERENCES owners (user_id) ON DELETE NO ACTION ON UPDATE NO ACTION

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE Reviews
(
        keeperId int(11) NOT NULL,
        idReview int(11) NOT NULL AUTO_INCREMENT,
        description varchar(280) DEFAULT NULL,
        reviewDate date DEFAULT NULL,
        score int(5) DEFAULT NULL,
        PRIMARY KEY(idReview),
        CONSTRAINT fk_review_keeperId FOREIGN KEY (keeperId) REFERENCES keepers (user_id) ON DELETE NO ACTION ON UPDATE NO ACTION

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE Bookings 
(
    keeperId int(11) NOT NULL,
    idBooking int(11) NOT NULL AUTO_INCREMENT,
    amountPaid float(10) DEFAULT NULL,
    totalValue float(10) DEFAULT NULL,
    startDate date DEFAULT NULL,
    finalDate date DEFAULT NULL,
    confirmed boolean DEFAULT FALSE,
    petId int(11) NOT NULL,
    PRIMARY KEY(idBooking),
    CONSTRAINT fk_booking_keeperId FOREIGN KEY (keeperId) REFERENCES keepers (user_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_booking_petId FOREIGN KEY (petId) REFERENCES pets (id_pet) ON DELETE NO ACTION ON UPDATE NO ACTION

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE Availability 
(
	availabilityId int(11) NOT NULL AUTO_INCREMENT,
	keeperId int(11) NOT NULL,
	keeperDate date DEFAULT NULL,
	available boolean DEFAULT FALSE,
        PRIMARY KEY(availabilityId),
	CONSTRAINT fk_availability_keeperId FOREIGN KEY (keeperId) REFERENCES keepers (user_id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;