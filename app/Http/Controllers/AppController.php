<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Random\RandomException;

class AppController extends Controller
{

    /**
     * @param Request $request
     * @return View|Factory|Application
     * @throws RandomException
     */
    public function index(Request $request): View|Factory|Application
    {
        $token = random_int(1000000, 9999999);
        return view('welcome')->with('token', $token);
    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function endGame(Request $request)
    {
        $token = random_int(1000000, 9999999);
        return view('endgame')->with('token', $token);
    }

    /**
     * @param Request $request
     * @return Factory|View|Application|RedirectResponse
     */
    public function game(Request $request)
    {
        if ($request->id > 1000000 && $request->id < 9999999) {

            $questionArray = $this->getRandomItems();

            return view('game')
                ->with('questionArray', $questionArray);
        }

        return redirect()->route('app.index');
    }

    /**
     * @return array
     */
    private function getRandomItems(): array
    {
        $groups = [
            'A' => config('quiz.groups.A'),
            'B' => config('quiz.groups.B'),
        ];

        $randomA = $this->getRandomItemsFromGroup($groups['A'], 2);
        $randomB = $this->getRandomItemsFromGroup($groups['B'], 3);

        return array_merge($randomA, $randomB);
    }

    private function getRandomItemsFromGroup($group, $count): array
    {
        if ($count > count($group)) {
            $count = count($group);
        }

        shuffle($group);
        return array_slice($group, 0, $count);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getQuestions(Request $request): array
    {
        return $this->getRandomItems();
    }

    public function score(Request $request)
    {
        return view('score')->with('score', $request->score);
    }

}
