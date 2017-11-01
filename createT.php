<?php
$servername="localhost";
$username="root";
$password="";
$conn =mysqli_connect($servername,$username,$password);
if($conn){
   $create="create database learnX";
    mysqli_query($conn,$create);$db="learnX";
    $cTable="create table learnX.Account(
    acct_id int primary key AUTO_INCREMENT not null,
    first_name varchar(15) not null,
    last_name varchar(15) not null,
    email_id varchar(30) ,
    password varchar(15),
    phone_no varchar(15),
    city varchar(15),
    country varchar(15),
    q_level varchar(15) not null);";
    mysqli_query($conn,$cTable);
    $cTable="create table learnX.Learner(
    acct_id int not null,
    skills varchar(40) not null,
    majors varchar(20) not null,
    reputation int not null,
    stars int not null,
    percent int not null,
    constraint la foreign key(acct_id) references $db.Account(acct_id));";
    if(!mysqli_query($conn,$cTable)){
        echo "Learner not created".mysqli_error($conn)."<br>";
    }
    else{
        echo"learner created<br>";
    }
    $cTable="create table $db.Instructor(
    acct_id int not null,
    age int not null,
    experience_years int not null,
    subject varchar(20) not null,
    check (age>25),
    constraint ia foreign key(acct_id) references $db.Account(acct_id));";
    if(!mysqli_query($conn,$cTable)){
        echo "Instructor not created".mysqli_error($conn)."<br>";
    }
    else {
        echo"instructor created<br>";
    }
    $cTable="create table $db.Courses(
    course_id int primary key AUTO_INCREMENT,
    course_name varchar(20) not null,
    description varchar(150) not null,
    contents varchar(200),
    duration int,
    prerequisite varchar(40),
    repu_required int);";
    if(mysqli_query($conn,$cTable)){
        echo "<br>Courses created successfully";
    }
    
    $sql="create Table $db.Enrolls(
    acct_id int not null,
    course_id int not null,
    date DATETIME,
     constraint ea foreign key (acct_id) references $db.Account(acct_id),
     constraint ci foreign key (course_id) references $db.Courses(course_id)
    );";
    if(!mysqli_query($conn,$sql)){
        echo "<br>".mysqli_error($conn);
    }
    $sql="create Table $db.Creates(
    acct_id int not null,
    course_id int not null,
    date DATETIME,
     constraint ca foreign key (acct_id) references $db.Account(acct_id),
     constraint cci foreign key (course_id) references $db.Courses(course_id)
    );";
    if(!mysqli_query($conn,$sql)){
        echo "<br>".mysqli_error($conn);
    }
    $trigger="delimiter //
    create definer='root'@'localhost' trigger iseligible
    before insert on $db.Enrolls
    for each row        
    begin
    declare aid int;
    declare cid int;
    declare newskill varchar(40);
    declare preq varchar(40);
   
   select prerequisite into preq
        from Courses where course_id=new.course_id;
    select skills into newskill 
        from Learner where acct_id=new.acct_id;
        if preq not like '%No prerequisite%' and preq not like '%no prequisite%' and preq not like '%No Prerequisite%' then
            if newskill not like concat('%',preq,'%') then
                signal sqlstate '45000'; 
            end if;
        end if;
    end//
    ";
    if(!mysqli_query($conn,$trigger)){
        echo mysqli_error($conn);
    }
    
        
    
    
}
?>
    