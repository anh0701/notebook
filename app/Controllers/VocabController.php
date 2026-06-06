<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\VocabModel;

class VocabController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $model = new VocabModel();

        $search = $this->request->getVar('search');

        if (!empty($search)) {
            $model->like('word', $search)
                  ->orLike('definition', $search);
        }
        
        $data = $model->orderBy('id', 'DESC')->findAll();

        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $model = new VocabModel();
        $data = $model->find($id);

        if (!$data) {
            return $this->failNotFound('Không tìm thấy từ vựng này!');
        }

        return $this->respond($data, 200);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $model = new VocabModel();
        
        $json = $this->request->getJSON();

        if ($json) {
            $data = [
                'word'       => $json->word,
                'type'       => $json->type ?? null,
                'definition' => $json->definition,
                'example'    => $json->example ?? null,
            ];
        } else {
            // Đề phòng trường hợp gửi dạng Form-data thông thường
            $data = [
                'word'       => $this->request->getPost('word'),
                'type'       => $this->request->getPost('type'),
                'definition' => $this->request->getPost('definition'),
                'example'    => $this->request->getPost('example'),
            ];
        }

        if ($model->insert($data)) {
            $data['id'] = $model->getInsertID();
            return $this->respondCreated($data, 'Thêm từ vựng thành công!');
        }

        return $this->fail('Có lỗi xảy ra khi lưu từ vựng.', 400);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $model = new VocabModel();
        $check = $model->find($id);

        if (!$check) {
            return $this->failNotFound('Không tìm thấy từ vựng cần cập nhật!');
        }

        $json = $this->request->getJSON();
        
        $data = [
            'word'       => $json->word ?? $check['word'],
            'type'       => $json->type ?? $check['type'],
            'definition' => $json->definition ?? $check['definition'],
            'example'    => $json->example ?? $check['example'],
        ];

        if ($model->update($id, $data)) {
            return $this->respond($data, 200, 'Cập nhật thành công!');
        }

        return $this->fail('Có lỗi xảy ra khi cập nhật.', 400);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $model = new VocabModel();
        $data = $model->find($id);

        if (!$data) {
            return $this->failNotFound('Không tìm thấy từ vựng cần xóa!');
        }

        if ($model->delete($id)) {
            return $this->respondDeleted(['id' => $id], 'Đã xóa từ vựng thành công!');
        }

        return $this->fail('Có lỗi xảy ra khi xóa.', 400);
    }
}
