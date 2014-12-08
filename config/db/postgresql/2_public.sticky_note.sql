-- DROP TABLE public.sticky_note;
CREATE TABLE public.sticky_note
(
  sq_sticky_note serial NOT NULL,
  ds_note TEXT,
  dt_created timestamp without time zone NOT NULL DEFAULT now(),
  CONSTRAINT pk_public_sticky_note PRIMARY KEY (sq_sticky_note)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sticky_note OWNER TO zf2;

INSERT INTO public.sticky_note (ds_note) VALUES ('This is a note! :P');