<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Category;
use App\Models\Service;
use App\Models\RoomService;
use App\Models\RoomImage;

class DetailController extends Controller
{
    public function index($roomId)
    {
        $room = Room::select('rooms.id', 'rooms.name', 'rooms.price', 'rooms.desc')
            ->select('room_images.image_path')
            ->select('categories.name AS category_name')
            ->join('room_images', 'rooms.id', '=', 'room_images.room_id')
            ->join('categories', 'rooms.category_id', '=', 'categories.id')
            ->join('room_services', 'rooms.id', '=', 'room_services.room_id')
            ->join('services', 'room_services.service_id', '=', 'services.id')
            ->where('rooms.id', $roomId)
            ->groupBy('rooms.id', 'rooms.name', 'rooms.price', 'rooms.desc', 'room_images.image_path', 'categories.name')
            ->get();

        // Access the retrieved data
        if ($room->count() > 0) {
            $roomId = $room[0]->id;
            $roomName = $room[0]->name;
            $roomPrice = $room[0]->price;
            $roomDesc = $room[0]->desc;
            $imagePath = $room[0]->image_path;
            $categoryName = $room[0]->category_name;

            $serviceData = $room->pluck(['service_name', 'service_price']);

            // Access service data
            foreach ($serviceData as $service) {
                $serviceName = $service['service_name'];
                $servicePrice = $service['service_price'];
                // Do something with service data
            }
            
            // Return the room and service data
            return response()->json([
                'room_id' => $roomId,
                'room_name' => $roomName,
                'room_price' => $roomPrice,
                'room_desc' => $roomDesc,
                'image_path' => $imagePath,
                'category_name' => $categoryName,
                'service_data' => $serviceData,
            ]);
        } else {
            // Room not found
            return response()->json(['error' => 'Room not found'], 404);
        }
    }
}
