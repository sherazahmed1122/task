<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

	public function add_product(){
		$postdata = file_get_contents("php://input");
                $request = json_decode($postdata);

                $res = $this->common_model->add_product($request->name,$request->description,$request->price);

                if ($res) {
                        $data = array("status"=> "success", "message"=> "Product added successfully!");
                } else {
                        $data = array("status"=> "error", "message"=> "Some error occurred!");
                }

                echo json_encode($data);

        }

        public function product_all_data(){
                $data = $this->common_model->all_products();
                if (count($data) > 0) {
                        $data = array("status"=> "success", "data"=> $data);        
                } else {
                        $data = array("status"=> "success", "data"=> "No record found!");
                }
                echo json_encode($data);
        }

        public function edit_product(){
              $postdata = file_get_contents("php://input");
              $request = json_decode($postdata);
              $product_id = $request->id;
              $data = $this->db->select("*")->from('product_details')->where('id',$product_id)->where('deleted_at',NULL)->get()->row();
              echo json_encode($data);  
        }

        public function update_product(){
              $postdata = file_get_contents("php://input");
              $request = json_decode($postdata);
              $product_id = $request->id;
              $update_data = array(
                'name'=> $request->name,
                'description'=> $request->description,
                'price' => $request->price
              );

              $res = $this->db->set($update_data)->where('id',$product_id)->update('product_details');

              if ($res) {
                        $data = array("status"=> "success", "message"=> "Product updated successfully!");
                } else {
                        $data = array("status"=> "error", "message"=> "Some error occurred!");
                }

              echo json_encode($data);

        }

        public function deleteProduct(){
             $postdata = file_get_contents("php://input");
             $request = json_decode($postdata);
             $product_id = $request->id;

             $res = $this->db->set('deleted_at', date("Y-m-d h:i:s"))->where('id',$product_id)->update('product_details');

             if ($res) {
                        $data = array("status"=> "success", "message"=> "Product deleted successfully!");
                } else {
                        $data = array("status"=> "error", "message"=> "Some error occurred!");
                }

              echo json_encode($data);

        }

        public function ExportExcel(){

                $data = $this->common_model->all_products();

                $style = array(
                      'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ) 
              ); 


                $object = new PHPExcel();

                $object->setActiveSheetIndex(0);
                $object->getDefaultStyle()->applyFromArray($style);

                $table_columns = array("Name", "Description", "Price");

                $column = 0;

                foreach($table_columns as $field)
                {
                      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                      $object->getActiveSheet()->getStyleByColumnAndRow($column, 1)->getFont()->setBold(true);

                      $column++;
              }

              $row = 2;

              foreach ($data as $i) {
                      $object->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $i->name);
                      $object->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $i->description);
                      $object->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $i->price);
              }

              $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
              header('Content-Type: application/vnd.ms-excel');
              header('Content-Disposition: attachment;filename="'."Income Logs".'.xls"');
              $object_writer->save('php://output');

      }

}
