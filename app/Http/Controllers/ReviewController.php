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

    // تخزين التقييم الجديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'comment' => 'required|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:20048',
        ]);

        $avatarPath = null; // تحديد القيمة الافتراضية

        if ($request->hasFile('avatar')) {
            $imageName = time() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->move(public_path('avatars'), $imageName);
            $avatarPath = 'avatars/' . $imageName;
        }

        Review::create([
            'name' => $request->name,
            'position' => $request->position,
            'comment' => $request->comment,
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('admin.reviews.index')->with('success', 'تم إضافة التقييم بنجاح!');
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'comment' => 'required|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:20048',
        ]);

        $avatarPath = $review->avatar; // استخدم الصورة الحالية إذا لم يتم رفع صورة جديدة

        if ($request->hasFile('avatar')) {
            // حذف الصورة القديمة إن وجدت
            if ($review->avatar) {
                Storage::disk('public')->delete($review->avatar);
            }

            $imageName = time() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->move(public_path('avatars'), $imageName);
            $avatarPath = 'avatars/' . $imageName;
        }

        $review->update([
            'name' => $request->name,
            'position' => $request->position,
            'comment' => $request->comment,
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('admin.reviews.index')->with('success', 'تم تحديث التقييم بنجاح!');
    }


    // عرض نموذج تعديل التقييم
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('admin.review.edit', compact('review'));
    }

   

    // حذف التقييم
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        if ($review->avatar) {
            Storage::disk('public')->delete($review->avatar);
        }
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'تم حذف التقييم بنجاح!');
    }
}
