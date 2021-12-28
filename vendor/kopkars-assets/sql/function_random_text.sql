CREATE OR REPLACE FUNCTION random_text(integer) RETURNS character varying(20) AS
$BODY$
DECLARE
   char1 TEXT;
   charnext TEXT;
BEGIN
SELECT INTO char1 array_to_string(array(
  SELECT SUBSTRING('123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' 
    FROM floor(random()*35)::int+1 FOR 1)
FROM generate_series(1, 1)), '');

SELECT INTO charnext array_to_string(array(
  SELECT SUBSTRING('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' 
    FROM floor(random()*36)::int+1 FOR 1)
FROM generate_series(1, $1-1)), '');

RETURN char1||charnext;

END;
$BODY$
LANGUAGE plpgsql;
