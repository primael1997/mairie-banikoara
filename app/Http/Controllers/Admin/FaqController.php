<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::published();

        // Filtrer par catégorie si spécifié
        if ($request->has('category')) {
            $query->byCategory($request->category);
        }

        // Grouper les FAQs par catégorie
        $faqs = $query->get();
        $faqsByCategory = $faqs->groupBy('category');

        return view('mespages.faq', compact('faqsByCategory'));
    }
}
