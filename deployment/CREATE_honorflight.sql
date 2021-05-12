create table guardian
(
    guardian_id             int unsigned auto_increment
        primary key,
    first_name              varchar(255) null,
    middle_initial          varchar(45)  null,
    last_name               varchar(255) null,
    gender                  varchar(45)  null,
    address                 varchar(255) null,
    city                    varchar(255) null,
    state                   varchar(45)  null,
    zip                     varchar(45)  null,
    nickname                varchar(45)  null,
    email                   varchar(45)  null,
    day_phone               varchar(45)  null,
    cell_phone              varchar(45)  null,
    dob                     date         null,
    occupation              varchar(255) null,
    veteran                 tinyint(1)   null comment 'Are you a veteran?',
    branch                  tinytext     null comment 'If a veteran, branch, when and where you served',
    how_heard               tinytext     null comment 'How did you hear of Honor Flight?',
    why_volunteering        tinytext     null comment 'Please state why you are volunteering',
    prior_experience        tinytext     null comment 'Prior volunteer experience',
    ref_name                varchar(255) null,
    ref_day_phone           varchar(45)  null,
    ref_evening_phone       varchar(45)  null,
    ref_address             tinytext     null,
    ref_relationship        varchar(255) null,
    ref_email               varchar(255) null,
    emergency_name          varchar(255) null,
    emergency_relationship  varchar(255) null,
    emergency_address       tinytext     null,
    emergency_day_phone     varchar(45)  null,
    emergency_evening_phone varchar(45)  null,
    emergency_cell_phone    varchar(45)  null,
    particular_veteran      tinyint(1)   null comment 'Are you requesting to travel with a particular veteran? ',
    vet_name                varchar(255) null,
    vet_relationship        varchar(255) null,
    shirt_size              varchar(45)  null,
    push_veteran            tinyint(1)   null,
    med_training            text         null comment 'Medication experience or training, e.g. EMT, CPR etc',
    med_conditions          text         null comment 'Please idfentify any physical disabilities, restrictions, and/or medical conditions that could limit your duties as a guardian',
    app_date                date         null,
    diet_restrictions       varchar(255) null,
    administrative_comments varchar(45)  null,
    last_updated            datetime     null
)
    charset = utf8;

create table mission
(
    mission_id    int unsigned auto_increment
        primary key,
    title         varchar(45)          null,
    flight_num    varchar(45)          null,
    show_on_front tinyint(1) default 1 null,
    start_date    date                 null,
    end_date      date                 null
)
    comment 'A mission is considered one flight down the DC.' charset = utf8;

create table bus
(
    bus_id         int unsigned auto_increment
        primary key,
    mission_id     int unsigned not null,
    name           varchar(45)  null,
    leader_first   varchar(255) null,
    leader_last    varchar(255) null,
    leader_nametag varchar(45)  null,
    leader_phone   varchar(45)  null,
    leader_tee     varchar(45)  null,
    hs_first       varchar(255) null,
    hs_last        varchar(255) null,
    hs_nametag     varchar(45)  null,
    hs_phone       varchar(45)  null,
    hs_tee         varchar(45)  null,
    gl_first       varchar(255) null,
    gl_last        varchar(255) null,
    gl_nametag     varchar(45)  null,
    gl_phone       varchar(45)  null,
    gl_tee         varchar(45)  null,
    constraint mission_bus_fk
        foreign key (mission_id) references mission (mission_id)
            on update cascade on delete cascade
)
    charset = utf8;

create table flight
(
    flight_id          int auto_increment,
    mission_id         int(11) unsigned not null,
    arrival            datetime         null,
    departure          datetime         null,
    flight_number      varchar(45)      null,
    airline            varchar(45)      null,
    arrival_location   varchar(45)      null,
    departure_location varchar(45)      null,
    primary key (flight_id, mission_id),
    constraint flight_mission_mission_id_fk
        foreign key (mission_id) references mission (mission_id)
);

create index fk_flight_bus_book
    on flight (mission_id);

create table team
(
    team_id    int unsigned auto_increment
        primary key,
    mission_id int unsigned not null,
    bus_id     int unsigned null,
    leader_id  int unsigned null,
    hs_id      int unsigned null,
    color      varchar(45)  null,
    constraint bus_team_fk
        foreign key (bus_id) references bus (bus_id)
            on update cascade on delete set null,
    constraint hs_team_fk
        foreign key (hs_id) references guardian (guardian_id)
            on update cascade on delete cascade,
    constraint leader_team_fk
        foreign key (leader_id) references guardian (guardian_id)
            on update cascade on delete cascade,
    constraint mission_team_fk
        foreign key (mission_id) references mission (mission_id)
            on update cascade on delete cascade
)
    charset = utf8;

create table user
(
    iduser           int auto_increment
        primary key,
    user_type        varchar(45)  not null,
    user_permissions int          not null,
    username         varchar(45)  not null,
    password         varchar(100) not null,
    team_id          int          null,
    notes            varchar(255) null,
    first_name       varchar(50)  null,
    last_name        varchar(50)  null,
    day_phone        varchar(15)  null,
    cell_phone       varchar(15)  null,
    bus_id           int          null,
    room             varchar(50)  null
);

create table veteran
(
    veteran_id             int unsigned auto_increment
        primary key,
    guardian_id            int unsigned         null,
    guardian_relation      varchar(45)          null,
    team_id                int unsigned         null,
    mission_id             int unsigned         null,
    bus_id                 int unsigned         null,
    first_name             varchar(255)         null,
    middle_initial         varchar(45)          null,
    last_name              varchar(255)         null,
    nickname               varchar(255)         null,
    gender                 varchar(45)          null,
    address                varchar(255)         null,
    city                   varchar(255)         null,
    state                  varchar(255)         null,
    zip                    varchar(45)          null,
    email                  varchar(255)         null,
    day_phone              varchar(45)          null,
    cell_phone             varchar(45)          null,
    dob                    date                 null,
    weight                 int                  null,
    how_heard              tinytext             null,
    shirt_size             varchar(45)          null,
    alt_name               varchar(255)         null,
    alt_phone              varchar(45)          null,
    alt_email              varchar(255)         null,
    alt_relationship       varchar(45)          null,
    emergency_name         varchar(255)         null,
    emergency_relationship varchar(45)          null,
    emergency_address      varchar(255)         null,
    emergency_day_phone    varchar(45)          null,
    emergency_cell_phone   varchar(45)          null,
    service_branch         varchar(255)         null,
    service_rank           varchar(255)         null,
    service_years          varchar(50)          null,
    service_ww2            tinyint(1)           null,
    service_korea          tinyint(1)           null,
    service_cold_war       tinyint(1)           null,
    service_vietnam        tinyint(1)           null,
    service_activity       text                 null comment 'Activity During War',
    med_cane               tinyint(1)           null,
    med_walker             tinyint(1)           null,
    med_wheelchair         tinyint(1)           null,
    med_chair_loc          varchar(255)         null,
    med_scooter            tinyint(1)           null,
    med_when_use           text                 null comment 'Please describe when you use mobility equipment',
    med_list               text                 null comment 'Medication List  (name and how often you use each)',
    med_emphysema          tinyint(1)           null,
    med_falls              tinyint(1)           null,
    med_heart_disease      tinyint(1)           null,
    med_pacemaker          tinyint(1)           null,
    med_joint_replacement  tinyint(1)           null,
    med_kidney             tinyint(1)           null,
    med_diabetes           tinyint(1)           null,
    med_seizures           tinyint(1)           null,
    med_urostomy           tinyint(1)           null,
    med_dementia           tinyint(1)           null,
    med_nebulizer          tinyint(1)           null,
    med_oxygen             tinyint(1)           null,
    med_football           tinyint(1)           null comment 'Problem walking length of football field?',
    med_walk_bus_steps     tinyint(1)           null,
    med_stroke             tinyint(1)           null,
    med_urinary            tinyint(1)           null,
    med_cpap               tinyint(1)           null,
    med_flow_rate          text                 null,
    med_others             text                 null,
    med_use_mobility       tinyint(1)           null,
    add_other_vets         tinyint(1)           null comment 'Are there other veterans you want to travel with?',
    add_vet_names          tinytext             null,
    add_specific_guardian  varchar(45)          null,
    guardian_phone         varchar(45)          null,
    add_comments           text                 null,
    med_code               varchar(45)          null comment 'Color representing medical condition',
    app_date               date                 null,
    diet_restrictions      varchar(255)         null,
    admin_comments         text                 null,
    last_updated           datetime             null,
    med_stairs             tinyint(1) default 0 null,
    med_stand_30min        tinyint(1) default 0 null,
    med_hbp                tinyint(1) default 0 null,
    med_transport_airport  tinyint(1) default 0 null,
    med_transport_trip     tinyint(1) default 0 null,
    med_colostomy          tinyint(1) default 0 null,
    med_cancer             tinyint(1) default 0 null,
    med_dnr                tinyint(1) default 0 null,
    constraint bus_bet_fk
        foreign key (bus_id) references bus (bus_id)
            on update cascade on delete set null,
    constraint guardian_veteran_fk
        foreign key (guardian_id) references guardian (guardian_id)
            on update cascade on delete set null,
    constraint mission_vet_fk
        foreign key (mission_id) references mission (mission_id)
            on update cascade on delete set null,
    constraint team_veteran_fk
        foreign key (team_id) references team (team_id)
            on update cascade on delete set null
)
    charset = utf8;

create table hotel_info
(
    hotel_id    int auto_increment
        primary key,
    veteran_id  int unsigned null,
    guardian_id int          null,
    name        varchar(255) null,
    room        varchar(255) null,
    check_in    datetime     null,
    check_out   datetime     null,
    mission_id  int          null,
    constraint hotel_info_veteran_veteran_id_fk
        foreign key (veteran_id) references veteran (veteran_id)
);