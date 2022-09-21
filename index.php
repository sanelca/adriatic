
<?php 
//Ukljucivanje faile sa bazom podataka i ukljucivanje file sa glavnom klasom Student
require ("db.php");
require ("student.php");

//Pozivanje klase student
$student = new Student();

//Ako GET zahtjevu postoji parametar student kod ce se izvrsiti a vrijednost parametra treba da bude ID od studenta
if(isset($_GET['student'])) {
    //Pokupi podatke o studentu iz baze na osnovu metoda iz klase csm_dashboard
    $student_data = $student->csm_dashboard($_GET['student']);
    //print_r se sluzim kako bi podatke predstavio u API formatu tako da se moze koristiti od strane bilo koje spoljasnje aplikacije
    print_r($student_data);
}

?>