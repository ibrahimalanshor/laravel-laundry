<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Datatables\DatatablesInterface;
use App\Http\Controllers\Search\SearchInterface;
use App\Http\Requests\Packet\CreatePacketRequest;
use App\Http\Requests\Packet\UpdatePacketRequest;
use App\Repositories\PacketRepository;
use App\Services\Packet\PacketDatatables;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PacketController extends Controller implements DatatablesInterface, SearchInterface
{

    protected $packetRepo;
    protected $packetDatatables;

    public function __construct(PacketRepository $packetRepo, PacketDatatables $packetDatatables)
    {
        $this->packetRepo = $packetRepo;
        $this->packetDatatables = $packetDatatables;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('packets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('packets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePacketRequest $request): RedirectResponse
    {
        $this->packetRepo->create($request->all());

        return redirect('/packets')->withSuccess('Sukses Menambahkan Paket');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id): View
    {
        $packet = $this->packetRepo->find($id);

        return view('packets.edit', compact('packet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePacketRequest $request, int $id): RedirectResponse
    {
        $this->packetRepo->update($id, $request->all());

        return redirect('/packets')->withSuccess('Sukses Mengedit Paket');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): JsonResponse
    {
        $this->packetRepo->delete($id);

        return response()->json('Sukses Menghapus Paket');
    }

    public function datatables(Request $request): Object
    {
        return $this->packetDatatables->get();
    }

    public function search(Request $request): Object
    {
        return $this->packetRepo->search($request->name);
    }
}
