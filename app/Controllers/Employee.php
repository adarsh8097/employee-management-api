<?php
namespace App\Controllers;
class Employee extends BaseController{
   
// Add employee
    public function addEmployee(){
        try{
            if($this->request->getMethod() == 'POST'){
                $name          = $this->request->getVar('name');
                $departmentId  = $this->request->getVar('department_id');
                $email         = $this->request->getVar('email');  
                $phoneNumber   = $this->request->getVar('phone_number');  
                $designation   = $this->request->getVar('designation'); 
                // $gender        = $this->request->getVar('gender');
                $address       = $this->request->getVar('address');  

                if (empty($name) || empty($phoneNumber) || empty($email) || empty($departmentId) || empty($designation) || empty($address)) {
                    return $this->response->setJSON([
                        'status'  => 'error',
                        'message' => 'All fields are required.'
                    ]);
                }
                $CheckExistingemail = $this->model->GetSingleData('employee',['email'=>$email,'status'=>1]);
                if($CheckExistingemail){
                    return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'Email already exists. Try using a different one.'
                    ]);
                }
                $CheckExistingMobile = $this->model->GetSingleData('employee',['phone_number'=>$phoneNumber,'status'=>1]);
                 if($CheckExistingMobile){
                    return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'Mobile number already exists. Try using a different one.'
                    ]);
                }

                $data = [
                    'name'=>$name,
                    'department_id'=>$departmentId,
                    'email'=>$email,
                    'phone_number'=>$phoneNumber,
                    'designation'=>$designation,
                    'address' =>$address,   
                    'status'=>1,
                    'created_at'=> date('Y-m-d H:i:s')
                ];

                $insertData = $this->model->InserData('employee',$data);
                if($insertData){
                     return $this->response->setJSON([
                        'status'=>'success',
                        'message'=>'Data inserted successfully',
                        'data' => $data
                     ]);
                }else{
                    return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'Data not Insserted'
                    ]);
                }

            }else{
                return $this->response->setJSON([
                    'status'=>'error',
                    'message'=>'Invalid request method'
                ]);
            }
        }catch(\Exception $e){
            return $this->response->setJSON([
                'status'=>"error",
                'message'=>'Invalid server response'.$e->getMessage()
            ]);
        }
    }
    // Get All Data;
    public function GetAllEmployee(){
        try{
            if($this->request->getMethod() == 'GET'){
                // Write a query:
                 $allEmployeedata = 'SELECT e.id,e.name,department.name as department_name,e.email,e.phone_number as phone,e.designation as position , e.address,e.status,e.created_at from employee as e
                  left join department on e.department_id = department.id and department.status = 1  where e.status = 1
                 ';
                 $query = $this->db->query($allEmployeedata);
                 $getAllEmploeyee = $query->getResultArray();
                
                 //  $getAllEmploeyee = $this->model->GetAllData('employee',['status'=>1],'id','DESC');
                 if($getAllEmploeyee){
                     return $this->response->setJSON([
                        'status'=>'success',
                        'message'=>'All data get successfully',
                        'Totaldata'=> count($getAllEmploeyee),
                        'data'=>$getAllEmploeyee
                     ]);
                 }else{
                    return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'Data not found' 
                     ]);
                 }
            }else{
                return $this->response->setJSON([
                    'status'=>'error',
                    'message'=>'Invalid request method'
                ]);
            }
        }catch(\Exception $e){
           return $this->response->setJSON([
                'status'=>"error",
                'message'=>'Invalid server response'.$e->getMessage()
            ]);
        }
    }
    // GET Single employee:
     public function SingleEmployee($id){
        try{
            if($this->request->getMethod() == 'GET'){
                $SingleEmployeedata = "SELECT e.id, e.name,department.name as department_name,e.email,e.phone_number as phone,e.designation as position , e.address,e.status,e.created_at from employee as e
                  left join department on e.department_id = department.id and department.status = 1 where e.status = 1 and e.id = $id
                 ";
                 $query = $this->db->query($SingleEmployeedata);
                 $getSingleEmployee = $query->getRowArray();

            //    $getSingleEmployee =$this->model->GetSingleData('employee',['status'=>1,'id'=>$id]);
                if($getSingleEmployee){
                    return $this->response->setJSON([
                        'status'=>'success',
                        'message'=>'Single data get successfully',
                        'data'=>$getSingleEmployee
                    ]);
                }else{
                    return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'Data not found'
                    ]);
                }
            }else{
                return $this->response->setJSON([
                    'status'=>'error',
                    'message'=>'Invalid request'
                ]);
            }
        }catch(\Exception $e){
             return $this->response->setJSON([
                'status'=>'error',
                'message'=>'Invalid server response'.$e->getMessage()
             ]);
        }
    }
    // Update SingleData:
      public function UpdateEmployeedetails($id){
        try{
            if($this->request->getMethod() == 'PUT'){
                $name          = $this->request->getVar('name');
                $departmentId  = $this->request->getVar('department_id');
                $email         = $this->request->getVar('email');  
                $phoneNumber   = $this->request->getVar('phone_number');  
                $designation   = $this->request->getVar('designation'); 
                // $gender        = $this->request->getVar('gender');
                $address       = $this->request->getVar('address');  

                if (empty($name) || empty($phoneNumber) || empty($email) || empty($departmentId) || empty($designation) || empty($address)) {
                    return $this->response->setJSON([
                        'status'  => 'error',
                        'message' => 'All fields are required.'
                    ]);
                }
                $CheckExistingemail = $this->model->GetSingleData('employee',['email'=>$email,'status'=>1,'id !='=>$id]);
                if($CheckExistingemail){
                    return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'Email already exists. Try using a different one.'
                    ]);
                }
                $CheckExistingMobile = $this->model->GetSingleData('employee',['phone_number'=>$phoneNumber,'status'=>1,'id !='=>$id]);
                 if($CheckExistingMobile){
                    return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'Mobile number already exists. Try using a different one.'
                    ]);
                }

                $data = [
                    'name'=>$name,
                    'department_id'=>$departmentId,
                    'email'=>$email,
                    'phone_number'=>$phoneNumber,
                    'designation'=>$designation,
                    'address' =>$address,   
                    'updated_at'=> date('Y-m-d H:i:s')
                ];

                $UpdateData = $this->model->UpdateSingleData('employee',['id'=>$id,'status'=>1],$data);
                if($UpdateData){
                     return $this->response->setJSON([
                        'status'=>'success',
                        'message'=>'Data Updated successfully',
                        'data' => $data
                     ]);
                }else{
                    return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'Data not Updated'
                    ]);
                }

            }else{
                return $this->response->setJSON([
                    'status'=>'error',
                    'message'=>'Invalid request method'
                ]);
            }
        }catch(\Exception $e){
            return $this->response->setJSON([
                'status'=>"error",
                'message'=>'Invalid server response'.$e->getMessage()
            ]);
        }
    }
    // Delete Employee:
     public function DeleteEmployeedata($id){
         try{
            if($this->request->getMethod() == 'DELETE'){
                
                $data =[
                    'status'=> -1,
                     'updated_at'=> date('Y-m-d H:i:s')
                ];

                $departmentdata = $this->model->GetSingleData('employee',['id'=>$id,'status'=>1]);
                if(!$departmentdata){
                    return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'Employee data not found'
                    ]);
                }
                $updateUserdatastatus = $this->model->UpdateSingleData('employee',['id'=>$id],$data);
                if($updateUserdatastatus){
                     return $this->response->setJSON([
                        'status'=>'success',
                        'message'=>'Employee data delete successfully',
                     ]);
                }else{
                    return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'Data not deleted'
                    ]);
                }
             }else{
                return $this->response->setJSON([
                    'status'=>'error',
                    'message'=>'Invalid Method'
                ]);
            }
         }catch(\Exception $e){
            return $this->response->setJSON([
                'status'=>'error',
                'message'=>'Server issue'.$e->getMessage()
            ]);
         }
    }
 // search keyword;
 public function SearchEmployee()
{
    try {
       if ($this->request->getMethod() == 'GET') {
         $keyword = trim($this->request->getGet('q'));
              if (empty($keyword)) {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'Please provide search keyword'
                ]);
            }
             $searchEmployee ="SELECT e.id, e.name, department.name as department_name, e.email,
                 e.phone_number as phone, e.designation as position, 
                 e.address, e.status, e.created_at from employee left join
                 department on department.id = e.department_id and department.status = 1 where e.status = 1
                 ";
                 $query = $this->db->query($searchEmployee);

               $query->groupStart()
                    ->like('e.name', $keyword)
                    ->orLike('e.email', $keyword)
                    ->orLike('e.phone_number', $keyword)
                    ->groupEnd();

          
            $result = $query->get()->getResultArray();
            $total  = count($result);

          
            if ($result) {
                return $this->response->setJSON([
                    'status'     => 'success',
                    'message'    => 'Filtered employee data fetched successfully',
                    'TotalData'  => $total,
                    'data'       => $result
                ]);
            } else {
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'No matching data found.'
                ]);
            }

        } else { 
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Invalid request method'
            ]);
        }

    } catch (\Exception $e) {
        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Server error: ' . $e->getMessage()
        ]);
    }
}

}

?>