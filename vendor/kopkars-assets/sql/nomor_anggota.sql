-- can't query pg_type because type might exist in other schemas
-- no IF NOT EXISTS for CREATE DOMAIN, need to catch exception
DO $$ BEGIN
  CREATE DOMAIN NOMOR_ANGGOTA as varchar(8);
EXCEPTION
  WHEN duplicate_object THEN null;
END $$;