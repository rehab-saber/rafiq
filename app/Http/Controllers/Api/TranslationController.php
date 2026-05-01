<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TranslationController extends Controller
{
    /**
     * الـ files المتاحة للترجمة
     */
    private array $allowedFiles = [
        'ParentAuth',
        'DoctorAuth',
        'Welcome',
        'CreateChild',
        'CarsResult',
        'CarsAssesment',
        'Home',
        'Profile',
        'LovasAssessment',
        // أضف ملفات تانية هنا زي: 'home', 'profile', ...
    ];

    /**
     * اللغات المدعومة
     */
    private array $supportedLocales = ['ar', 'en'];

    /**
     * GET /api/translations/{file}?lang=ar
     * يرجع كل مفاتيح ملف ترجمة معين
     */
    public function getFile(Request $request, string $file)
    {
        // ── تحقق من اللغة ─────────────────────────────
        $lang = $request->query('lang', 'ar');

        if (!in_array($lang, $this->supportedLocales)) {
            return response()->json([
                'success' => false,
                'message' => 'Unsupported language. Supported: ' . implode(', ', $this->supportedLocales),
            ], 422);
        }

        // ── تحقق من اسم الملف ─────────────────────────
        if (!in_array($file, $this->allowedFiles)) {
            return response()->json([
                'success' => false,
                'message' => 'Translation file not found.',
            ], 404);
        }

        // ── حمّل الترجمة ──────────────────────────────
        App::setLocale($lang);
        $translations = trans($file);

        // لو مش array معناه الملف مش موجود
        if (!is_array($translations)) {
            return response()->json([
                'success' => false,
                'message' => "Translation file [{$file}] not found for locale [{$lang}].",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'lang'    => $lang,
            'file'    => $file,
            'data'    => $translations,
        ]);
    }

    /**
     * GET /api/translations?lang=ar&files[]=auth&files[]=home
     * يرجع أكتر من ملف في request واحد (مفيد لأول فتح التطبيق)
     */
    public function getMultiple(Request $request)
    {
        $lang  = $request->query('lang', 'ar');
        $files = $request->query('files', $this->allowedFiles); // لو ماتحددش يرجع الكل

        // ── تحقق من اللغة ─────────────────────────────
        if (!in_array($lang, $this->supportedLocales)) {
            return response()->json([
                'success' => false,
                'message' => 'Unsupported language.',
            ], 422);
        }

        App::setLocale($lang);

        $result = [];
        $missing = [];

        foreach ((array) $files as $file) {
            if (!in_array($file, $this->allowedFiles)) {
                $missing[] = $file;
                continue;
            }

            $translations = trans($file);
            if (is_array($translations)) {
                $result[$file] = $translations;
            } else {
                $missing[] = $file;
            }
        }

        return response()->json([
            'success' => true,
            'lang'    => $lang,
            'data'    => $result,
            'missing' => $missing, // ملفات مش موجودة (لو في)
        ]);
    }
}