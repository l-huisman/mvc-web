<?php

class SessionRepository extends BaseRepository
{

    public function addAvailabillity($data, $user_ID)
    {
        // Prepare the SQL statement for inserting the date
        $date_sql = "INSERT INTO Date (date) VALUES (:date)";
        $date_stmt = $this->connection->prepare($date_sql);

        // Prepare the SQL statement for inserting the timeblock
        $timeblock_sql = "INSERT INTO Timeblock (time, User_ID) VALUES (:time, :User_ID)";
        $timeblock_stmt = $this->connection->prepare($timeblock_sql);
        $timeblock_stmt->bindParam(":User_ID", $user_ID);

        // Prepare the SQL statement for updating the date with the timeblock
        $updateDate_sql = "UPDATE Date SET Timeblock_ID = :Timeblock_ID WHERE Date_ID = :Date_ID";
        $updateDate_stmt = $this->connection->prepare($updateDate_sql);

        // Iterate through the data array
        foreach ($data as $avail) {
            $date_stmt->bindParam(":date", $avail['date']);
            $date_stmt->execute();
            $date_id = $this->connection->lastInsertId();

            $timeblock_stmt->bindParam(":time", $avail['time']);
            $timeblock_stmt->execute();
            $timeblock_id = $this->connection->lastInsertId();

            $updateDate_stmt->bindParam(":Timeblock_ID", $timeblock_id);
            $updateDate_stmt->bindParam(":Date_ID", $date_id);
            $updateDate_stmt->execute();
        }
    }

    public function mostEnteredDates()
    {
        $sql = "SELECT Date.date, Timeblock.time, COUNT(Date.date) AS count 
                FROM Timeblock 
                JOIN Date ON Timeblock.Timeblock_ID = Date.Timeblock_ID 
                GROUP BY Date.date 
                ORDER BY count DESC 
                LIMIT 5";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    

    public function chooseSession($date, $time)
    {# into the Session table insert date and timeblock
        $sql = "INSERT INTO Session (date, time) VALUES (:date, :time)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":time", $time);
        $stmt->execute();

    }
}
