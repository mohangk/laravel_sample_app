--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: metrics; Type: TABLE; Schema: public; Owner: vagrant; Tablespace: 
--

CREATE TABLE metrics (
    id integer NOT NULL,
    site_id character varying(255) NOT NULL,
    date date NOT NULL,
    type character varying(255) NOT NULL,
    count integer NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL
);


ALTER TABLE public.metrics OWNER TO vagrant;

--
-- Name: metrics_id_seq; Type: SEQUENCE; Schema: public; Owner: vagrant
--

CREATE SEQUENCE metrics_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.metrics_id_seq OWNER TO vagrant;

--
-- Name: metrics_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: vagrant
--

ALTER SEQUENCE metrics_id_seq OWNED BY metrics.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: vagrant; Tablespace: 
--

CREATE TABLE migrations (
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO vagrant;

--
-- Name: users; Type: TABLE; Schema: public; Owner: vagrant; Tablespace: 
--

CREATE TABLE users (
    id integer NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL,
    google_access_token character varying(255),
    google_access_token_expires_at timestamp without time zone,
    "google_photoURL" character varying(255)
);


ALTER TABLE public.users OWNER TO vagrant;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: vagrant
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO vagrant;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: vagrant
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: vagrant
--

ALTER TABLE ONLY metrics ALTER COLUMN id SET DEFAULT nextval('metrics_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: vagrant
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Data for Name: metrics; Type: TABLE DATA; Schema: public; Owner: vagrant
--

COPY metrics (id, site_id, date, type, count, created_at, updated_at) FROM stdin;
1	ga:123	2013-08-21	ga:pageviews	39	2013-08-21 07:42:39	2013-08-21 07:42:39
2	ga:123	2013-08-21	ga:visitors	8	2013-08-21 07:42:39	2013-08-21 07:42:39
3	ga:123	2013-08-20	ga:pageviews	24	2013-08-21 07:42:39	2013-08-21 07:42:39
4	ga:123	2013-08-20	ga:visitors	19	2013-08-21 07:42:39	2013-08-21 07:42:39
5	ga:123	2013-08-19	ga:pageviews	49	2013-08-21 07:42:39	2013-08-21 07:42:39
6	ga:123	2013-08-19	ga:visitors	5	2013-08-21 07:42:39	2013-08-21 07:42:39
7	ga:123	2013-08-18	ga:pageviews	10	2013-08-21 07:42:39	2013-08-21 07:42:39
8	ga:123	2013-08-18	ga:visitors	4	2013-08-21 07:42:39	2013-08-21 07:42:39
9	ga:123	2013-08-17	ga:pageviews	34	2013-08-21 07:42:39	2013-08-21 07:42:39
10	ga:123	2013-08-17	ga:visitors	30	2013-08-21 07:42:39	2013-08-21 07:42:39
11	ga:123	2013-08-16	ga:pageviews	39	2013-08-21 07:42:39	2013-08-21 07:42:39
12	ga:123	2013-08-16	ga:visitors	2	2013-08-21 07:42:39	2013-08-21 07:42:39
13	ga:123	2013-08-15	ga:pageviews	40	2013-08-21 07:42:39	2013-08-21 07:42:39
14	ga:123	2013-08-15	ga:visitors	22	2013-08-21 07:42:39	2013-08-21 07:42:39
15	ga:123	2013-08-14	ga:pageviews	31	2013-08-21 07:42:39	2013-08-21 07:42:39
16	ga:123	2013-08-14	ga:visitors	20	2013-08-21 07:42:39	2013-08-21 07:42:39
17	ga:123	2013-08-13	ga:pageviews	46	2013-08-21 07:42:39	2013-08-21 07:42:39
18	ga:123	2013-08-13	ga:visitors	30	2013-08-21 07:42:39	2013-08-21 07:42:39
19	ga:123	2013-08-12	ga:pageviews	24	2013-08-21 07:42:39	2013-08-21 07:42:39
20	ga:123	2013-08-12	ga:visitors	14	2013-08-21 07:42:39	2013-08-21 07:42:39
21	ga:123	2013-08-11	ga:pageviews	23	2013-08-21 07:42:39	2013-08-21 07:42:39
22	ga:123	2013-08-11	ga:visitors	8	2013-08-21 07:42:39	2013-08-21 07:42:39
23	ga:123	2013-08-10	ga:pageviews	12	2013-08-21 07:42:39	2013-08-21 07:42:39
24	ga:123	2013-08-10	ga:visitors	7	2013-08-21 07:42:39	2013-08-21 07:42:39
25	ga:123	2013-08-09	ga:pageviews	22	2013-08-21 07:42:39	2013-08-21 07:42:39
26	ga:123	2013-08-09	ga:visitors	7	2013-08-21 07:42:39	2013-08-21 07:42:39
27	ga:123	2013-08-08	ga:pageviews	34	2013-08-21 07:42:39	2013-08-21 07:42:39
28	ga:123	2013-08-08	ga:visitors	7	2013-08-21 07:42:39	2013-08-21 07:42:39
29	ga:123	2013-08-07	ga:pageviews	47	2013-08-21 07:42:39	2013-08-21 07:42:39
30	ga:123	2013-08-07	ga:visitors	30	2013-08-21 07:42:39	2013-08-21 07:42:39
31	ga:123	2013-08-06	ga:pageviews	28	2013-08-21 07:42:39	2013-08-21 07:42:39
32	ga:123	2013-08-06	ga:visitors	18	2013-08-21 07:42:39	2013-08-21 07:42:39
33	ga:123	2013-08-05	ga:pageviews	44	2013-08-21 07:42:39	2013-08-21 07:42:39
34	ga:123	2013-08-05	ga:visitors	35	2013-08-21 07:42:39	2013-08-21 07:42:39
35	ga:123	2013-08-04	ga:pageviews	26	2013-08-21 07:42:39	2013-08-21 07:42:39
36	ga:123	2013-08-04	ga:visitors	21	2013-08-21 07:42:39	2013-08-21 07:42:39
37	ga:123	2013-08-03	ga:pageviews	45	2013-08-21 07:42:39	2013-08-21 07:42:39
38	ga:123	2013-08-03	ga:visitors	19	2013-08-21 07:42:39	2013-08-21 07:42:39
39	ga:123	2013-08-02	ga:pageviews	15	2013-08-21 07:42:39	2013-08-21 07:42:39
40	ga:123	2013-08-02	ga:visitors	8	2013-08-21 07:42:39	2013-08-21 07:42:39
41	ga:123	2013-08-01	ga:pageviews	21	2013-08-21 07:42:39	2013-08-21 07:42:39
42	ga:123	2013-08-01	ga:visitors	18	2013-08-21 07:42:39	2013-08-21 07:42:39
43	ga:123	2013-07-31	ga:pageviews	30	2013-08-21 07:42:39	2013-08-21 07:42:39
44	ga:123	2013-07-31	ga:visitors	1	2013-08-21 07:42:39	2013-08-21 07:42:39
45	ga:123	2013-07-30	ga:pageviews	25	2013-08-21 07:42:39	2013-08-21 07:42:39
46	ga:123	2013-07-30	ga:visitors	1	2013-08-21 07:42:39	2013-08-21 07:42:39
47	ga:123	2013-07-29	ga:pageviews	37	2013-08-21 07:42:39	2013-08-21 07:42:39
48	ga:123	2013-07-29	ga:visitors	11	2013-08-21 07:42:39	2013-08-21 07:42:39
49	ga:123	2013-07-28	ga:pageviews	37	2013-08-21 07:42:39	2013-08-21 07:42:39
50	ga:123	2013-07-28	ga:visitors	1	2013-08-21 07:42:39	2013-08-21 07:42:39
51	ga:123	2013-07-27	ga:pageviews	44	2013-08-21 07:42:39	2013-08-21 07:42:39
52	ga:123	2013-07-27	ga:visitors	1	2013-08-21 07:42:39	2013-08-21 07:42:39
53	ga:123	2013-07-26	ga:pageviews	25	2013-08-21 07:42:39	2013-08-21 07:42:39
54	ga:123	2013-07-26	ga:visitors	23	2013-08-21 07:42:39	2013-08-21 07:42:39
55	ga:123	2013-07-25	ga:pageviews	33	2013-08-21 07:42:39	2013-08-21 07:42:39
56	ga:123	2013-07-25	ga:visitors	23	2013-08-21 07:42:39	2013-08-21 07:42:39
57	ga:123	2013-07-24	ga:pageviews	16	2013-08-21 07:42:39	2013-08-21 07:42:39
58	ga:123	2013-07-24	ga:visitors	4	2013-08-21 07:42:39	2013-08-21 07:42:39
59	ga:123	2013-07-23	ga:pageviews	45	2013-08-21 07:42:39	2013-08-21 07:42:39
60	ga:123	2013-07-23	ga:visitors	4	2013-08-21 07:42:39	2013-08-21 07:42:39
\.


--
-- Name: metrics_id_seq; Type: SEQUENCE SET; Schema: public; Owner: vagrant
--

SELECT pg_catalog.setval('metrics_id_seq', 60, true);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: vagrant
--

COPY migrations (migration, batch) FROM stdin;
2013_07_20_051135_create_users_table	1
2013_08_17_090002_create_metrics_table	1
2013_08_18_152504_add_google_attributes_to_users	1
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: vagrant
--

COPY users (id, email, password, name, created_at, updated_at, google_access_token, google_access_token_expires_at, "google_photoURL") FROM stdin;
1	mohan@example.com	$2y$08$fQwp.QIwgRy1T80hPjvZWuKq1sMYe.xljSNb/3ccpAL26Ahcj.Wd6	Mohan Krishnan	2013-08-21 07:42:39	2013-08-21 07:42:39	\N	\N	\N
2	tommy@example.com	$2y$08$NJyghJTcn.ztvnI8XqCG4OTYRTeKoSU./mstACpArKIo2iq8b8oqC	Tommy Sullivan	2013-08-21 07:42:39	2013-08-21 07:42:39	\N	\N	\N
3	zi@example.com	$2y$08$mKzXaaJduX/tpuII7MQoeek/PrVBiRcaVgIQgYoPuPIK1AvaSkkT2	Huong Vu	2013-08-21 07:42:39	2013-08-21 07:42:39	\N	\N	\N
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: vagrant
--

SELECT pg_catalog.setval('users_id_seq', 3, true);


--
-- Name: metrics_pkey; Type: CONSTRAINT; Schema: public; Owner: vagrant; Tablespace: 
--

ALTER TABLE ONLY metrics
    ADD CONSTRAINT metrics_pkey PRIMARY KEY (id);


--
-- Name: users_email_unique; Type: CONSTRAINT; Schema: public; Owner: vagrant; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: vagrant; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

