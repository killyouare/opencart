<?php
class ControllerApiCategory extends Controller
{
    public function index()
    {
        $this->load->language('api/category');

        $json = array();

        $categories = new StdClass();

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
            $categories->{$index} = $caregory;
        }

        $json['status'] = "success";
        $json['categories'] = $categories;
        

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
