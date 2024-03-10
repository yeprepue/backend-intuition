PGDMP     ;    
        	        |            intuitiondb    15.2    15.2 9    =           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            >           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            ?           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            @           1262    197022    intuitiondb    DATABASE     �   CREATE DATABASE intuitiondb WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Colombia.1252';
    DROP DATABASE intuitiondb;
                postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
                pg_database_owner    false            A           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                   pg_database_owner    false    4            �            1259    197049    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false    4            �            1259    197048    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    4    220            B           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    219            �            1259    197024 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false    4            �            1259    197023    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    4    215            C           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    214            �            1259    197041    password_resets    TABLE     �   CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 #   DROP TABLE public.password_resets;
       public         heap    postgres    false    4            �            1259    197061    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 *   DROP TABLE public.personal_access_tokens;
       public         heap    postgres    false    4            �            1259    197060    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    222    4            D           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    221            �            1259    197073 	   questions    TABLE     �   CREATE TABLE public.questions (
    id bigint NOT NULL,
    question_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.questions;
       public         heap    postgres    false    4            �            1259    197072    questions_id_seq    SEQUENCE     y   CREATE SEQUENCE public.questions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.questions_id_seq;
       public          postgres    false    4    224            E           0    0    questions_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.questions_id_seq OWNED BY public.questions.id;
          public          postgres    false    223            �            1259    197098    user_answers    TABLE     �   CREATE TABLE public.user_answers (
    id bigint NOT NULL,
    id_user bigint NOT NULL,
    id_question bigint NOT NULL,
    answer text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
     DROP TABLE public.user_answers;
       public         heap    postgres    false    4            �            1259    197097    user_answers_id_seq    SEQUENCE     |   CREATE SEQUENCE public.user_answers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.user_answers_id_seq;
       public          postgres    false    226    4            F           0    0    user_answers_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.user_answers_id_seq OWNED BY public.user_answers.id;
          public          postgres    false    225            �            1259    197031    users    TABLE     -  CREATE TABLE public.users (
    id bigint NOT NULL,
    firstname character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    lastname character varying(255) NOT NULL,
    phone character varying(255) NOT NULL,
    country character varying(255) NOT NULL,
    role character varying(255) NOT NULL
);
    DROP TABLE public.users;
       public         heap    postgres    false    4            �            1259    197030    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    217    4            G           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    216            �           2604    197052    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    220    219    220            �           2604    197027    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    214    215            �           2604    197064    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    221    222            �           2604    197076    questions id    DEFAULT     l   ALTER TABLE ONLY public.questions ALTER COLUMN id SET DEFAULT nextval('public.questions_id_seq'::regclass);
 ;   ALTER TABLE public.questions ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    224    224            �           2604    197101    user_answers id    DEFAULT     r   ALTER TABLE ONLY public.user_answers ALTER COLUMN id SET DEFAULT nextval('public.user_answers_id_seq'::regclass);
 >   ALTER TABLE public.user_answers ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    226    226            �           2604    197034    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    216    217            4          0    197049    failed_jobs 
   TABLE DATA                 public          postgres    false    220   �A       /          0    197024 
   migrations 
   TABLE DATA                 public          postgres    false    215   �A       2          0    197041    password_resets 
   TABLE DATA                 public          postgres    false    218   �B       6          0    197061    personal_access_tokens 
   TABLE DATA                 public          postgres    false    222   �B       8          0    197073 	   questions 
   TABLE DATA                 public          postgres    false    224   �B       :          0    197098    user_answers 
   TABLE DATA                 public          postgres    false    226   �C       1          0    197031    users 
   TABLE DATA                 public          postgres    false    217   nD       H           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    219            I           0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 7, true);
          public          postgres    false    214            J           0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          postgres    false    221            K           0    0    questions_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.questions_id_seq', 8, true);
          public          postgres    false    223            L           0    0    user_answers_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.user_answers_id_seq', 20, true);
          public          postgres    false    225            M           0    0    users_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.users_id_seq', 15, true);
          public          postgres    false    216            �           2606    197057    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    220            �           2606    197059 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    220            �           2606    197029    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    215            �           2606    197047 $   password_resets password_resets_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.password_resets
    ADD CONSTRAINT password_resets_pkey PRIMARY KEY (email);
 N   ALTER TABLE ONLY public.password_resets DROP CONSTRAINT password_resets_pkey;
       public            postgres    false    218            �           2606    197068 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    222            �           2606    197071 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    222            �           2606    197078    questions questions_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.questions
    ADD CONSTRAINT questions_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.questions DROP CONSTRAINT questions_pkey;
       public            postgres    false    224            �           2606    197105    user_answers user_answers_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.user_answers
    ADD CONSTRAINT user_answers_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.user_answers DROP CONSTRAINT user_answers_pkey;
       public            postgres    false    226            �           2606    197040    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    217            �           2606    197038    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    217            �           1259    197069 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    222    222            �           2606    197111 -   user_answers user_answers_id_question_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.user_answers
    ADD CONSTRAINT user_answers_id_question_foreign FOREIGN KEY (id_question) REFERENCES public.questions(id);
 W   ALTER TABLE ONLY public.user_answers DROP CONSTRAINT user_answers_id_question_foreign;
       public          postgres    false    226    224    3227            �           2606    197106 )   user_answers user_answers_id_user_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.user_answers
    ADD CONSTRAINT user_answers_id_user_foreign FOREIGN KEY (id_user) REFERENCES public.users(id);
 S   ALTER TABLE ONLY public.user_answers DROP CONSTRAINT user_answers_id_user_foreign;
       public          postgres    false    226    3214    217            4   
   x���          /   �   x���=o�0�=��EB��Z�:u`���Th��%\��&�#�~� i�(n�����|�Y�mE�޾�CS����W_c�k/���Fܩ��h�,(	J����04L�!b�h2j���P�GU= �ɇb�cxs�@.��=�+G;����^�m{�յ���FX�ĉ�?T�Iy�Rt�M;�TZZ{I96���+�Ï�`c��6k>�.���m���Ť�?�Mf��43�]      2   
   x���          6   
   x���          8   �   x����
�0E����UA%��:.��BAlu�H@m��o��Lw>��Y�s�7[�uٲX���Nj?���X�+�t���Љz.�Q�0�7]+�'�G�0�'�O )CF���8�ژ��O�Y$�wG�`�Q�^1%@(r�,n�>��V+��*BPD?$C��$i�8YYm }��-TY�����?vk��#�]<1�k�      :   �   x���v
Q���W((M��L�+-N-�O�+.O-*Vs�	uV�04�Q04�Q0�QPwN,NT�FF&�ƺ�
FV��V�f��5��<���b�!Ш����|Ze
�ʄV�A����U�@�L!Q唟�_�-�̭L��&�.�]����b�	�22��eA�]\\ �8Ղ      1   ^  x���[s�H���
/R�n�6͙�Y�CL< 
wZ�p�4��M��$��T����n�ǏnFڢ?7Z#��[y�ơG�a�2��h��i�s\"�i_Z��Ɣ�%��~�7 �hZf2�����(��r<n�Ɂ���?�����	���߻ѯ�.�=-�,=��έ���6�{X�����ޑh�~��)���@�})�mE�ғ%�YD[P��=5�02>���S�
�u��A�>5�,�7��X�����|�Bh�X>�[,�C��y��t���T�RЧLR�*��Ε+�g���@�i�}=�/��{���(�=����<F�z�rC�����ت�<<`�z��
�$�9/���U�l"�Ud{�j^R��jBr2�$|��i�>��gE������aL��'Ҡ�x^>7��'<�� ��
�ݽ�ltJ�qHχ�Fjl�uf�S���b��
�e�	�=�*(� u�S7��1fz��Co�Y8�+gj'�V���2��:��&3;�Q�X�1�I���Yz��Jz�6'!~[�ɹ��@���
(�ܕ-�F�)"}=�DS�t���r���Px�lF��H�I��� /3\�z���9���(~�!)��g���L=,*_���T��f��Ű�)]�����>u��^8�P��%���ۮQ>�Ur��
2#|�^b��+"(��k�l=lQ�H�V�x���a��A-tw���=���z<#*T��
��������gj�0cu��Օ*C��?��G��X}��yf%���/�s�קDi�|T'!A�C!����6��jgG��9I�B%j/u��a&/C�7��J�֢s�R�,'Gذ]��m���Y���������������w�     