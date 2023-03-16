<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Formatters\CsvFormatter;
use App\Http\Requests\MemberListRequest;
use App\Http\Requests\MemberStoreRequest;
use App\Services\MemberService;
use App\Traits\Paginatable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MemberController extends Controller
{
    use Paginatable;

    /** @var MemberService $memberService */
    private MemberService $memberService;
    private CsvFormatter $csvFormatter;

    public function __construct(MemberService $memberService, CsvFormatter $csvFormatter) {
        $this->memberService = $memberService;
        $this->csvFormatter = $csvFormatter;
    }

    /**
     * Add new Member Form
     *
     * @param Request $request
     * @return View
     */
    public function storeForm(Request $request): View
    {
        return view('member.save');
    }

    /**
     * List all member
     *
     * @param MemberListRequest $request
     * @return View
     */
    public function list(MemberListRequest $request): View
    {
        $filters = [
            "with" => "school"
        ];
        if ($request->has('school') && !empty($request->input('school'))) {
            $filters["where"][] = ["school_id", "=", $request->input('school_id')];
        }
        $schools = $this->memberService->findAll($filters);
        $paginatedItems = $this->getItems($schools, $request);

        return view('member.list', ['items' => $paginatedItems]);
    }

    /**
     * Add new Member Action
     *
     * @param MemberStoreRequest $request
     * @return JsonResponse
     */
    public function store(MemberStoreRequest $request): JsonResponse
    {
        $this->memberService->create($request->all());
        return response()->json(['redirect_url' => '/member/list'], 201);
    }

    /**
     * @return StreamedResponse
     */
    public function download(): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="data.csv"',
        ];

        $callback = function () {
            $conditions = [
                "with"  => "school"
            ];
            $data = $this->memberService->findAll($conditions);
            $formattedData = $this->csvFormatter->format($data);
            $handle = fopen('php://output', 'w');

            foreach ($formattedData as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }
}
