<?php

namespace App\Http\Controllers\Frontend;

use App\AdvertiseWeb;
use App\Http\Controllers\Controller;
use App\Services\FileService;
use App\Services\FormService;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{

    /**
     * @var FormService
     */
    private $form;

    /**
     * @var FileService
     */
    private $file;

    function __construct(FormService $formService, FileService $fileService)
    {
        $this->form = $formService;
        $this->file = $fileService;
    }

    private $banners = [
        [
            "url" => "banner/banner-500x500.png",
            "width" => "500",
            "height" => "500"
        ],
        [
            "url" => "banner/banner-600x1200.png",
            "width" => "600",
            "height" => "1200"
        ],
        [
            "url" => "banner/banner-1100x724.png",
            "width" => "1100",
            "height" => "724"
        ],
        [
            "url" => "banner/banner-1120x580.png",
            "width" => "1120",
            "height" => "580"
        ],
        [
            "url" => "banner/banner-1600x300.png",
            "width" => "1600",
            "height" => "300"
        ],
        [
            "url" => "banner/banner-1920x640.png",
            "width" => "1920",
            "height" => "640"
        ],
    ];

    public function saveAdvertise(Request $request) {
        $advertise = new AdvertiseWeb();

        if($request->hasFile('banner')) {
            $file = $request->file('banner');

            if (!$this->file->checkFileMimeAccepted('{"acceptTypes": "picture"}', $file)) {
                throw new FileMimeNotAcceptedException();
            } else if (!$this->file->checkFileSizeAccepted($file)) {
                throw new FileSizeNotAcceptedException();
            }

            $value = $this->file->storeFile($file, "link_exchange/banners");

            $advertise->banner = $value;
        }

        $advertise->title = $request->get('title');
        $advertise->url = $request->get('url');

        $advertise->save();

        return redirect()->route('view.frontend.advertise.complete')->with('adv_finish', 'true');
    }

    public function showForm() {
        return view('frontend.advertise')->with(["banners" => $this->banners]);
    }

    public function showComplete() {
        if(session('adv_finish')) {
            return view('frontend.advert_complete')->with(["banners" => $this->banners]);
        } else {
            return redirect()->route('view.frontend.index');
        }
    }

}
