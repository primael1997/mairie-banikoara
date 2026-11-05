<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Membre;
use Illuminate\Support\Facades\DB;
use App\Models\PageVisit;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $elus = Membre::where('niveau','<>','6')->count();
        $posts = Actualite::count();
        $services = Service::count();
        $users = User::count();

        $start = $request->start;
        $end = $request->end;

        $query = PageVisit::query();

        // Filtrage si dates présentes
        if ($start && $end) {
            $query->whereBetween('visited_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
        }

        // Paginé pour la table
        $visites = $query->latest('visited_at')->paginate(15);

        // Créer une nouvelle instance de query pour les agrégations
        $baseQuery = PageVisit::query();
        if ($start && $end) {
            $baseQuery->whereBetween('visited_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
        }

        // Groupes agrégés - utiliser une nouvelle query pour chaque agrégation
        $visitesParPays = PageVisit::query()
            ->when($start && $end, function($q) use ($start, $end) {
                return $q->whereBetween('visited_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
            })
            ->select('country', DB::raw('count(*) as total'))
            ->groupBy('country')
            ->orderByDesc('total')
            ->get();

        $navigateurs = PageVisit::query()
            ->when($start && $end, function($q) use ($start, $end) {
                return $q->whereBetween('visited_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
            })
            ->select('browser', DB::raw('count(*) as total'))
            ->groupBy('browser')
            ->orderByDesc('total')
            ->get();

        $plateformes = PageVisit::query()
            ->when($start && $end, function($q) use ($start, $end) {
                return $q->whereBetween('visited_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
            })
            ->select('platform', DB::raw('count(*) as total'))
            ->groupBy('platform')
            ->orderByDesc('total')
            ->get();

        $devices = PageVisit::query()
            ->when($start && $end, function($q) use ($start, $end) {
                return $q->whereBetween('visited_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
            })
            ->select('device', DB::raw('count(*) as total'))
            ->groupBy('device')
            ->orderByDesc('total')
            ->get();

        $pages = PageVisit::query()
            ->when($start && $end, function($q) use ($start, $end) {
                return $q->whereBetween('visited_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
            })
            ->select('url', DB::raw('count(*) as total'))
            ->groupBy('url')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return view('admin.dashboard', [
            'elus' => $elus,
            'services' => $services,
            'posts' => $posts,
            'users' => $users,
            'visites' => $visites,
            'visitesParPays' => $visitesParPays,
            'navigateurs' => $navigateurs,
            'plateformes' => $plateformes,
            'devices' => $devices,
            'pages' => $pages,
        ]);
    }
}
