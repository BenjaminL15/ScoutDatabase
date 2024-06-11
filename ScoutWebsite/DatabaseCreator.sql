-- Drop tables if they exist to avoid conflicts
DROP TABLE IF EXISTS MEMBER_AWARDS;
DROP TABLE IF EXISTS MEMBERS_BADGES;
DROP TABLE IF EXISTS MEETING_SCOUT;
DROP TABLE IF EXISTS SCOUT_PARENT;
DROP TABLE IF EXISTS COUNSELOR_BADGE;
DROP TABLE IF EXISTS MERITBADGE_COUNSELOR;
DROP TABLE IF EXISTS ADULT_VOLUNTEERS;
DROP TABLE IF EXISTS PARENTS;
DROP TABLE IF EXISTS PATROL;
DROP TABLE IF EXISTS MEETING;
DROP TABLE IF EXISTS BADGES;
DROP TABLE IF EXISTS AWARDS;
DROP TABLE IF EXISTS SCOUTS;

-- Create SCOUTS table
CREATE TABLE SCOUTS (
    SCOUTID INT IDENTITY(1,1),
    FIRSTNAME VARCHAR(25),
    LASTNAME VARCHAR(25),
    SCOUT_RANK VARCHAR(25),
    SCOUT_BIRTHDAY DATE,
    PRIMARY KEY (SCOUTID)
);

-- Insert data into SCOUTS table
INSERT INTO SCOUTS (SCOUTID, FIRSTNAME, LASTNAME, SCOUT_RANK, SCOUT_BIRTHDAY) VALUES
('1', 'Margaret', 'Dawson', 'Scout', '2006-03-15'),
('2', 'Grey', 'Smith', 'First Class', '2007-04-18'),
('3', 'Gregory', 'Howler', 'Life', '2006-08-20'),
('4', 'Jonathan', 'Daiquri', 'Tenderfoot', '2010-08-20'),
('5', 'Lou', 'Willis', 'Eagle', '2006-05-01'),
('6', 'Mason', 'Park', 'Second Class', '2008-09-23'),
('7', 'Amelia', 'Durnst', 'Star', '2009-10-21'),
('8', 'Sarah', 'Becker', 'Life', '2011-03-06'),
('9', 'Jennifer', 'Castillo', 'First Class', '2006-02-28'),
('10', 'Marshall', 'Brown', 'Life', '2005-08-20');

-- Create MEETING table
CREATE TABLE MEETING (
    MEETINGID INT IDENTITY(1,1),
    SCOUTID INT,
    MEETINGDATE DATETIME,
    PRIMARY KEY (MEETINGID),
    FOREIGN KEY (SCOUTID) REFERENCES SCOUTS(SCOUTID)
);

-- Insert data into MEETING table
INSERT INTO MEETING (MEETINGID, SCOUTID, MEETINGDATE) VALUES
('1', '2', '2024-01-02'),
('2', '3', '2024-02-02'),
('3', '4', '2024-03-02'),
('4', '5', '2024-04-02'),
('5', '6', '2024-05-02'),
('6', '8', '2024-06-02'),
('7', '8', '2024-07-02'),
('8', '9', '2024-08-02'),
('9', '10', '2024-09-02'),
('10', '9', '2024-10-02'),
('11', '8', '2024-11-02'),
('12', '10', '2024-12-02');

-- Create MEETING_SCOUT table
CREATE TABLE MEETING_SCOUT (
    MEETINGID INT,
    SCOUTID INT,
    ATTENDANCE BIT,
    PRIMARY KEY (MEETINGID, SCOUTID),
    FOREIGN KEY (MEETINGID) REFERENCES MEETING(MEETINGID),
    FOREIGN KEY (SCOUTID) REFERENCES SCOUTS(SCOUTID)
);

-- Insert data into MEETING_SCOUT table
INSERT INTO MEETING_SCOUT (MEETINGID, SCOUTID, ATTENDANCE) VALUES
('1', '1', 1),
('2', '2', 1),
('3', '3', 0),
('4', '4', 1),
('5', '5', 1),
('6', '6', 0),
('7', '7', 1),
('8', '8', 0),
('9', '9', 1),
('10', '10', 1),
('11', '1', 1),
('12', '2', 0);

-- Create PATROL table
CREATE TABLE PATROL (
    PATROLID INT IDENTITY(1,1),
    SCOUTID INT,
    PAT_LEADER VARCHAR(25),
    ASSIST_LEADER VARCHAR(25),
    PATROLNAME VARCHAR(25),
    PRIMARY KEY (PATROLID),
    FOREIGN KEY (SCOUTID) REFERENCES SCOUTS(SCOUTID)
);

-- Insert data into PATROL table
INSERT INTO PATROL (PATROLID, SCOUTID, PAT_LEADER, ASSIST_LEADER, PATROLNAME) VALUES
('1', '1', 'Grey', 'Gregory', 'The Mandalorians'),
('2', '2', 'Grey', 'Gregory', 'The Mandalorians'),
('3', '9', 'Grey', 'Gregory', 'The Mandalorians'),
('4', '3', 'Jonathan', 'Lou', 'Breakfast Club'),
('5', '4', 'Jonathan', 'Lou', 'Breakfast Club'),
('6', '5', 'Mason', 'Amelia', 'Sigma Squad'),
('7', '6', 'Mason', 'Amelia', 'Sigma Squad'),
('8', '7', 'Sarah', 'Jennifer', 'Pink Pony Club'),
('9', '8', 'Sarah', 'Jennifer', 'Pink Pony Club'),
('10', '10', 'Sarah', 'Jennifer', 'Pink Pony Club');

-- Create PARENTS table
CREATE TABLE PARENTS (
    PARENTID INT IDENTITY(1,1),
    SCOUTID INT,
    PARENT_FNAME VARCHAR(25),
    PARENT_LNAME VARCHAR(25),
    PARENTPHONE VARCHAR(25),
    PARENTADDRESS VARCHAR(35),
    PARENTSTATE VARCHAR(25),
    PARENTZIP VARCHAR(25),
    PRIMARY KEY (PARENTID),
    FOREIGN KEY (SCOUTID) REFERENCES SCOUTS(SCOUTID)
);

-- Insert data into PARENTS table
INSERT INTO PARENTS (PARENTID, SCOUTID, PARENT_FNAME, PARENT_LNAME, PARENTPHONE, PARENTADDRESS, PARENTSTATE, PARENTZIP) VALUES
('1', '1', 'Husnain', 'Choudhry', '703-111-1111', '4241 Montebello Place', 'Virginia', '22903'),
('2', '3', 'Bianca', 'Jewett', '703-222-1111', '43244 Bristow Ave', 'Virginia', '22903'),
('3', '3', 'Brian', 'Lai', '703-222-1111', '4324 Bristow Ave', 'Virginia', '22903'),
('4', '2', 'Bob', 'Lee', '703-111-1111', '6859 Charlottesville Way', 'Virginia', '22903'),
('5', '4', 'Bryan', 'Lie', '703-222-1111', '1234 Manassas Street', 'Virginia', '22903');

-- Create SCOUT_PARENT table
CREATE TABLE SCOUT_PARENT (
    PARENTID INT,
    SCOUTID INT,
    RELATIONSHIP_TYPE VARCHAR(25),
    CONTACT_PRIORITY INT,
    PRIMARY KEY (PARENTID, SCOUTID),
    FOREIGN KEY (PARENTID) REFERENCES PARENTS(PARENTID),
    FOREIGN KEY (SCOUTID) REFERENCES SCOUTS(SCOUTID)
);

-- Insert data into SCOUT_PARENT table
INSERT INTO SCOUT_PARENT (PARENTID, SCOUTID, RELATIONSHIP_TYPE, CONTACT_PRIORITY) VALUES
('1', '1', 'DAD', '1'),
('2', '2', 'DAD', '1'),
('3', '3', 'MOM', '2'),
('4', '3', 'DAD', '1'),
('5', '4', 'DAD', '1');

-- Create ADULT_VOLUNTEERS table
CREATE TABLE ADULT_VOLUNTEERS (
    ADULT_VOLID INT IDENTITY(1,1),
    PARENTID INT,
    AVFNAME VARCHAR(25),
    AVLNAME VARCHAR(25),
    AVPHONE VARCHAR(25),
    AVADDRESS VARCHAR(35),
    AVSTATE VARCHAR(25),
    AVZIP VARCHAR(25),
    PRIMARY KEY (ADULT_VOLID),
    FOREIGN KEY (PARENTID) REFERENCES PARENTS(PARENTID)
);

-- Insert data into ADULT_VOLUNTEERS table
INSERT INTO ADULT_VOLUNTEERS (ADULT_VOLID, PARENTID, AVFNAME, AVLNAME, AVPHONE, AVADDRESS, AVSTATE, AVZIP) VALUES
('1', '1', 'Husnain', 'Choudhry', '703-111-1111', 'Charlottesville, Montebello', 'Virginia', '22903'),
('2', '4', 'Justin', 'Lai', '703-111-1111', '3452 Montebello Way', 'Virginia', '22903'),
('3', '5', 'Duke', 'Nguyen', '703-111-1111', '8943 Montebello Street', 'Virginia', '22903'),
('4', '2', 'Bianca', 'Jewett', '703-111-1111', '5455 Bristow Street', 'Virginia', '22903'),
('5', '3', 'Bryan', 'Lie', '703-111-1111', '5656 Springfield Ave', 'Virginia', '22903');

-- Create MERITBADGE_COUNSELOR table
CREATE TABLE MERITBADGE_COUNSELOR (
    MERITBADGE_COUNSELORID INT IDENTITY(1,1),
    CO_FNAME VARCHAR(25),
    CO_LNAME VARCHAR(25),
    COPHONE VARCHAR(25),
    COADDRESS VARCHAR(35),
    COSTATE VARCHAR(25),
    COZIP VARCHAR(25),
    PRIMARY KEY (MERITBADGE_COUNSELORID)
);

-- Insert data into MERITBADGE_COUNSELOR table
INSERT INTO MERITBADGE_COUNSELOR (MERITBADGE_COUNSELORID, CO_FNAME, CO_LNAME, COPHONE, COADDRESS, COSTATE, COZIP) VALUES
('1', 'Michael', 'Smith', '703-345-1111', '123 Counselor St', 'Virginia', '22903'),
('2', 'Sarah', 'Johnson', '703-456-1111', '456 Mentor Ave', 'Virginia', '22903'),
('3', 'John', 'Doe', '703-567-1111', '789 Advisor Blvd', 'Virginia', '22903'),
('4', 'Jane', 'Roe', '703-678-1111', '321 Guidance Ln', 'Virginia', '22903'),
('5', 'James', 'Black', '703-789-1111', '654 Support Rd', 'Virginia', '22903');

-- Create COUNSELOR_BADGE table
CREATE TABLE COUNSELOR_BADGE (
    COUNSELORID INT,
    BADGEID INT,
    PRIMARY KEY (COUNSELORID, BADGEID),
    FOREIGN KEY (COUNSELORID) REFERENCES MERITBADGE_COUNSELOR(MERITBADGE_COUNSELORID),
    FOREIGN KEY (BADGEID) REFERENCES BADGES(BADGEID)
);

-- Insert data into COUNSELOR_BADGE table
INSERT INTO COUNSELOR_BADGE (COUNSELORID, BADGEID) VALUES
('1', '1'),
('1', '2'),
('2', '3'),
('2', '4'),
('3', '5'),
('4', '6'),
('4', '7'),
('5', '8'),
('5', '9');

-- Create BADGES table
CREATE TABLE BADGES (
    BADGEID INT IDENTITY(1,1),
    BADGENAME VARCHAR(25),
    BADGE_DESC VARCHAR(255),
    PRIMARY KEY (BADGEID)
);

-- Insert data into BADGES table
INSERT INTO BADGES (BADGEID, BADGENAME, BADGE_DESC) VALUES
('1', 'Citizenship in the Community', 'Learn the rights, duties, and obligations of citizenship.'),
('2', 'Citizenship in the Nation', 'Understand your national government.'),
('3', 'Citizenship in the World', 'Learn about global citizenship.'),
('4', 'Communication', 'Develop your communication skills.'),
('5', 'Cooking', 'Learn to cook meals outdoors.'),
('6', 'First Aid', 'Know the basics of first aid.'),
('7', 'Camping', 'Learn the essentials of camping.'),
('8', 'Personal Fitness', 'Develop a personal fitness plan.'),
('9', 'Emergency Preparedness', 'Prepare for emergency situations.');

-- Create AWARDS table
CREATE TABLE AWARDS (
    AWARDID INT IDENTITY(1,1),
    AWARDNAME VARCHAR(25),
    AWARD_DESC VARCHAR(255),
    PRIMARY KEY (AWARDID)
);

-- Insert data into AWARDS table
INSERT INTO AWARDS (AWARDID, AWARDNAME, AWARD_DESC) VALUES
('1', 'Eagle Scout', 'The highest rank attainable in the Boy Scouting program.'),
('2', 'Silver Award', 'Recognizes outstanding service to the Boy Scouts.'),
('3', 'Merit Award', 'Awarded for exceptional service in scouting activities.');

-- Create MEMBER_AWARDS table
CREATE TABLE MEMBER_AWARDS (
    SCOUTID INT,
    AWARDID INT,
    DATE_AWARDED DATE,
    PRIMARY KEY (SCOUTID, AWARDID),
    FOREIGN KEY (SCOUTID) REFERENCES SCOUTS(SCOUTID),
    FOREIGN KEY (AWARDID) REFERENCES AWARDS(AWARDID)
);

-- Insert data into MEMBER_AWARDS table
INSERT INTO MEMBER_AWARDS (SCOUTID, AWARDID, DATE_AWARDED) VALUES
('1', '1', '2022-05-01'),
('2', '2', '2022-06-01'),
('3', '3', '2022-07-01'),
('4', '1', '2022-08-01'),
('5', '2', '2022-09-01'),
('6', '3', '2022-10-01'),
('7', '1', '2022-11-01'),
('8', '2', '2022-12-01'),
('9', '3', '2023-01-01'),
('10', '1', '2023-02-01');

-- Create MEMBERS_BADGES table
CREATE TABLE MEMBERS_BADGES (
    SCOUTID INT,
    BADGEID INT,
    DATE_EARNED DATE,
    PRIMARY KEY (SCOUTID, BADGEID),
    FOREIGN KEY (SCOUTID) REFERENCES SCOUTS(SCOUTID),
    FOREIGN KEY (BADGEID) REFERENCES BADGES(BADGEID)
);

-- Insert data into MEMBERS_BADGES table
INSERT INTO MEMBERS_BADGES (SCOUTID, BADGEID, DATE_EARNED) VALUES
('1', '1', '2022-03-01'),
('2', '2', '2022-04-01'),
('3', '3', '2022-05-01'),
('4', '4', '2022-06-01'),
('5', '5', '2022-07-01'),
('6', '6', '2022-08-01'),
('7', '7', '2022-09-01'),
('8', '8', '2022-10-01'),
('9', '9', '2022-11-01'),
('10', '1', '2022-12-01');
