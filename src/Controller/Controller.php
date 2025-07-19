<?php
namespace App\Controller;

interface Controller
{
    public function index();

    public function edit($id);

    public function delete($id);

    public function show($id);

    public function update();

    public function store(array $data);


}
