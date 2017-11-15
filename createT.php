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
    repu_required int,
    skills_aquired varchar(30));";
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

    $sql="create table $db.DiscussionForum(
    question_id int primary key AUTO_INCREMENT,
    course_id int,
    question varchar(100),
    answer varchar(400),
    acct_id int ,
    constraint da foreign key(acct_id) references $db.Account(acct_id)
    );";
        if(!mysqli_query($conn,$sql)){
            echo mysqli_error($conn);
        }
    $sql="create table $db.Exam(
    exam_id int primary key AUTO_INCREMENT,
    course_id int,
    question_1 varchar(1000),
    question_2 varchar(1000),
    ans_1 varchar(20),
    ans_2 varchar(20),
    min_qualify_marks int,
    max_marks int,
    constraint fce foreign key (course_id) references $db.Courses(course_id)
       )";
    if(!mysqli_query($conn,$sql))
    {
        echo "<br>".mysqli_error($conn);
    }
    $Gives="create Table $db.Gives(
    acct_id int ,foreign key(acct_id) references $db.Learner(acct_id),
    exam_id int, foreign key(exam_id) references $db.Exam(exam_id),
    marks_obtained int,
    date DATETIME);";
    if(!mysqli_query($conn,$Gives))
        echo "<br>".mysqli_error($conn);
    $feed="create table $db.Feedback(
    feedback_id int primary key AUTO_INCREMENT,
    feedback int,
    comments varchar(50),
    acct_id int not null,
    course_id int not null,
    foreign key(course_id) references Courses(course_id);
    foreign key (acct_id) references $db.Learner(acct_id));";
    if(!mysqli_query($conn,$feed))
        echo "<br>".mysqli_error($conn);
    $trigger="
    delimiter //
    create trigger iseligible 
    before insert on Enrolls
    for each row
    begin
    declare repu int;
    declare rep int;
    declare newskill varchar(40);
    declare preq varchar(40);
   
   select prerequisite into preq
        from Courses where course_id=new.course_id;
    select skills into newskill 
        from Learner where acct_id=new.acct_id;
        select repu_required into repu from courses where course_id=new.course_id;
        select reputation into rep from Learner where acct_id=new.acct_id;
        if preq not like '%No prerequisite%' and preq not like '%no prequisite%' and preq not like '%No Prerequisite%' then
            if newskill not like concat('%',preq,'%') then
                if rep<repu then
                signal sqlstate '45000';
                end if;
            end if;
        end if;
    end//";
    mysqli_query($conn,$trigger);
    echo mysqli_error($conn);
    $trigger2="
    delimiter //
    create trigger after_ins_gives
    after insert on gives
    for each row
    BEGIN
select min_qualify_marks into @min from exam where exam_id=new.exam_id;
select course_id into @cid from exam where exam_id=new.exam_id;
if(@min<=new.marks_obtained)THEN
	select skills_aquired into @name from courses where course_id=@cid;
    select reputation into @repu from learner where acct_id=new.acct_id;
    select stars into @star from learner WHERE acct_id=new.acct_id;
    select repu_required into @repureq from Courses where course_id=@cid;
 
   select count(marks_obtained)into @count from Exam inner join gives using(exam_id) where course_id=@cid AND
acct_id=new.acct_id and marks_obtained>min_qualify_marks;

	IF (@count<=1)THEN
	 update learner SET
     stars=@star+1 ,reputation=@repu+@repureq where acct_id=new.acct_id;
     
    SELECT skills into @skill from learner where acct_id=new.acct_id;
    if(@skill  not like concat('%',@name,'%'))THEN
    update learner SET
    skills=concat(@skill,',',@name) where acct_id=new.acct_id;
    end if;
    end if;
end if;
end //";
    
    
    $trigger3="create trigger b_ins_gives
    before insert on gives
    for each row
    BEGIN
declare deadline int;
declare enda datetime;

select duration into deadline from courses where course_id= (select course_id from exam where exam_id=new.exam_id);

select date into enda from enrolls where acct_id=new.acct_id and course_id=(select course_id from exam where exam_id=new.exam_id)  ;

set @dead=(select date_add(enda,interval deadline*7 day));
if (@dead < new.date )THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT='Deadline passed';
end if;

end //";
    


        
    
}
        
    
    

?>
    