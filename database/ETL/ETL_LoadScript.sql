#########################################################################################################
#new records added to the schedule table are initially assigned a current-rec-ind of "X"
# until the this script has successfully completed, at such time they will then get set
# to the approperate Y/N condition.
#This was done as a check-point-restart feature to the script. This script is set up
#in a series of steps to the move the VNA schedule data from the LANDING-TABLE and onto
#the rest of the VNAS application data model. (r.guillard 3/12/2016)
#
#       Step#0  Load vnasdata.csv file into landing.
#               The file location: ~\wamp\bin\mysql\mysql5.6.17\data\vnas_db\vnasdata.csv
#
#	Step#1: Remove any unprocessed new calendar records from VNAS_SCHEDULE and also remove the old
#               current/future calendar records (STS = 'F').
#
#	Step#2: Set record checksum for the newly loaded landing records REC_CDC_NUM.
#
#	Step#3: Load only the newly added calendar records to the VNAS Schdule tables. Using
#	        the REC_CDC_NUM to filter records already present on the VNAS Schedule.
#
#	step#4: SET THE OLD ARCHIVED RECORD CURRENT_IND TO 'N' this is a versioning logical delete.
#
#	Step#5: Versioning, Set the current Record indicator on VNAS Schedule table 
#		Y- indicates the active version of multiple like records N - is not. The Current-Rec-IND
#               is a key field in driving only the current calendar content in the VNAS appliction.
#               This is a version control feature.
#       Step#6: Populate the General Reference table to used as the application decode table.
#       Step#7: Populate the VNAS_VNA_USER_REF table.
#
#       Version 1.0 r.guillard 03/12/12016
#########################################################################################################
#Robert - Added the USE vnas so that the shell script doesn't have to specify the database 
#         it running on. Just to make the script file a bit more vague.

#Zach - Added this because of the error: Illegal mix of collations (utf8mb4_general_ci,COERCIBLE) and (latin1_swedish_ci,IMPLICIT)
#Uncomment this line if you need it
#change name to your localhost DB if different from vnas
SET collation_connection = 'utf8_general_ci';
ALTER DATABASE app CHARACTER SET utf8 COLLATE utf8_general_ci; 
ALTER TABLE VNAS_GEN_REF CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE VNAS_SCHEDULE CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;

#STEP#0
#kILL and fill the landing table.
TRUNCATE VNAS_SCHEDULE_LANDING;
#Load the flat file into VNAS_SCHEDULE_LANDING
#The flat file location is: C:\wamp\bin\mysql\mysql5.6.17\data\vnas_db
#The dev server file location is: /var/lib/openshift/56b6e9612d527164d3000155/mysql/data/app/vnasdata.csv
LOAD DATA INFILE "vnasdata.csv"
INTO TABLE VNAS_SCHEDULE_LANDING
COLUMNS TERMINATED BY '|'
OPTIONALLY ENCLOSED BY '"'
ESCAPED BY '"'
LINES TERMINATED BY '\n'
;

#STEP#1 

#Create the record change data capture numberfor the newly loaded landing records.
#SET THE record Change Data Capture number on stage. 
UPDATE VNAS_SCHEDULE_LANDING SET CDC_NUM = ' ';

COMMIT;
Update VNAS_SCHEDULE_LANDING
SET CDC_NUM =
md5(CONCAT(STS,CARE_GIVER_ID,CLIENT_ID,SCHEDULE_START_DT,SCHEDULE_START_TM,
SCHEDULE_DURATION,CALENDAR_TYPE,CARE_GIVER_TYPE,
CARE_GIVER_FIRST_NME,CARE_GIVER_LAST_NME,CARE_GIVER_OFFICE_PH, CARE_GIVER_MOBILE_PH,
CLIENT_FIRST_NME, CLIENT_LAST_NME,CLIENT_ADDRESS,CLIENT_CITY,
CLIENT_STATE, CLIENT_ZIP,CLIENT_PHONE,COMMENTS));
COMMIT;

#SET STATUS FLAG TO C to indicate that an existing schedule change.

UPDATE  VNAS_SCHEDULE_LANDING L
SET STS = "C"
WHERE L.STS <> "H" AND  (SELECT COUNT(*) FROM VNAS_SCHEDULE) <> 0 AND 
NOT EXISTS
  (SELECT S.REC_CDC_NUM FROM VNAS_SCHEDULE S
  WHERE  S.STS <> "H" AND 
         S.NK_CDC_NUM = MD5(CONCAT(L.CARE_GIVER_ID, L.CLIENT_ID, L.SCHEDULE_START_DT, L.SCHEDULE_START_TM,
        L.SCHEDULE_DURATION, L.CALENDAR_TYPE))   
  );
COMMIT;

#################################
#STEP#2 
#Reset VNAS SCHEDULE

DELETE FROM VNAS_SCHEDULE WHERE CURRENT_CALENDAR_IND <> "H";
COMMIT;
#################################

#STEP#3
#Move the calendar data from landing to the calendar table.

INSERT INTO VNAS_SCHEDULE
(STS,CARE_GIVER_ID,CLIENT_ID,
SCHEDULE_START_DTTM,
SCHEDULE_END_DTTM,
CALENDAR_TYPE,CARE_GIVER_TYPE,CARE_GIVER_FIRST_NME,CARE_GIVER_LAST_NME,
CARE_GIVER_OFFICE_PH,CARE_GIVER_MOBILE_PH,CLIENT_FIRST_NME, CLIENT_LAST_NME,
CLIENT_ADDRESS,CLIENT_CITY,CLIENT_STATE,CLIENT_ZIP, CLIENT_PHONE, COMMENTS,CREATE_TSP, 
current_calendar_ind, REC_CDC_NUM,NK_CDC_NUM)

SELECT
L.STS, L.CARE_GIVER_ID,L.CLIENT_ID,
STR_TO_DATE(Concat(L.SCHEDULE_START_DT,' ', L.SCHEDULE_START_TM),'%Y-%m-%d %H:%i:%s') AS SCHEDULE_START_DTTM,
STR_TO_DATE(Concat(L.SCHEDULE_START_DT,' ', L.SCHEDULE_START_TM),'%Y-%m-%d %H:%i:%s') + INTERVAL L.SCHEDULE_DURATION MINUTE AS SCHEDULE_END_DTTM,
L.CALENDAR_TYPE,L.CARE_GIVER_TYPE,L.CARE_GIVER_FIRST_NME,
L.CARE_GIVER_LAST_NME,L.CARE_GIVER_OFFICE_PH,L.CARE_GIVER_MOBILE_PH,L.CLIENT_FIRST_NME,L.CLIENT_LAST_NME,
L.CLIENT_ADDRESS,L.CLIENT_CITY,L.CLIENT_STATE,
L.CLIENT_ZIP,L.CLIENT_PHONE,
L.COMMENTS,
now() AS CREATE_TSP, 
"X" AS CURRENT_CALENDAR_IND ,L.CDC_NUM REC_CDC_NUM,
MD5(CONCAT(L.CARE_GIVER_ID, L.CLIENT_ID, L.SCHEDULE_START_DT, SCHEDULE_START_TM, SCHEDULE_DURATION, CALENDAR_TYPE)) NK_CDC_NUM
 FROM VNAS_SCHEDULE_LANDING AS L
 WHERE L.CDC_NUM NOT IN
      (SELECT
 S.REC_CDC_NUM FROM VNAS_SCHEDULE S);

COMMIT;
#####################################

#STEP#4:
#Set the new record currnt_ind to 'Y'

UPDATE VNAS_SCHEDULE L
SET L.CURRENT_CALENDAR_IND = "Y"
where L.CURRENT_CALENDAR_IND = "X";
COMMIT;

##################################

##################################

#STEP#5:
# SET THE OLD ARCHIVED RECORD CURRENT_IND TO 'N' this is a versioning logical delete.

update VNAS_SCHEDULE S
  inner join
      (SELECT NK_CDC_NUM, MAX(CREATE_TSP) as max_create_tsp
          FROM VNAS_SCHEDULE 
            WHERE STS = "H"
              GROUP BY NK_CDC_NUM) AA
   on S.NK_CDC_NUM = AA.NK_CDC_NUM and
      S.CREATE_TSP < AA.max_create_tsp
  set S.CURRENT_CALENDAR_IND ='N';
COMMIT;

#####################################
#AT THIS POINT THE NEW LANDING DATA HAS BEEN LOADED AND AUDITED ONTO THE 
#SCHEDULE TABLE.
commit;

#STEP#6
#VNAS_GEN_REF load.

insert into VNAS_GEN_REF 
(gen_ref_nme, gen_Ref_desc)

select a.gen_ref_nme,a.gen_ref_desc
from 
(
SELECT "PERSON_PARTY_TYPE" gen_ref_nme, "CARE_GIVER" gen_ref_desc FROM DUAL
UNION
SELECT "PERSON_PARTY_TYPE", "CLIENT" FROM DUAL
UNION
SELECT DISTINCT "PARTY_ROLE", CARE_GIVER_TYPE FROM VNAS_SCHEDULE
where CARE_GIVER_TYPE <> 'CARE_GIVER_TYPE'
UNION 
SELECT "PARTY_ROLE","PATIENT" FROM DUAL
UNION 
SELECT "SYSTEM_ROLE","USER ADMINISTRATOR" FROM DUAL
UNION
SELECT DISTINCT "CALENDAR", CALENDAR_TYPE FROM VNAS_SCHEDULE
WHERE CALENDAR_TYPE <> 'CALENDAR_TYPE'
    ) a
 where md5(concat(a.gen_ref_nme, a.gen_ref_desc)) not in
        (select md5(concat(b.gen_ref_nme, b.gen_ref_desc))
               from VNAS_GEN_REF b );
COMMIT;
UPDATE VNAS_GEN_REF SET CLIENT_IND = 1 
       WHERE GEN_REF_DESC = 'CLIENT';
COMMIT;
UPDATE VNAS_GEN_REF SET CLIENT_IND = 0 
       WHERE GEN_REF_DESC <> 'CLIENT'
             AND CLIENT_IND IS NULL;
COMMIT;

##########################

#STEP#7
#VNAS_VNA_USER_REL Load.

#CLIENTS
insert into VNAS_VNA_USER_REL
(vna_user_id, vna_user_role_cd,vna_user_type_cd,effective_dt)

SELECT DISTINCT S.CLIENT_ID AS VNA_USER_ID, 
                PTY_TYP.GEN_REF_ID AS PARTY_ROLE_CD, 
                PTY_TYP.GEN_REF_ID AS PARTY_TYPE_CD,
                date(SYSDATE()) AS EFFECTIVE_DT
                FROM VNAS_SCHEDULE S, VNAS_GEN_REF PTY_TYP
WHERE S.CURRENT_CALENDAR_IND = "Y" AND
      PTY_TYP.GEN_REF_DESC = 'CLIENT' AND
   NOT EXISTS
( SELECT 1
       FROM VNAS_VNA_USER_REL R
    WHERE S.CLIENT_ID = R.VNA_USER_ID AND
          PTY_TYP.GEN_REF_ID = R.VNA_USER_ROLE_CD AND
          PTY_TYP.GEN_REF_ID = R.VNA_USER_TYPE_CD
);

COMMIT;

#CARE_GIVERS
insert into VNAS_VNA_USER_REL
(vna_user_id, vna_user_role_cd,vna_user_type_cd,effective_dt)

SELECT DISTINCT S.CARE_GIVER_ID AS VNA_USER_ID, 
                PTY_RLE.GEN_REF_ID AS PARTY_ROLE_CD, 
                PTY_TYP.GEN_REF_ID AS PARTY_TYPE_CD,
                date(SYSDATE()) AS EFFECTIVE_DT
                FROM VNAS_SCHEDULE S, VNAS_GEN_REF PTY_TYP, VNAS_GEN_REF PTY_RLE
WHERE S.CURRENT_CALENDAR_IND = "Y" AND
      PTY_TYP.GEN_REF_DESC = 'CARE_GIVER' AND
      S.CARE_GIVER_TYPE = PTY_RLE.GEN_REF_DESC AND
   NOT EXISTS 
( SELECT 1
       FROM VNAS_VNA_USER_REL R
     WHERE S.CARE_GIVER_ID = R.VNA_USER_ID AND
           PTY_RLE.GEN_REF_ID = R.VNA_USER_ROLE_CD AND
           PTY_TYP.GEN_REF_ID = R.VNA_USER_TYPE_CD
);
COMMIT;
#Audit old Relationship records



#####STEP 8 #####################################################################
#UPDATE ETL ERROR LOG TABLE.
INSERT INTO ETL_PROCESS_LOG 

(
LANDING_TBL_REC_CNT,
LANDING_TBL_DATE_RANGE,
CHANGED_CALENDAR_CNT,
ETL_PROCESS_STATUS,
ERROR_CNT,ERROR_DESC,
ERROR_CALENDAR_SK,
ERROR_CARE_GIVER_ID,
ERROR_CLIENT_ID,
ERROR_CALENDAR_TYPE,
REC_CDC_NUM
)
 SELECT 
LND.LANDING_TBL_REC_CNT, 
CONCAT(LND.MIN_START, " TO ", LND.MAX_START) LANDING_TABLE_DATE_RANGE,
CHG.CHANGED_CALENDAR_CNT, ERR_CNT.ERROR_CNT,
COALESCE(ERR_MSG.ERROR_DESC,"SUCCESS","ERROR") AS ETL_PROCESS_STATUS,
COALESCE(ERR_MSG.ERROR_DESC,"No Error to Report.") ERROR_DESC,
ERR_MSG.SCHEDULE_SK,
ERR_MSG.CARE_GIVER_ID,
ERR_MSG.CLIENT_ID,
ERR_MSG.CALENDAR_TYPE,
ERR_MSG.REC_CDC_NUM 
FROM 
(SELECT 1 AS JK, COUNT(*) AS LANDING_TBL_REC_CNT, MIN(SCHEDULE_START_DT) AS MIN_START, 
         MAX(SCHEDULE_START_DT) AS MAX_START  FROM VNAS_SCHEDULE_LANDING) LND
      LEFT OUTER JOIN 
(SELECT 1 AS JK, COUNT(*) AS CHANGED_CALENDAR_CNT FROM VNAS_SCHEDULE_LANDING WHERE STS = "C" ) CHG
ON LND.JK = CHG.JK
LEFT OUTER JOIN 
(
SELECT 1 AS JK,  COUNT(*) AS ERROR_CNT
FROM VNAS_SCHEDULE S
WHERE 
      S.CARE_GIVER_ID = NULL OR 
      S.CLIENT_ID = NULL OR
      S.SCHEDULE_START_DTTM >= S.SCHEDULE_END_DTTM  OR
      S.CALENDAR_TYPE = NULL OR
      CONCAT(S.CARE_GIVER_FIRST_NME,S.CARE_GIVER_LAST_NME) = NULL OR
      CONCAT(S.CLIENT_FIRST_NME,S.CLIENT_LAST_NME) = NULL OR
      S.STS = NULL
) ERR_CNT
ON LND.JK = ERR_CNT.JK
LEFT OUTER JOIN 
(
SELECT 1 AS JK,S.SCHEDULE_SK,S.CARE_GIVER_ID,S.CLIENT_ID,S.CALENDAR_TYPE,
      S.REC_CDC_NUM,
      CASE
      WHEN S.CARE_GIVER_ID = NULL 
          THEN concat('Missing CARE_GIVER_id Refer SCHEDULE_SK: ',S.SCHEDULE_SK)
      WHEN S.CLIENT_ID = NULL
          THEN concat('Missing Client_id Refer SCHEDULE_SK: ',S.SCHEDULE_SK)
      WHEN S.SCHEDULE_START_DTTM >= S.SCHEDULE_END_DTTM 
          THEN CONCAT('Schedule END_DATE is prior/equal to  SCHEDULE_START_DATE: SCHEDULE_SK:', S.SCHEDULE_SK)
      WHEN S.CALENDAR_TYPE = NULL
          THEN concat('Missing Calendar_Type Refer SCHEDULE_SK: ',S.SCHEDULE_SK)
      WHEN CONCAT(S.CARE_GIVER_FIRST_NME,S.CARE_GIVER_LAST_NME) = NULL
          THEN concat('Missing Care Giver Name Refer SCHEDULE_SK: ',S.SCHEDULE_SK)
      WHEN CONCAT(S.CLIENT_FIRST_NME,S.CLIENT_LAST_NME) = NULL
          THEN concat('Missing Client Name Refer SCHEDULE_SK: ',S.SCHEDULE_SK)
      WHEN S.STS = NULL
          THEN concat('Missing Calendar Status STS Refer SCHEDULE_SK: ',SCHEDULE_SK)
      END AS ERROR_DESC
FROM VNAS_SCHEDULE S 
WHERE 
     ( S.CARE_GIVER_ID = NULL OR 
      S.CLIENT_ID = NULL OR
      S.SCHEDULE_START_DTTM >= S.SCHEDULE_END_DTTM  OR
      S.CALENDAR_TYPE = NULL OR
      CONCAT(S.CARE_GIVER_FIRST_NME,S.CARE_GIVER_LAST_NME) = NULL OR
      CONCAT(S.CLIENT_FIRST_NME,S.CLIENT_LAST_NME) = NULL OR
      S.STS = NULL )
    AND 
    NOT EXISTS (SELECT DISTINCT LOG.REC_CDC_NUM FROM ETL_PROCESS_LOG LOG WHERE S.REC_CDC_NUM = LOG.REC_CDC_NUM )
) ERR_MSG
ON LND.JK = ERR_MSG.JK;

COMMIT;
##################################