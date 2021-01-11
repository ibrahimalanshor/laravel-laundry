<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Datatables\DatatablesInterface;
use App\Services\User\UserDatatables;
use App\Repositories\UserRepository;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class UserController extends Controller implements DatatablesInterface
{

    protected $userDatatables;
    protected $userRepo;

    public function __construct(UserDatatables $userDatatables, UserRepository $userRepo)
    {
        $this->userDatatables = $userDatatables;
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {
        $this->userRepo->create($request->all());

        return redirect('/users')->withSuccess('Sukses Menambahkan Petugas');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id): View
    {
        $user = $this->userRepo->find($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, int $id): RedirectResponse
    {
        $this->userRepo->update($id, $request->all());

        return redirect('/users')->withSuccess('Sukses Mengedit Petugas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): JsonResponse
    {
        $this->userRepo->delete($id);

        return response()->json('Sukses Menghapus Petugas');
    }

    public function datatables(Request $request): Object
    {
        return $this->userDatatables->get();
    }

    public function search(Request $request): Object
    {
        return $this->userRepo->search($request->name);
    }
}
