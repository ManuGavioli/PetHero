CREATE DATABASE IF NOT EXISTS TpFinal_PetHeroDB;

USE TpFinal_PetHeroDB;


DROP TABLE IF EXISTS Messages;
DROP TABLE IF EXISTS Chats;
DROP TABLE IF EXISTS AvailabilityDate;
DROP TABLE IF EXISTS Coupon;
DROP TABLE IF EXISTS Reviews;
DROP TABLE IF EXISTS Bookings;
DROP TABLE IF EXISTS Pets;
DROP TABLE IF EXISTS Owners;
DROP TABLE IF EXISTS Keepers;
DROP TABLE IF EXISTS Banks;

CREATE TABLE Banks 
(
	IdBank int(11) NOT NULL AUTO_INCREMENT,
	cbu bigint(20) NOT NULL UNIQUE, 
	alias varchar(50) UNIQUE,
	total float(10) DEFAULT 0,
        PRIMARY KEY(IdBank)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
        BankKeeper int(11) NOT NULL,
        PRIMARY KEY(user_id),
        CONSTRAINT fk_idbank FOREIGN KEY (BankKeeper) REFERENCES Banks (IdBank) ON DELETE NO ACTION ON UPDATE NO ACTION

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

CREATE TABLE Bookings 
(
        keeperId int(11) NOT NULL,
        idBooking int(11) NOT NULL AUTO_INCREMENT,
    
        startDate date DEFAULT NULL,
        finalDate date DEFAULT NULL,
        confirmed tinyint DEFAULT 0,
        petId int(11) NOT NULL,
        PRIMARY KEY(idBooking),
    
        CONSTRAINT fk_booking_keeperId FOREIGN KEY (keeperId) REFERENCES keepers (user_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT fk_booking_petId FOREIGN KEY (petId) REFERENCES pets (id_pet) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE Reviews
(
        idBooking int(11) NOT NULL,
        idReview int(11) NOT NULL AUTO_INCREMENT,
        description varchar(280) DEFAULT NULL,
        reviewDate date DEFAULT NULL,
        score int(5) DEFAULT NULL,
        PRIMARY KEY(idReview),
        CONSTRAINT fk_review_idBooking FOREIGN KEY (idBooking) REFERENCES bookings (idBooking) ON DELETE NO ACTION ON UPDATE NO ACTION

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE Coupon 
(
	idCoupon int(11) NOT NULL AUTO_INCREMENT,
	paidAlready float(10) DEFAULT NULL,
	totalPay float(10) DEFAULT NULL,
        BookingId int(11) NOT NULL,
        VoucherCode varchar(999) DEFAULT NULL,
	PRIMARY KEY(idCoupon),
        CONSTRAINT fk_booking_coupon FOREIGN KEY (BookingId) REFERENCES Bookings (idBooking) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE AvailabilityDate 
(
	availabilityId int(11) NOT NULL AUTO_INCREMENT,
	keeperId int(11) NOT NULL,
	keeperDate date DEFAULT NULL,
	available boolean DEFAULT FALSE,
        PRIMARY KEY(availabilityId),
	CONSTRAINT fk_availability_keeperId FOREIGN KEY (keeperId) REFERENCES keepers (user_id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE Chats 
(
	idChat int(11) NOT NULL AUTO_INCREMENT,
	OwnerId int(11) NOT NULL,
        KeeperId int(11) NOT NULL,
        PRIMARY KEY(idChat),
	CONSTRAINT fk_chat_ownerid FOREIGN KEY (OwnerId) REFERENCES owners (user_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT fk_chat_keeperid FOREIGN KEY (KeeperId) REFERENCES keepers (user_id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE Messages 
(
	idMessage int(11) NOT NULL AUTO_INCREMENT,
	idChat int(11) NOT NULL,
	dateTimer datetime DEFAULT NULL,
	user tinyint DEFAULT 0,
        textMsg varchar(100), 
        PRIMARY KEY(idMessage),
	CONSTRAINT fk_chat_ChatId FOREIGN KEY (idChat) REFERENCES Chats (idChat) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#Este evento es para que las reservas que finalizan ese dia puedan habilitar para hacer la review

DROP EVENT IF EXISTS Booking_Finish;
SET GLOBAL event_scheduler = ON;

CREATE EVENT Booking_Finish
ON SCHEDULE EVERY 1 DAY
STARTS '2022-11-14 00:00:00' ENABLE
DO UPDATE Bookings
set confirmed=4
where confirmed=3 and finalDate<CURDATE();

#Este evento es para que las reservas pendientes de aceptacion que empiezan un dia antes de hoy queden rechazadas automaticamente

DROP EVENT IF EXISTS Booking_reject;

SET GLOBAL event_scheduler = ON;

CREATE EVENT Booking_reject
ON SCHEDULE EVERY 1 DAY
STARTS '2022-11-14 00:00:00' ENABLE
DO UPDATE Bookings
set confirmed=2
where  confirmed=0 and startDate<CURDATE();

