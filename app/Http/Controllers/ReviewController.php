<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    // عرض قائمة التقييمات
    public function index()
    {
        $reviews = Review::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.review.index', compact('reviews'));
    }

    // عرض نموذج إضافة التقييم
    public function create()
    {
        return view('admin.review.create');
    }

    // تخزين التقييم الجديد (باستخدام نفس منطق CarController)
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'comment'  => 'required|string|max:1000',
            'avatar'   => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:20048',
        ]);

        $data = $request->all();

        if (isset($data['pickup_location'])) {
            $data['location'] = $data['pickup_location'];
        }

        // Create uploads directory if it doesn't exist
        $uploadPath = public_path('uploads/avatars');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Move the image to the uploads directory
            $image->move($uploadPath, $imageName);
            
            // Store the relative path in the database
            $data['avatar'] = 'uploads/avatars/' . $imageName;
        }

        Review::create([
            'name'     => $data['name'],
            'position' => $data['position'],
            'comment'  => $data['comment'],
            'avatar'   => $data['avatar'] ?? null,
        ]);

        return redirect()->route('admin.reviews.index')->with('success', 'Rating added successfully!');
    }

    // عرض نموذج تعديل التقييم
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('admin.review.edit', compact('review'));
    }

    // تحديث بيانات التقييم (باستخدام منطق مشابه لـ CarController)
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'comment'  => 'required|string|max:1000',
            'avatar'   => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:20048',
        ]);

        $data = $request->all();

        if (isset($data['pickup_location'])) {
            $data['location'] = $data['pickup_location'];
        }

        // Create uploads directory if it doesn't exist
        $uploadPath = public_path('uploads/avatars');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($request->hasFile('avatar')) {
            // Delete old image if exists
            if ($review->avatar) {
                $oldImagePath = public_path($review->avatar);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('avatar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Move the image to the uploads directory
            $image->move($uploadPath, $imageName);
            
            // Store the relative path in the database
            $data['avatar'] = 'uploads/avatars/' . $imageName;
        }

        $review->update([
            'name'     => $data['name'],
            'position' => $data['position'],
            'comment'  => $data['comment'],
            'avatar'   => $data['avatar'] ?? $review->avatar,
        ]);

        return redirect()->route('admin.reviews.index')->with('success', 'Rating updated successfully!');
    }

    // حذف التقييم
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        if ($review->avatar && file_exists(public_path($review->avatar))) {
            unlink(public_path($review->avatar));
        }
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Rating deleted successfully!');
    }
}
