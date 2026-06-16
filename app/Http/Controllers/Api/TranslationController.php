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
        'ParentHome',
        'ParentProfile',
        'LovasAssessment',
        'Activites',
        'Chat',
        'DoctorForParent1',
        'Progress',
        'DocHome',
        'DocProfile',
        'Schedule',
        'ParentForDoc',
        'Articles',
        'ForgotPassword',
        'Premium',
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
            ], 422, [], JSON_UNESCAPED_UNICODE);
        }

        // ── تحقق من اسم الملف ─────────────────────────
        if (!in_array($file, $this->allowedFiles)) {
            return response()->json([
                'success' => false,
                'message' => 'Translation file not found.',
            ], 404, [], JSON_UNESCAPED_UNICODE);
        }

        // ── تحميل الترجمة ─────────────────────────────
        App::setLocale($lang);

        $translations = trans($file);

        // لو الملف مش موجود
        if (!is_array($translations)) {
            return response()->json([
                'success' => false,
                'message' => "Translation file [{$file}] not found for locale [{$lang}].",
            ], 404, [], JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'success' => true,
            'lang'    => $lang,
            'file'    => $file,
            'data'    => $translations,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * GET /api/translations?lang=ar&files[]=auth&files[]=home
     * يرجع أكتر من ملف في request واحد
     */
    public function getMultiple(Request $request)
    {
        $lang  = $request->query('lang', 'ar');

        // لو المستخدم مبعتش files يرجع كل الملفات
        $files = $request->query('files', $this->allowedFiles);

        // ── تحقق من اللغة ─────────────────────────────
        if (!in_array($lang, $this->supportedLocales)) {
            return response()->json([
                'success' => false,
                'message' => 'Unsupported language.',
            ], 422, [], JSON_UNESCAPED_UNICODE);
        }

        App::setLocale($lang);

        $result = [];
        $missing = [];

        foreach ((array) $files as $file) {

            // تحقق من الملف
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
            'missing' => $missing,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}