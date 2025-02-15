<?php


namespace App\Http\Controllers;

use App\Models\SuivrePointage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuivrePointage;
use Illuminate\Support\Facades\Auth;

class SuivrePointageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:pointage-list|pointage-create|pointage-edit|pointage-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:pointage-show', ['only' => ['pointer']]);
    }

    public function index()
{
    $user = auth()->user();
    
    // جلب النقطة الجارية إذا كانت موجودة
    $currentPointage = SuivrePointage::where('iduser', Auth::id())
        ->whereNull('heure_depart')
        ->first();
    
    $query = SuivrePointage::with('user');
    
    // إذا كان هناك بحث، يتم فلترة البيانات
    if ($search = request('search')) {
        $query->whereHas('user', function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%"); // فلترة حسب اسم المستخدم
        })
        ->orWhereDate('created_at', 'like', "%{$search}%"); // فلترة حسب التاريخ
    }

    // ترتيب البيانات بحيث يتم عرض العناصر التي لها `created_at` أولاً
    $query->orderByRaw("CASE WHEN created_at IS NULL THEN 1 ELSE 0 END, created_at DESC");

    // جلب البيانات بناءً على دور المستخدم
    if ($user->hasRole('Admin') || $user->hasRole('admis3(addellatif)')) {
        $pointages = $query->paginate(10);
    } else {
        $pointages = $query->where('iduser', $user->id)->paginate(10);
    }

    return view('suivre_pointage.index', compact('pointages', 'currentPointage'));
}


    public function pointer(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string|max:255',
            'localisation' => 'nullable|string|max:255',
        ]);

        $pointage = SuivrePointage::where('iduser', Auth::id())
            ->whereNull('heure_depart')
            ->first();

        if ($pointage) {
            $pointage->update([
                'heure_depart' => now(),
                'description' => $request->description,
            ]);
        } else {
            SuivrePointage::create([
                'iduser' => Auth::id(),
                'heure_arrivee' => now(),
                'description' => $request->description,
                'localisation' => $request->localisation,
            ]);
        }

        return redirect()->back()->with('success', 'تم تحديث بيانات النقطة بنجاح.');
    }
}
