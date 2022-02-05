readme.txt 파일입니다.

1. 홈페이지와 DB 연결하는 코드는 배포를 하고, 설명만 하면 될 것 같습니다.

DB 연동을 테스트하기 위해 아래와 같이 테이블을 만들고, 간단하게 데이터베이스에서 읽어오는 것만 확인해봅니다.


/* */
//
;
#
-- comment

create  table first_table (
    idx     int(10) auto_increment,
    id      char(20) UNIQUE not null,
    name    char(20) not null,
    age     int(5) default '10',
    time    datetime,
    primary key(idx)
);

insert into first_table (id, name, age, time) values ('test', '테스트', '22', now());
insert into first_table (id, name, age, time) values ('test1', '테스트1', '33', now());
insert into first_table (id, name, age, time) values ('test2', '테스트2', '44', now());
insert into first_table (id, name, age, time) values ('test3', '테스트3', '55', now());
