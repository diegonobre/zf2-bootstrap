-- DROP TABLE prototype.form_builder;
CREATE TABLE prototype.form_builder
(
  sq_form_builder serial NOT NULL,
  ds_name TEXT NOT NULL,
  ds_html_view TEXT,
  ds_html_source TEXT,
  dt_created timestamp without time zone NOT NULL DEFAULT now(),
  dt_last_update timestamp without time zone,
  CONSTRAINT pk_prototype_form_builder PRIMARY KEY (sq_form_builder)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE prototype.form_builder OWNER TO zf2;

INSERT INTO prototype.form_builder (ds_name) VALUES ('First Form');