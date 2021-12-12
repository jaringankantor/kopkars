CREATE OR REPLACE FUNCTION random_text(integer) RETURNS TEXT AS
$BODY$
SELECT array_to_string(array(
  SELECT SUBSTRING('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ' 
    FROM floor(random()*36)::int+1 FOR 1)
FROM generate_series(1, $1)), '');
$BODY$
LANGUAGE SQL;