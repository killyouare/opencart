<?php
class ControllerApiCategory extends Controller
{
    public function index()
    {
        $this->load->language('api/category');

        $json = $categories = array();

        if (!isset($this->session->data['api_id'])) {
            $json['error'] = $this->language->get('error_permission');
        } else {
            $this->load->model('catalog/category');

            $categories_info = $this->model_catalog_category->getCategoriesWithStatusesAndDescription();

            foreach ($categories_info as $index => $caregory) {
                if (!isset($caregory['name'])) {
                    $caregory['language_id'] = "";
                    $caregory['name'] = "";
                    $caregory['description'] = "";
                    $caregory['meta_title'] = "";
                    $caregory['meta_description'] = "";
                    $caregory['meta_keyword'] = "";
                }

                if (!isset($caregory['store_id'])) $caregory['store_id'] = "";

                $categories[(string)$index] = $caregory;
            }

            $json['status'] = "success";
            $json['orders'] = $categories_info;
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
