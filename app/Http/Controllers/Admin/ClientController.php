<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientRequest;
use App\Traits\ImageTrait;

class ClientController extends Controller
{
    use ImageTrait;

    private $paginate_clients = 10;

    public function index(Request $request)
    {
        if ($request->search) {
            $clients = $this->getSearch($request);
        } else {
            $clients = $this->getClients();
        }
        return $clients;
    } //end of index


    public function getClients()
    {
        return Client::latest()->paginate($this->paginate_clients);
    } //end of getClients


    public function getSearch($request)
    {
        $clients = Client::where('name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%')
            ->latest()->paginate($this->paginate_clients);

        return $clients;
    } //end of getSearch


    public function store(StoreClientRequest $request)
    {
        $request->validated();

        //encrypt password
        $form_data = $request->except(['password', 'password_confirmation', 'image']);
        $form_data['password'] = bcrypt($request->password);

        //image uploading
        if ($request->image) {
            $form_data["image"] = $this->uploadImage($request->image, 'images/clients');
        }

        Client::create($form_data);
    } //end of store


    public function edit(Client $client)
    {
        return $client;
    } //end of edit


    public function update(Request $request, Client $client)
    {
        $this->validateClient($request, $client);

        //encrypt password
        $form_data = $request->except(['password', 'password_confirmation', 'image']);
        $form_data['password'] = bcrypt($request->password);

        //image uploading
        if ($request->image) {
            if ($client->image != 'default.jpg') {
                $this->deleteImage($client->image, 'clients/');
            }
            $form_data["image"] = $this->uploadImage($request->image, 'images/clients');
        }

        $client->update($form_data);
    } //end of update


    public function validateClient($request, $client)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('clients')->ignore($client->id)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => ['mimes:jpeg,jpg,png,gif', 'max:2000'],
        ]);
    } //end of validateClient


    public function destroy(Client $client)
    {
        $client->comments()->delete();

        if ($client->image != 'default.jpg') {
            $this->deleteImage($client->image, 'clients/');
        }

        $client->delete();
    } //end of destroy
}
