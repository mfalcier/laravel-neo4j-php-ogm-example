<?php

namespace App\Http\Controllers;

use App\Entities\User;
use GraphAware\Neo4j\OGM\EntityManagerInterface;
use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var BaseRepository
     */
    private $userRepository;

    /**
     * UserController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new Response())->setContent($this->userRepository->findAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = json_decode($request->getContent(), true);
        $user = new User();
        $user->setName($input['name']);
        $user->setBorn($input['born']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return (new Response())->setContent($user->getId());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return (new Response())->setContent($this->userRepository->findOneById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = json_decode($request->getContent(), true);
        $user = $this->userRepository->findOneById($id);
        if(!empty($input['name'])) {
            $user->setName($input['name']);
        }
        if(!empty($input['born'])) {
            $user->setBorn($input['born']);
        }
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return (new Response())->setContent($user->getId());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->entityManager->detach($this->userRepository->findOneById($id));
        $this->entityManager->remove($this->userRepository->findOneById($id));
        $this->entityManager->flush();
    }
}
