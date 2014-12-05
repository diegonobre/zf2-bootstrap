-- DROP DATABASE zf2;
CREATE DATABASE zf2
  WITH OWNER = zf2
       ENCODING = 'UTF8'
       TABLESPACE = pg_default
       LC_COLLATE = 'pt_BR.UTF-8'
       LC_CTYPE = 'pt_BR.UTF-8'
       CONNECTION LIMIT = -1;

COMMENT ON DATABASE zf2 IS 'Database for default modules built on https://github.com/diegonobre/zf2-bootstrap';

CREATE ROLE zf2 WITH ENCRYPTED PASSWORD '123' LOGIN SUPERUSER;