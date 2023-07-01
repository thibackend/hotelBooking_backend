<?php

namespace App\Http\Controllers\hotel_booking_api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\room_images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class RoomController extends Controller
{

    // get image and room;
    public function getRoomImages()
    {
        $rooms = Room::all();
        $rooms_and_images = [];
        foreach ($rooms as $key => $value) {
            $image  = room_images::where("room_id", $value['id'])->pluck('image_path')->all();
            $setdata = [
                "id"=>$value['id'],
                "category_id"=>$value['category_id'],
                "price"=>$value['price'],
                "name"=>$value['name'],
                "desc"=>$value['desc'],
                "star"=>$value['star'],
                "status"=>$value['status'],
                "image_path"=>$image
            ];
            array_push($rooms_and_images,$setdata);
        }
        return response()->json($rooms_and_images);
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
            'star' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $room = Room::create($request->all());
        return response()->json($room, 201);
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
        $room->delete();
        return response()->json(null, 204);
    }
    public function createRoom(Request $request){
// Validate dữ liệu
$validator = Validator::make($request->all(), [
    'category_id' => 'required',
    'price' => 'required',
    'name' => 'required',
    'desc' => 'required',
    'star' => 'required',
    'status' => 'required',
    'images' => 'required|array|max:3',
    'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
]);

// Kiểm tra nếu có lỗi trong validate
if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
}

// Tạo và lưu phòng mới
$room = new Room();
$room->category_id = $request->input('category_id');
$room->price = $request->input('price');
$room->name = $request->input('name');
$room->desc = $request->input('desc');
$room->star = $request->input('star');
$room->status = $request->input('status');
$room->save();

// Lấy ID phòng vừa được lưu
$roomId = $room->id;

// Lưu hình ảnh
if ($request->hasFile('images')) {
    $images = $request->file('images');
    foreach ($images as $image) {
        // Lưu hình ảnh vào thư mục public/images
        $imagePath = $image->store('public/images');

        // Lưu thông tin hình ảnh vào bảng room_images
        $roomImage = new room_images();
        $roomImage->room_id = $roomId;
        $roomImage->image_path = $imagePath;
        $roomImage->save();
    }
}

return redirect()->back()->with('success', 'Thêm phòng thành công!');
}


}
