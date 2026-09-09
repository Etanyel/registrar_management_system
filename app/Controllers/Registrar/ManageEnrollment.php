<?php

namespace App\Controllers\Registrar;

use App\Controllers\BaseController;
use App\Models\Enrollment;
use App\Models\Student;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Validation\Validation;
use Config\Services;
use PhpParser\Node\Stmt\TryCatch;

class ManageEnrollment extends BaseController
{
    public function index()
    {
        return view('registrar/registrar-enrollment/registrar-enrollment');
    }

    // public function enroll()
    // {
    //     if (session()->get('userRole') !== 'registrar') {
    //         return $this->response->setJSON([
    //             'status' => 401,
    //             'error_message' => 'You are not authorized to this action.'
    //         ]);
    //     }

    //     $studentId = $this->generateStudentId();

    //     $data = [
    //         'student_id' => $studentId,
    //         'firstname' => $this->request->getPost('firstname'),
    //         'lastname' => $this->request->getPost('lastname'),
    //         'middlename' => $this->request->getPost('middlename'),
    //         'suffix' => $this->request->getPost('suffix'),
    //         'sex' => $this->request->getPost('sex'),
    //         'birthdate' => $this->request->getPost('birthdate'),
    //         'email' => $this->request->getPost('email'),
    //         'contact_no' => $this->request->getPost('contact_no'),
    //         'contact_person' => $this->request->getPost('contact_person'),
    //         'address' => $this->request->getPost('address'),
    //         'course' => $this->request->getPost('course'),
    //     ];

    //     $enrollment = [
    //         'student_id' => $studentId,
    //         'course_id' => $this->request->getPost('course_id'),
    //         'section' => $this->request->getPost('section'),
    //         'student_type' => $this->request->getPost('student_type'),
    //         'year_level' => $this->request->getPost('year_level'),
    //         'academic_year' => $this->request->getPost('academic_year'),
    //         'semester' => $this->request->getPost('semester'),
    //         'enrolled_by' => session()->get('userId')
    //     ];

    //     $validation = Services::validation();

    //     $validation->setRules([

    //     ]);
    // }


    public function enroll()
    {
        try {
            if (session()->get('userRole') !== 'registrar') {
                return $this->response->setJSON([
                    'status' => 401,
                    'message' => 'You are not authorized to this action.'
                ]);
            }

            $studentModel = new Student();
            $enrollmentModel = new Enrollment();

            $student_id = $this->generateStudentId();

            $data = [
                'student_id' => $student_id,
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'middlename' => $this->request->getPost('middlename'),
                'suffix' => $this->request->getPost('suffix'),
                'sex' => $this->request->getPost('sex'),
                'birthdate' => $this->request->getPost('birthdate'),
                'email' => $this->request->getPost('email'),
                'contact_no' => $this->request->getPost('contact_no'),
                'contact_person' => $this->request->getPost('contact_person'),
                'course' => $this->request->getPost('course'),
                'address' => $this->request->getPost('address'),
            ];

            $enrollment = [
                'student_id' => $student_id,
                'course_id' => $this->request->getPost('course'),
                'section' => $this->request->getPost('section'),
                'student_type' => $this->request->getPost('student_type'),
                'year_level' => $this->request->getPost('year_level'),
                'academic_year' => $this->request->getPost('academic_year'),
                'semester' => $this->request->getPost('semester'),
                'enrolled_by' => session()->get('userId')
            ];


            if ($enrollment['student_type'] === 'returning') {
                //Check if the Returning Student ID No. is exist
                $checkStudentId = $studentModel->where('student_id', $this->request->getPost('student_id'))->first();

                if ($checkStudentId) {
                    $enrollmentModel->insert([
                        'student_id' => $this->request->getPost('student_id'),
                        'course_id' => $checkStudentId['course'],
                        'section' => $this->request->getPost('section'),
                        'student_type' => $this->request->getPost('student_type'),
                        'year_level' => $this->request->getPost('year_level'),
                        'academic_year' => $this->request->getPost('academic_year'),
                        'semester' => $this->request->getPost('semester'),
                        'enrolled_by' => session()->get('userId')
                    ]);

                    service('activitylogs')->save([
                        'user_id' => session()->get('userId'),
                        'user_agent' => service('request')->getUserAgent()->getAgentString(),
                        'ip_address' => service('request')->getIPAddress(),
                        'action' => 'Enrolled student ID no.: (' . $this->request->getPost('student_id') . ')',
                    ]);

                    return $this->response->setJSON([
                        'status' => 200,
                        'message' => 'Student successfully enrolled.'
                    ]);
                }

                return $this->response->setJSON([
                    'status' => 404,
                    'message' => 'Student ID No. Not found or not Exist.'
                ]);
            }


            // -------------------------------------------------
            // VALIDATION
            // -------------------------------------------------

            $validation = Services::validation();

            $validation->setRules([
                'student_id' => [
                    'rules' => 'required|max_length[30]',
                    'errors' => [
                        'required' => 'Student ID is required.',
                        'max_length' => 'Student ID must not exceed 30 characters.'
                    ]
                ],

                'firstname' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => 'First name is required.',
                        'max_length' => 'First name must not exceed 100 characters.'
                    ]
                ],

                'lastname' => [
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => 'Last name is required.',
                        'max_length' => 'Last name must not exceed 100 characters.'
                    ]
                ],

                'middlename' => [
                    'rules' => 'permit_empty|max_length[100]',
                    'errors' => [
                        'max_length' => 'Middle name must not exceed 100 characters.'
                    ]
                ],

                'suffix' => [
                    'rules' => 'permit_empty|max_length[20]'
                ],

                'sex' => [
                    'rules' => 'required|in_list[Male,Female]',
                    'errors' => [
                        'required' => 'Sex is required.',
                        'in_list' => 'Invalid sex selected.'
                    ]
                ],

                'birthdate' => [
                    'rules' => 'required|valid_date[Y-m-d]',
                    'errors' => [
                        'required' => 'Birthdate is required.',
                        'valid_date' => 'Invalid birthdate.'
                    ]
                ],

                'email' => [
                    'rules' => 'permit_empty|valid_email|max_length[150]',
                    'errors' => [
                        'valid_email' => 'Please provide a valid email address.'
                    ]
                ],

                'contact_no' => [
                    'rules' => 'permit_empty|max_length[20]'
                ],

                'contact_person' => [
                    'rules' => 'permit_empty|max_length[150]'
                ],

                'address' => [
                    'rules' => 'required|max_length[255]',
                    'errors' => [
                        'required' => 'Address is required.'
                    ]
                ],

                'course_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Course is required.',
                    ]
                ],

                'section' => [
                    'rules' => 'required|max_length[50]',
                    'errors' => [
                        'required' => 'Section is required.'
                    ]
                ],

                'student_type' => [
                    'rules' => 'required|in_list[new,transferee,returning]',
                    'errors' => [
                        'required' => 'Student type is required.',
                        'in_list' => 'Invalid student type.'
                    ]
                ],

                'year_level' => [
                    'rules' => 'required|in_list[1,2,3]',
                    'errors' => [
                        'required' => 'Year level is required.',
                        'in_list' => 'Invalid year level.'
                    ]
                ],

                'academic_year' => [
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => 'Academic year is required.'
                    ]
                ],

                'semester' => [
                    'rules' => 'required|in_list[1st,2nd]',
                    'errors' => [
                        'required' => 'Semester is required.',
                        'in_list' => 'Invalid semester.'
                    ]
                ],
            ]);

            // Validate all posted data together
            $validationData = array_merge($data, $enrollment);

            if (!$validation->run($validationData)) {
                return $this->response->setJSON([
                    'status' => 422,
                    'message' => 'Please correct the errors.',
                    'errors' => $validation->getErrors()
                ]);
            }


            // -------------------------------------------------
            // CHECK EXISTING STUDENT
            // -------------------------------------------------

            $existingStudent = $studentModel
                ->where('student_id', $data['student_id'])
                ->first();

            if ($existingStudent) {
                return $this->response->setJSON([
                    'status' => 409,
                    'message' => 'Student ID already exists.'
                ]);
            }

            // -------------------------------------------------
            // DATABASE TRANSACTION
            // -------------------------------------------------

            $db = \Config\Database::connect();

            $db->transStart();

            // Student record
            $data['status'] = 'active';
            $data['enrolled_by'] = session()->get('userId');

            $studentModel->insert($data);

            // Enrollment record
            $enrollmentModel->insert($enrollment);

            $db->transComplete();

            // Check transaction
            if ($db->transStatus() === false) {
                return $this->response->setJSON([
                    'status' => 500,
                    'message' => 'Enrollment failed. No changes were saved.'
                ]);
            }

            service('activitylogs')->save([
                'user_id' => session()->get('userId'),
                'user_agent' => service('request')->getUserAgent()->getAgentString(),
                'ip_address' => service('request')->getIPAddress(),
                'action' => 'Enrolled student ID no.: (' . $student_id . ')',
            ]);

            return $this->response->setJSON([
                'status' => 200,
                'message' => 'Student successfully enrolled.'
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    private function generateStudentId()
    {
        $studentModel = new Student();

        $year = date('Y');
        $month = date('m');

        $prefix = $year . '-' . $month;

        $lastStudent = $studentModel
            ->like('student_id', $prefix, 'after')
            ->orderBy('student_id', 'DESC')
            ->first();

        if (!$lastStudent) {
            $sequence = 1;
        } else {
            $lastId = $lastStudent['student_id'];

            // Get the last 4 digits
            $lastSequence = (int) substr($lastId, -4);

            $sequence = $lastSequence + 1;
        }

        return $prefix . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    // {
    //     try {
    //         $model = new Student();

    //         $records = $model->select('students.*, course.course_name, enrollments.year_level, enrollments.section, enrollments.student_type, enrollments.course_id, enrollments.academic_year, enrollments.semester, enrollments.created_at')
    //             ->join('course', 'course.id = enrollments.course_id')
    //             ->join('enrollments', 'enrollments.student_id = students.student_id')->findAll();

    //         return $this->response->setJSON([
    //             'status' => 200,
    //             'records' => $records
    //         ]);

    //     } catch (\Throwable $e) {
    //         return $this->response->setJSON([
    //             'status'=> 500,
    //             'message'=> $e->getMessage()
    //         ]);
    //     }
    // }

    public function getRecords()
    {
        try {

            $model = new Enrollment();

            $records = $model
                ->select('
                enrollments.*,
                course.course_name,
                students.firstname,
                students.lastname,
                students.middlename,
                students.id,
                students.status,
            ')->join('students', 'students.student_id = enrollments.student_id', 'left')
                ->join('course', 'course.id = enrollments.course_id', 'left')
                ->where('MONTH(enrollments.created_at)', date('m'))
                ->where('YEAR(enrollments.created_at)', date('Y'))
                ->where('students.status', 'active')->findAll();

            return $this->response->setJSON([
                'status' => 200,
                'records' => $records
            ]);

        } catch (\Throwable $e) {

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status' => 500,
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function viewRecord($id)
    {
        try {
            return view('registrar/registrar-enrollment/registrar-view-record', ['record_id' => $id]);

        } catch (\Throwable $e) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status' => 500,
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function getRecord($id)
    {
        try{
        $model = new Enrollment();
        $data = $model->select(
            'enrollments.*, 
            course.course_name,
            students.firstname,
            students.lastname,
            students.middlename,
            students.id,
            students.status,')
            ->join('course','course.id = enrollments.course_id')
            ->join('students','students.student_id = enrollments.student_id')
            ->where('enrollments.id', $id)->first();

        
        }catch(\Throwable $e){

        }
    }
}
