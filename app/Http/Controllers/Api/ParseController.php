<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\HtmlParser;
use Illuminate\Http\Request;

class ParseController extends Controller
{
    public function parse(Request $request)
    {
        $html = file_get_contents($request->get('uri'));
        $parser = new HtmlParser($html);

        return response()->json($parser->tags());
    }
}
