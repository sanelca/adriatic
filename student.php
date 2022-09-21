<?php 
class Student extends Connection {

    public $grades = null;
    public $list_of_grades = null;
    public $fail_or_pass = 'fail';
    public $student = [];

    //Metod get_student ce dohvatiti podatke o studentu na sonovu id parametra
    function get_student($id){
        $student = $this->db_connection()->prepare("SELECT * FROM student WHERE id=$id");
        $student->execute();
        $student->setFetchMode(PDO::FETCH_ASSOC);

        $data = $student->fetchAll()[0];

        //Setovanje podataka u niz koji je iniciran na pocetku klase
        $this->student['id'] = $id;
        $this->student['name'] = $data['name'];
        $this->student['surname'] = $data['surname'];
    }
    //Calculate avarage grade
    //Metod za izracunavanje prosjecne ocjene
    function calculate_grades($grades){
        $gradesArray = [];
        foreach($grades as $grade) {
            $gradesArray[] = $grade['grade'];
        }
        $this->list_of_grades = $gradesArray;
        $gradeSum = array_sum($gradesArray) / count($gradesArray);
        return $gradeSum;
    }

    //Fetch grades of student
    //Metod za dohvatanje ocjena iz tabele grades na osnovu id parametra od studenta
    function fetch_grades($id){
        $grades = $this->db_connection()->prepare("SELECT grade FROM grades WHERE student_id=$id");
        $grades->execute();
        $grades->setFetchMode(PDO::FETCH_ASSOC);
        $this->grades = $grades->fetchAll();
    }

    //CSM dashboard return student data i to je pocetni pozvani metod iz index.php file
    function csm_dashboard($id) {
        //Dohvati mi podatke o studentu i o stutent grades na osnovu ID
        
        $this->student_grades($id);
        $this->get_student($id);

        //setovanje liste ocjena i podatka da li je student pao ili ne.
        $this->student['list_of_grades'] = $this->list_of_grades;
        $this->student['fail_or_pass'] = $this->fail_or_pass;

        //Finalno vracanje svih podataka o studentu koji se trebaju prikazati na dashboard
        return json_encode($this->student);
    }

    //Metod za odredjivanje prolaznosti iz predmeta
    function student_grades($id) {
        $this->fetch_grades($id);
        $avarage = $this->calculate_grades($this->grades);
        if($avarage >= 7) {
            $this->fail_or_pass = "pass";
        }
    }
}

?>