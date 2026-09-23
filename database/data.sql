--
-- PostgreSQL database dump
--

\restrict tSxSgjVnCgCVNpkhA9ieq84ghvErQCTyXNHmF59LqDwtQHBOuQBQcSSwVbppEjF

-- Dumped from database version 17.11 (Debian 17.11-1.pgdg13+2)
-- Dumped by pg_dump version 17.11 (Debian 17.11-1.pgdg13+2)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: allergen; Type: TABLE DATA; Schema: public; Owner: vite_gourmand
--

INSERT INTO public.allergen (id, name) VALUES (7, 'Gluten');
INSERT INTO public.allergen (id, name) VALUES (8, 'Lait');
INSERT INTO public.allergen (id, name) VALUES (9, 'Œufs');
INSERT INTO public.allergen (id, name) VALUES (10, 'Fruits à coque');
INSERT INTO public.allergen (id, name) VALUES (11, 'Poisson');
INSERT INTO public.allergen (id, name) VALUES (12, 'Crustacés');


--
-- Data for Name: app_user; Type: TABLE DATA; Schema: public; Owner: vite_gourmand
--

INSERT INTO public.app_user (id, first_name, last_name, email, phone, postal_address, postal_code, city, password, roles, is_active, created_at, updated_at) VALUES (4, 'Admin', 'Vite & Gourmand', 'admin@vite-gourmand.fr', '0600000001', '10 rue Sainte-Catherine', '33000', 'Bordeaux', '$2y$13$INwSHFYh2RZs./nc/fuiMekEceyrBy8fgY5Uo2hVcfUFS1Xb2v3f6', '["ROLE_ADMIN"]', true, '2026-09-23 16:36:14', '2026-09-23 16:36:14');
INSERT INTO public.app_user (id, first_name, last_name, email, phone, postal_address, postal_code, city, password, roles, is_active, created_at, updated_at) VALUES (5, 'Julie', 'Martin', 'employe@vite-gourmand.fr', '0600000002', '12 rue du Parlement', '33000', 'Bordeaux', '$2y$13$WMNpmE.G7d.C.RPLbGM43.63iq6u3Bf3n1xiYQ1.vZ2TfziIEgsQu', '["ROLE_EMPLOYEE"]', true, '2026-09-23 16:36:15', '2026-09-23 16:36:15');
INSERT INTO public.app_user (id, first_name, last_name, email, phone, postal_address, postal_code, city, password, roles, is_active, created_at, updated_at) VALUES (6, 'Client', 'Demo', 'client@vite-gourmand.fr', '0600000003', '25 cours Victor Hugo', '33000', 'Bordeaux', '$2y$13$DdDbdg2rRGXJbfnjAX.TY.Ny44t.7K3ALd9oyHMyDP2Hzg4NWoLey', '["ROLE_USER"]', true, '2026-09-23 16:36:15', '2026-09-23 16:36:15');


--
-- Data for Name: menu; Type: TABLE DATA; Schema: public; Owner: vite_gourmand
--

INSERT INTO public.menu (id, title, description, conditions, minimum_people, base_price_cents, available_stock, theme, diet, is_active, created_at, updated_at) VALUES (4, 'Menu Tradition', 'Une sélection inspirée de la cuisine traditionnelle bordelaise.', 'Commande à effectuer au minimum 48 heures à l’avance.', 4, 3500, 20, 'Traditionnel', 'Classique', true, '2026-09-23 16:36:16', '2026-09-23 16:36:16');
INSERT INTO public.menu (id, title, description, conditions, minimum_people, base_price_cents, available_stock, theme, diet, is_active, created_at, updated_at) VALUES (5, 'Menu Élégance', 'Un menu raffiné pour les repas et événements.', 'Commande à effectuer au minimum 72 heures à l’avance.', 6, 4500, 15, 'Gastronomique', 'Classique', true, '2026-09-23 16:36:16', '2026-09-23 16:36:16');
INSERT INTO public.menu (id, title, description, conditions, minimum_people, base_price_cents, available_stock, theme, diet, is_active, created_at, updated_at) VALUES (6, 'Menu Végétal', 'Une proposition sans viande autour des produits de saison.', 'Commande à effectuer au minimum 48 heures à l’avance.', 4, 2900, 20, 'Saison', 'Végétarien', true, '2026-09-23 16:36:16', '2026-09-23 16:36:16');


--
-- Data for Name: customer_order; Type: TABLE DATA; Schema: public; Owner: vite_gourmand
--



--
-- Data for Name: dish; Type: TABLE DATA; Schema: public; Owner: vite_gourmand
--

INSERT INTO public.dish (id, name, description, course_type, created_at, updated_at) VALUES (7, 'Foie gras maison', 'Foie gras maison accompagné de pain toasté.', 'Entrée', '2026-09-23 16:36:16', '2026-09-23 16:36:16');
INSERT INTO public.dish (id, name, description, course_type, created_at, updated_at) VALUES (8, 'Saumon rôti aux herbes', 'Saumon rôti accompagné de légumes de saison.', 'Plat', '2026-09-23 16:36:16', '2026-09-23 16:36:16');
INSERT INTO public.dish (id, name, description, course_type, created_at, updated_at) VALUES (9, 'Bœuf sauce bordelaise', 'Pièce de bœuf et sauce bordelaise, accompagnée de pommes grenailles.', 'Plat', '2026-09-23 16:36:16', '2026-09-23 16:36:16');
INSERT INTO public.dish (id, name, description, course_type, created_at, updated_at) VALUES (10, 'Risotto aux légumes', 'Risotto crémeux aux légumes de saison.', 'Plat', '2026-09-23 16:36:16', '2026-09-23 16:36:16');
INSERT INTO public.dish (id, name, description, course_type, created_at, updated_at) VALUES (11, 'Tarte aux pommes', 'Tarte aux pommes traditionnelle.', 'Dessert', '2026-09-23 16:36:16', '2026-09-23 16:36:16');
INSERT INTO public.dish (id, name, description, course_type, created_at, updated_at) VALUES (12, 'Fondant au chocolat', 'Fondant au chocolat servi avec une crème légère.', 'Dessert', '2026-09-23 16:36:16', '2026-09-23 16:36:16');


--
-- Data for Name: dish_allergen; Type: TABLE DATA; Schema: public; Owner: vite_gourmand
--

INSERT INTO public.dish_allergen (dish_id, allergen_id) VALUES (7, 7);
INSERT INTO public.dish_allergen (dish_id, allergen_id) VALUES (8, 11);
INSERT INTO public.dish_allergen (dish_id, allergen_id) VALUES (10, 8);
INSERT INTO public.dish_allergen (dish_id, allergen_id) VALUES (11, 7);
INSERT INTO public.dish_allergen (dish_id, allergen_id) VALUES (11, 8);
INSERT INTO public.dish_allergen (dish_id, allergen_id) VALUES (11, 9);
INSERT INTO public.dish_allergen (dish_id, allergen_id) VALUES (12, 7);
INSERT INTO public.dish_allergen (dish_id, allergen_id) VALUES (12, 8);
INSERT INTO public.dish_allergen (dish_id, allergen_id) VALUES (12, 9);


--
-- Data for Name: menu_dish; Type: TABLE DATA; Schema: public; Owner: vite_gourmand
--

INSERT INTO public.menu_dish (menu_id, dish_id) VALUES (4, 7);
INSERT INTO public.menu_dish (menu_id, dish_id) VALUES (4, 9);
INSERT INTO public.menu_dish (menu_id, dish_id) VALUES (4, 11);
INSERT INTO public.menu_dish (menu_id, dish_id) VALUES (5, 7);
INSERT INTO public.menu_dish (menu_id, dish_id) VALUES (5, 8);
INSERT INTO public.menu_dish (menu_id, dish_id) VALUES (5, 12);
INSERT INTO public.menu_dish (menu_id, dish_id) VALUES (6, 10);
INSERT INTO public.menu_dish (menu_id, dish_id) VALUES (6, 11);


--
-- Data for Name: menu_image; Type: TABLE DATA; Schema: public; Owner: vite_gourmand
--



--
-- Data for Name: opening_hour; Type: TABLE DATA; Schema: public; Owner: vite_gourmand
--

INSERT INTO public.opening_hour (id, day_of_week, morning_open, morning_close, afternoon_open, afternoon_close, is_closed) VALUES (8, 1, '09:00:00', '13:00:00', '14:00:00', '18:00:00', false);
INSERT INTO public.opening_hour (id, day_of_week, morning_open, morning_close, afternoon_open, afternoon_close, is_closed) VALUES (9, 2, '09:00:00', '13:00:00', '14:00:00', '18:00:00', false);
INSERT INTO public.opening_hour (id, day_of_week, morning_open, morning_close, afternoon_open, afternoon_close, is_closed) VALUES (10, 3, '09:00:00', '13:00:00', '14:00:00', '18:00:00', false);
INSERT INTO public.opening_hour (id, day_of_week, morning_open, morning_close, afternoon_open, afternoon_close, is_closed) VALUES (11, 4, '09:00:00', '13:00:00', '14:00:00', '18:00:00', false);
INSERT INTO public.opening_hour (id, day_of_week, morning_open, morning_close, afternoon_open, afternoon_close, is_closed) VALUES (12, 5, '09:00:00', '13:00:00', '14:00:00', '18:00:00', false);
INSERT INTO public.opening_hour (id, day_of_week, morning_open, morning_close, afternoon_open, afternoon_close, is_closed) VALUES (13, 6, '09:00:00', '13:00:00', '14:00:00', '18:00:00', false);
INSERT INTO public.opening_hour (id, day_of_week, morning_open, morning_close, afternoon_open, afternoon_close, is_closed) VALUES (14, 7, NULL, NULL, NULL, NULL, true);


--
-- Data for Name: order_contact_log; Type: TABLE DATA; Schema: public; Owner: vite_gourmand
--



--
-- Data for Name: order_status_history; Type: TABLE DATA; Schema: public; Owner: vite_gourmand
--



--
-- Data for Name: review; Type: TABLE DATA; Schema: public; Owner: vite_gourmand
--



--
-- Name: allergen_id_seq; Type: SEQUENCE SET; Schema: public; Owner: vite_gourmand
--

SELECT pg_catalog.setval('public.allergen_id_seq', 12, true);


--
-- Name: app_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: vite_gourmand
--

SELECT pg_catalog.setval('public.app_user_id_seq', 6, true);


--
-- Name: customer_order_id_seq; Type: SEQUENCE SET; Schema: public; Owner: vite_gourmand
--

SELECT pg_catalog.setval('public.customer_order_id_seq', 1, false);


--
-- Name: dish_id_seq; Type: SEQUENCE SET; Schema: public; Owner: vite_gourmand
--

SELECT pg_catalog.setval('public.dish_id_seq', 12, true);


--
-- Name: menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: vite_gourmand
--

SELECT pg_catalog.setval('public.menu_id_seq', 6, true);


--
-- Name: menu_image_id_seq; Type: SEQUENCE SET; Schema: public; Owner: vite_gourmand
--

SELECT pg_catalog.setval('public.menu_image_id_seq', 1, false);


--
-- Name: opening_hour_id_seq; Type: SEQUENCE SET; Schema: public; Owner: vite_gourmand
--

SELECT pg_catalog.setval('public.opening_hour_id_seq', 14, true);


--
-- Name: order_contact_log_id_seq; Type: SEQUENCE SET; Schema: public; Owner: vite_gourmand
--

SELECT pg_catalog.setval('public.order_contact_log_id_seq', 1, false);


--
-- Name: order_status_history_id_seq; Type: SEQUENCE SET; Schema: public; Owner: vite_gourmand
--

SELECT pg_catalog.setval('public.order_status_history_id_seq', 1, false);


--
-- Name: review_id_seq; Type: SEQUENCE SET; Schema: public; Owner: vite_gourmand
--

SELECT pg_catalog.setval('public.review_id_seq', 1, false);


--
-- PostgreSQL database dump complete
--

\unrestrict tSxSgjVnCgCVNpkhA9ieq84ghvErQCTyXNHmF59LqDwtQHBOuQBQcSSwVbppEjF

