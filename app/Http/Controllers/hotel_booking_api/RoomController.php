<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\Room;
use App\Models\room_images;
use App\Models\RoomService;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class RoomController extends Controller
{

    // get image and room ---  cái này để show ra các dữ liệu của room và cộng thêm  ảnh của nó để show trong homepage;
    public function getRoomImages()
    {
        $rooms = Room::all();
        $rooms_and_images = [];
        foreach ($rooms as $key => $value) {
            $image  = room_images::where("room_id", $value['id'])->pluck('image_path')->all();
            $setdata = [
                "id" => $value['id'],
                "category_id" => $value['category_id'],
                "price" => $value['price'],
                "name" => $value['name'],
                "desc" => $value['desc'],
                "star" => $value['star'],
                "status" => $value['status'],
                "image_path" => $image
            ];
            array_push($rooms_and_images, $setdata);
        }
        return response()->json($rooms_and_images);
    }


    // cái function này để lấy một room thêm vào đó là các hình ảnh của phòng đó.
    public function getOneRoomImage(string $id)
    {
        $rooms = Room::find($id);
        $category = categories::find($rooms->category_id);
        $rooms_and_images = [];
        $image  = room_images::where("room_id", $id)->pluck('image_path')->all();
        $setdata = [
            "id" => $id,
            "category_id" => $rooms->category_id,
            "category_name" => $category,
            "price" => $rooms->price,
            "name" => $rooms->name,
            "desc" => $rooms->desc,
            "star" => $rooms->star,
            "status" => $rooms->status,
            "image_path" => $image
        ];
        array_push($rooms_and_images, $setdata);
        return response()->json($rooms_and_images);
    }


    // function này dùng để lấy tất cả services của một room.
    public function getRoomWithServiecs(string $id)
    {
        $room = Room::find($id);
        //lấy tất cả service mà có id room = $id từ trong bảng room services.
        $services_id = RoomService::where('room_id', $id)->pluck('service_id')->all();
        $services = Services::whereIn('id',$services_id)->get();
        $roomAndServices = [
            "room"=>$room,
            "services"=>$services
        ];
        return response()->json($roomAndServices);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        return response()->json($rooms);
    }

    public function get_room_in_a_hotel(string $hotelID)
    {

        if ($hotelID) {
            $rooms = Room::where('hotel_id', $hotelID)->get();
            $a = [] || null;
            foreach ($rooms as $key => $value) {
                $roomImages = $value->Image()->get();
                $a = $roomImages;
            }
            if ($a) {
                $rooms_and_images = [];
                foreach ($rooms as $value) {
                    $room = Room::find($value->id);
                    $imagesBelongRoomId = $room->Image()->where("room_id", $room->id)->pluck('image')->all();
                    array_push($rooms_and_images, [
                        "id" => $value->id,
                        "name" => $room->name,
                        "type_room_id" => $room->type_room_id,
                        "hotel_id" => $room->hotel_id,
                        "price" => $room->price,
                        "desc" => $room->desc,
                        "status" => $room->status,
                        "image" => $imagesBelongRoomId
                    ]);
                }
                return response()->json($rooms_and_images);
            } else {
                return response()->json(['Notfound' => " Hotel has ID:  $hotelID"]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'name' => 'required|string',
            'desc' => 'nullable|string',
            'star' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);
        $room = Room::create($request->all());
        return response()->json($room);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::findOrFail($id);
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'exists:categories,id',
            'price' => 'numeric',
            'name' => 'string',
            'desc' => 'nullable|string',
            'star' => 'integer',
            'status' => 'boolean',
        ]);

        $room = Room::findOrFail($id);
        $room->update($request->all());

        return response()->json($room);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
         // Xóa hình ảnh liên quan ở trong folder
         $roomImages = room_images::where('room_id', $id)->get();
         foreach ($roomImages as $roomImage) {
             // Xóa file từ thư mục
             $imagePath = public_path('uploads/images/' . $roomImage->image_path);
             if (file_exists($imagePath)) {
                 unlink($imagePath);
             }
         }
 
        $room->delete();
        return response()->json(null, 204);
    }

    public function createRoom(Request $request)
    {
        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'name' => 'required|string',
            'desc' => 'nullable|string',
            'images' => 'required|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'services' => 'required|array', 
            'services.*' => 'required|exists:services,id', 
        ]);
   
        // Kiểm tra lỗi validation
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
   
        try {
            // Tạo và lưu phòng mới
            $room = new Room();
            $room->category_id = $request->input('category_id');
            $room->price = $request->input('price');
            $room->name = $request->input('name');
            $room->desc = $request->input('desc');
            $room->star = 0;
            $room->status =0;
            $room->save();
   
            // Lấy ID phòng vừa được lưu
            $roomId = $room->id;
   
           // Lưu hình ảnh
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                // Tạo tên mới cho hình ảnh
                $nameImage=$image->getClientOriginalName();
                // Di chuyển hình ảnh vào thư mục public/images
                $image->move(public_path('uploads/images'), $nameImage);
           
                // Lưu thông tin hình ảnh vào bảng room_images
                $roomImage = new room_images();
                $roomImage->room_id = $roomId;
                $roomImage->image_path = $nameImage;
                $roomImage->save();}
        }
        //Lưu services:
        foreach ($request->input('services') as $serviceId) {
            $roomService = new RoomService();
            $roomService->room_id = $roomId;
            $roomService->service_id = $serviceId;
            $roomService->save();
        }




   
            return response()->json($room, 201);
        } catch (\Exception $e) {
            // Ghi lại lỗi vào logs hoặc hiển thị thông báo lỗi
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to add room'], 500);
        }
    }
   







}
