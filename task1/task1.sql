SELECT e.`emailaddress`
FROM `db`.`profiles` p INNER JOIN `db`.`emails` e ON p.`UserRefID` = e.`UserRefID`
WHERE e.`Default` = 1 AND p.`Deceased` = 0;