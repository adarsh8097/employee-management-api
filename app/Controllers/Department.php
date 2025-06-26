<?php
namespace App\Controllers;
class Department extends BaseController{
    
    // add deartment method;
    public function addDepartment(){
        try{
            if($this->request->getMethod() == 'POST'){
              $name = $this->request->getVar('name');

              if(empty($name)){
                 return $this->response->setJSON([
                    'status'=>'error',
                   'message' => 'Please enter the department name required.'
                 ]);
              }
              $CheckExistingdepartmentname = $this->model->GetSingleData('department',['name'=>$name,'status'=>1]);
              if($CheckExistingdepartmentname){
                 return $this->response->setJSON([
                    'status'=>'error',
                    'message' => 'This department name already exists.',
                 ]);
              }
              $data = [
                'name'=>$name,
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
              ];
              $InsertDepartmentData = $this->model->InserData('department',$data);
              if($InsertDepartmentData){
                 return $this->response->setJSON([
                    'status'=>'success',  
                    'message'=>'Data Inserted successfully',
                    'data'=>$data
                 ]);
              }else{
                return $this->response->setJSON([
                    'status'=>'error',
                    'message'=>'Data not inserted'
                ]);
              }
            }
        }catch(\Exception $e){
            return $this->response->setJSON([
                'status'=>'error',
               'message'=>'Internal server issue'.$e->getMessage() 
            ]);
        }
    }
    // public fuenction getalldata;
    public function GetAlldepartment(){
        try{
            if($this->request->getMethod() == 'GET'){
                 $getAllDepartment = $this->model->GetAllData('department',['status'=>1],'id','DESC');
                 if($getAllDepartment){
                     return $this->response->setJSON([
                        'status'=>'success',
                        'message'=>'All data get successfully',
                        'Totaldata'=> count($getAllDepartment),
                        'data'=>$getAllDepartment
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
                'status'=>'error',
                'message'=>'Internal server issue'.$e->getMessage()
             ]);
        }
    }
    // Get Single Department;
    public function SingleDepartment($id){
        try{
            if($this->request->getMethod() == 'GET'){
                if($id == null){
                  return $this->response->setJSON([
                'status'=>'error',
                'message'=>'Id is required'
                  ]);
                }
                $getSingleDepartment =$this->model->GetSingleData('department',['status'=>1,'id'=>$id]);
                if($getSingleDepartment){
                    return $this->response->setJSON([
                        'status'=>'success',
                        'message'=>'Single data get successfully',
                        'data'=>$getSingleDepartment
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
                'message'=>'Invalid server response'
             ]);
        }
    }
    //update Department;
     public function UpdateSingledata($id){
        try{
            if($this->request->getMethod() == 'PUT'){
                if($id == null){
                      return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'Please provide id'
                     ]);
                }
                $name = $this->request->getVar('name');
                    if(empty($name)){
                     return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'Please provide name'
                     ]);
                }
                $CheckingExisting = $this->model->GetSingleData('department',['name'=>$name,'status'=>1,'id !='=>$id]);
                if($CheckingExisting){
                    return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'This department name already exists. Please choose a different one.'
                     ]);
                }
                $data =[
                    'name'=>$name,
                    'updated_at'=>date('Y-m-d H:i:s')
                ];
                $updateDepartment = $this->model->UpdateSingleData('department',['status'=>1,'id'=>$id],$data);
                if($updateDepartment){
                     return $this->response->setJSON([
                        'status'=>'success',
                        'message'=>'Department data update successfully',
                        'data'=>$data
                     ]);
                }else{
                     return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'Department not found'
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
                'status'=>'error',
                'message'=>'Invalid server issue'.$e->getMessage()
             ]);
        }
     }
    //  public function delete department;
    public function DeleteDepartementedata($id){
         try{
            if($this->request->getMethod() == 'DELETE'){
                
                $data =[
                    'status'=> -1,
                     'updated_at'=> date('Y-m-d H:i:s')
                ];

                $departmentdata = $this->model->GetSingleData('department',['id'=>$id,'status'=>1]);
                if(!$departmentdata){
                    return $this->response->setJSON([
                        'status'=>'error',
                        'message'=>'department data not found'
                    ]);
                }
                $updateUserdatastatus = $this->model->UpdateSingleData('department',['id'=>$id],$data);
                if($updateUserdatastatus){
                     return $this->response->setJSON([
                        'status'=>'success',
                        'message'=>'Department data delete successfully',
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
                    'message'=>'Please select valid method'
                ]);
            }
         }catch(\Exception $e){
            return $this->response->setJSON([
                'status'=>'error',
                'message'=>'Server issue'.$e->getMessage()
            ]);
         }
    }


}

?>