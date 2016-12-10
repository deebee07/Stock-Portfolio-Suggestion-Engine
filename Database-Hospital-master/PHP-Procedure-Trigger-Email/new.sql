CREATE TABLE `notification` (
  `email` varchar(35) NOT NULL,
  `patient_id` int(6) NOT NULL,
  `record_id` int(11) NOT NULL,
  `record_val` int(11) NOT NULL,
  `record_type` varchar(25) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sent` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DELIMITER $$
CREATE TRIGGER `after_record_insert` AFTER INSERT ON `record` FOR EACH ROW BEGIN

Declare eid INT(6);
Declare email Varchar(35);

 if (NEW.Reading_Type = "Oxygen" and NEW.Value < 60 ) OR (NEW.Reading_Type = "Systolic Blood" and NEW.Value > 159 ) OR (NEW.Reading_Type = "Diastolic Blood" and NEW.Value > 99 ) OR (NEW.Reading_Type = "Heart Rate" and NEW.Value > 100 ) OR (NEW.Reading_Type = "Heart Rate" and NEW.Value < 60 )  Then
Select PatientCare.patient.Main_Doctor into eid  from PatientCare.patient  where NEW.Patient_ID = PatientCare.patient.Patient_ID;
Select PatientCare.employee.Email_Address into email from PatientCare.employee  where eid = PatientCare.employee.Employee_ID;
insert into PatientCare.notification values(email,NEW.Patient_ID,NEW.Record_ID,NEW.Value,NEW.Reading_Type,NEW.time_stamp,0);



end if;
   
END
$$
DELIMITER ;
