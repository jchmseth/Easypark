<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FirebaseController extends Controller
{
    protected $parkingSlotModel;

    public function __construct()
    {
        $this->parkingModel = new ParkingSlotModel();
    }

    public function index()
    {
        // Retrieve the current slot values from the database
        $data['slots'] = $this->parkingModel->findAll();

        return view('parking_view', $data);
    }

    public function update()
    {
        $apiKeyValues = ["tPmAT5Ab3j7F9", "kIlSmx532djSa", "akS78dhxAaj7d"];
        $apiKeys = [
            $this->request->getPost('slot1_api_key'),
            $this->request->getPost('slot2_api_key'),
            $this->request->getPost('slot3_api_key')
        ];

        // Verify the API keys
        $isValid = true;
        foreach ($apiKeys as $index => $apiKey) {
            if ($apiKey !== $apiKeyValues[$index]) {
                $isValid = false;
                break;
            }
        }

        if (!$isValid) {
            return "Wrong API Key provided.";
        }

        // Update the slot values in the database
        $this->parkingModel->updateSlotValue(1, $this->request->getPost('slot1_park'));
        $this->parkingModel->updateSlotValue(2, $this->request->getPost('slot2_park'));
        $this->parkingModel->updateSlotValue(3, $this->request->getPost('slot3_park'));

        return redirect()->to(base_url('/parking'));
    }
}
