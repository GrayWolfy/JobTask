<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParseRequest;
use App\Http\Resources\TagCollection;
use App\Http\Services\HtmlParser;

class ParseController extends Controller
{
    public function parse(ParseRequest $request)
    {
        $html = file_get_contents($request->uri);
        $parser = new HtmlParser($html);

        return response()->json(new TagCollection($parser->tags()));
    }
}
