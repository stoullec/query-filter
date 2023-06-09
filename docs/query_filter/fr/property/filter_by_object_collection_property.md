SELECT *
FROM person_type
WHERE person_type.director IN (
	SELECT id
	FROM director
	WHERE director.last_name = "TOULLEC"
);